<?php
/**
 * reCAPTCHA v2 Invisible — server-side verification.
 *
 * @package Linkawy
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Whether a secret key is saved (enforces token on submissions).
 */
function linkawy_recaptcha_secret_configured() {
    return trim((string) get_theme_mod('linkawy_recaptcha_secret_key', '')) !== '';
}

/**
 * Verify a reCAPTCHA response token with Google.
 * If no secret is configured, returns true (CAPTCHA disabled).
 *
 * @param string $token Response token from grecaptcha.
 * @return true|WP_Error
 */
function linkawy_verify_recaptcha_token($token) {
    $secret = trim((string) get_theme_mod('linkawy_recaptcha_secret_key', ''));
    if ($secret === '') {
        return true;
    }

    $token = is_string($token) ? trim($token) : '';
    if ($token === '') {
        return new WP_Error(
            'recaptcha_missing',
            __('فشل التحقق الأمني. يرجى المحاولة مرة أخرى.', 'linkawy')
        );
    }

    $remote_ip = '';
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        $remote_ip = sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR']));
    }

    $response = wp_remote_post(
        'https://www.google.com/recaptcha/api/siteverify',
        array(
            'timeout' => 10,
            'body'    => array(
                'secret'   => $secret,
                'response' => $token,
                'remoteip' => $remote_ip,
            ),
        )
    );

    if (is_wp_error($response)) {
        error_log('Linkawy: reCAPTCHA verification failed - ' . $response->get_error_message());
        return true;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (!is_array($data) || !isset($data['success']) || $data['success'] !== true) {
        return new WP_Error(
            'recaptcha_failed',
            __('فشل التحقق الأمني. يرجى المحاولة مرة أخرى.', 'linkawy')
        );
    }

    return true;
}

/**
 * Verify reCAPTCHA from POST field recaptcha_token.
 *
 * @return true|WP_Error
 */
function linkawy_verify_recaptcha_from_request() {
    $raw = isset($_POST['recaptcha_token']) ? wp_unslash($_POST['recaptcha_token']) : '';
    return linkawy_verify_recaptcha_token(sanitize_text_field($raw));
}
