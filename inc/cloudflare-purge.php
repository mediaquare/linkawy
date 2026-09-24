<?php
/**
 * Cloudflare HTML cache purge
 *
 * HTML is cached at the Cloudflare edge for a long time, so purge the affected
 * URLs whenever content changes, and everything when the theme/menus change.
 * Credentials live outside the repo in ~/.cf-purge.json ({"zone":"…","token":"…"},
 * chmod 600); without that file every function here is a no-op.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

function linkawy_cf_credentials() {
    static $creds = null;
    if ($creds === null) {
        $file = dirname(rtrim(ABSPATH, '/')) . '/.cf-purge.json';
        $creds = is_readable($file) ? json_decode((string) file_get_contents($file), true) : false;
        if (empty($creds['zone']) || empty($creds['token'])) {
            $creds = false;
        }
    }
    return $creds;
}

/**
 * Send one purge request. $body is ['files' => [...]] or ['purge_everything' => true].
 */
function linkawy_cf_request($body) {
    $creds = linkawy_cf_credentials();
    if (!$creds) {
        return false;
    }
    $response = wp_remote_post('https://api.cloudflare.com/client/v4/zones/' . rawurlencode($creds['zone']) . '/purge_cache', array(
        'timeout' => 8,
        'headers' => array(
            'Authorization' => 'Bearer ' . $creds['token'],
            'Content-Type'  => 'application/json',
        ),
        'body'    => wp_json_encode($body),
    ));
    $ok = !is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200;
    if (!$ok) {
        error_log('linkawy_cf_purge failed: ' . (is_wp_error($response) ? $response->get_error_message() : wp_remote_retrieve_response_code($response) . ' ' . substr(wp_remote_retrieve_body($response), 0, 300)));
    }
    return $ok;
}

/**
 * Queue URLs; they are sent once at the end of the request.
 */
function linkawy_cf_queue($urls = null, $everything = false) {
    static $queue = array(), $all = false, $hooked = false;
    if ($urls === null && !$everything) {
        return array($queue, $all);
    }
    if ($everything) {
        $all = true;
    }
    foreach ((array) $urls as $url) {
        if (!$url || !is_string($url)) {
            continue;
        }
        $queue[$url] = true;
        // Cloudflare may key Arabic slugs with upper-case percent-encoding; purge both spellings.
        $upper = preg_replace_callback('/%[0-9a-f]{2}/i', function ($m) { return strtoupper($m[0]); }, $url);
        $lower = preg_replace_callback('/%[0-9a-f]{2}/i', function ($m) { return strtolower($m[0]); }, $url);
        $queue[$upper] = true;
        $queue[$lower] = true;
    }
    if (!$hooked) {
        $hooked = true;
        add_action('shutdown', 'linkawy_cf_flush_queue');
    }
}

function linkawy_cf_flush_queue() {
    list($queue, $all) = linkawy_cf_queue();
    if ($all) {
        linkawy_cf_request(array('purge_everything' => true));
        return;
    }
    foreach (array_chunk(array_keys($queue), 30) as $chunk) {
        linkawy_cf_request(array('files' => $chunk));
    }
}

/**
 * Every public URL that shows this post (its page, home, listings, terms, author).
 */
function linkawy_cf_post_urls($post) {
    $post = get_post($post);
    if (!$post || !is_post_type_viewable($post->post_type)) {
        return array();
    }
    $urls = array(get_permalink($post), home_url('/'));
    $listings = array();
    if ($post->post_type === 'post' && get_option('page_for_posts')) {
        $listings[] = get_permalink(get_option('page_for_posts'));
    }
    if ($archive = get_post_type_archive_link($post->post_type)) {
        $listings[] = $archive;
    }
    foreach (get_object_taxonomies($post->post_type, 'objects') as $tax) {
        if (!$tax->public) {
            continue;
        }
        foreach ((array) get_the_terms($post, $tax->name) as $term) {
            if ($term && !is_wp_error($term)) {
                $listings[] = get_term_link($term);
            }
        }
    }
    foreach ($listings as $listing) {
        if (is_wp_error($listing) || !$listing) {
            continue;
        }
        $urls[] = $listing;
        for ($page = 2; $page <= 4; $page++) {
            $urls[] = trailingslashit($listing) . 'page/' . $page . '/';
        }
    }
    $urls[] = get_author_posts_url($post->post_author);
    return array_filter($urls, 'is_string');
}

add_action('transition_post_status', function ($new, $old, $post) {
    if ($new === 'publish' || $old === 'publish') {
        linkawy_cf_queue(linkawy_cf_post_urls($post));
    }
}, 10, 3);

add_action('transition_comment_status', function ($new, $old, $comment) {
    linkawy_cf_queue(array(get_permalink($comment->comment_post_ID)));
}, 10, 3);
add_action('comment_post', function ($id, $approved) {
    if ($approved === 1) {
        linkawy_cf_queue(array(get_permalink(get_comment($id)->comment_post_ID)));
    }
}, 10, 2);

/** Sitewide changes (theme deploys, menus, customizer, plugins) purge everything. */
function linkawy_cf_purge_everything() {
    linkawy_cf_queue(array(), true);
}
foreach (array('wppusher_theme_was_updated', 'switch_theme', 'customize_save_after', 'wp_update_nav_menu', 'upgrader_process_complete', 'activated_plugin', 'deactivated_plugin') as $linkawy_cf_hook) {
    add_action($linkawy_cf_hook, 'linkawy_cf_purge_everything');
}

/** Admin bar button: "Purge Cloudflare". */
add_action('admin_bar_menu', function ($bar) {
    if (!current_user_can('manage_options') || !linkawy_cf_credentials()) {
        return;
    }
    $bar->add_node(array(
        'id'    => 'linkawy-cf-purge',
        'title' => 'Purge Cloudflare',
        'href'  => wp_nonce_url(admin_url('admin-post.php?action=linkawy_cf_purge_all'), 'linkawy_cf_purge_all'),
    ));
}, 100);
add_action('admin_post_linkawy_cf_purge_all', function () {
    if (!current_user_can('manage_options') || !check_admin_referer('linkawy_cf_purge_all')) {
        wp_die('Forbidden', 403);
    }
    $ok = linkawy_cf_request(array('purge_everything' => true));
    wp_safe_redirect(add_query_arg('linkawy_cf_purged', $ok ? '1' : '0', wp_get_referer() ?: admin_url()));
    exit;
});
