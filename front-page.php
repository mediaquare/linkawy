<?php
/**
 * Front Page Template
 *
 * @package Linkawy
 */

get_header();
?>

    <!-- Swiper CSS for Results Section (below fold - non-blocking) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.css" media="print" onload="this.media='all'" crossorigin="anonymous">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.css"></noscript>

    <!-- Hero + Platforms Shared Dark Wrapper -->
    <div class="hero-dark-wrapper">

    <!-- Hero Section - Dark Cinematic Mode -->
    <div class="hero-dark-section min-h-screen bg-mesh overflow-x-hidden selection:bg-[#f26833] selection:text-white">
        <!-- LCP Optimization: Start animations after first paint -->
        <script>
        requestAnimationFrame(function(){
            requestAnimationFrame(function(){
                document.querySelector('.hero-dark-section').classList.add('animations-ready');
            });
        });
        </script>
        <section class="hero-header pt-32 pb-16 lg:pt-40 lg:pb-10 relative overflow-hidden">
            
            <!-- Ambient glow is handled by .hero-dark-section::before in CSS -->

            <div class="hero-inner max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                
                <div class="flex flex-col lg:flex-row gap-20 items-center">
                    
                    <!-- TEXT CONTENT (Right - 40% Width) -->
                    <div class="lg:w-[40%] z-20 text-right">
                        <h1 class="text-3xl lg:text-5xl font-extrabold text-white leading-[1.3] mb-6">
                            <?php esc_html_e('أفضل', 'linkawy'); ?> <span class="text-[#f26833]"><?php esc_html_e('شركة سيو', 'linkawy'); ?></span>
                            <br>
                            <?php esc_html_e('للمتاجر الإلكترونية والشركات', 'linkawy'); ?>

                        </h1>
                        
                        <p class="text-lg text-gray-400 mb-8 leading-relaxed font-medium">
                            <?php esc_html_e('اختيارك شركة سيو مناسبة لا يعني تحسين الترتيب فقط، بل بناء قناة نمو تربط محركات البحث بالمبيعات. في لينكاوي نقدم استراتيجيات سيو تساعدك على تصدر النتائج وجذب زيارات مؤهلة تتحول إلى إيرادات مستدامة، لمن يبحث عن أفضل شركة سيو في السعودية للمتاجر والشركات.', 'linkawy'); ?>

                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#خدمات-سيو" class="inline-flex items-center justify-center gap-2 bg-accent text-white px-8 py-3.5 rounded-full font-bold text-lg shadow-[0_0_20px_rgba(242,104,51,0.3)] hover:shadow-[0_0_30px_rgba(242,104,51,0.5)] hover:-translate-y-0.5 transition-all w-full sm:w-auto hover-accent">
                                <span><?php esc_html_e('اكتشف الخدمات', 'linkawy'); ?></span>
                            </a>
                             <a href="#كيف-نعمل" class="inline-flex items-center justify-center gap-2 bg-transparent border border-[#333] text-gray-300 px-8 py-3.5 rounded-full font-bold text-lg hover:bg-[#111] hover:text-white hover:border-gray-500 transition-all w-full sm:w-auto">
                                <span><?php esc_html_e('كيف نعمل؟', 'linkawy'); ?></span>
                            </a>
                        </div>

                        <!-- Client Logos Section -->
                        <div class="hero-clients mt-12 pt-8 border-t border-[#222]">
                            <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-8">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest whitespace-nowrap"><?php esc_html_e('عملاء تشرفنا بمعاونتهم:', 'linkawy'); ?></p>
                                <div class="clients-logos-wrapper flex flex-wrap items-center gap-8">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/dinar.svg" alt="Dinar" width="67" height="28" loading="eager" decoding="async" class="client-logo-item h-7 w-auto opacity-40 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/asharq.svg" alt="Asharq Bloomberg" width="43" height="24" loading="eager" decoding="async" class="client-logo-item h-6 w-auto opacity-40 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/alyom.svg" alt="Alyom Digital" width="73" height="28" loading="eager" decoding="async" class="client-logo-item h-7 w-auto opacity-40 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- VISUAL WALL (Left - 60% Width) -->
                    <div class="lg:w-[60%] w-full relative h-[650px] flex justify-center lg:justify-end">
                        
                        <!-- Glow behind grid -->
                        <div class="absolute top-1/2 right-1/2 translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] cinematic-glow rounded-full blur-3xl -z-10"></div>

                        <div class="wall-container w-full flex justify-center lg:justify-end">
                            <div class="wall-grid">
                                
                                <!-- COLUMN 1: UP -->
                                <div class="wall-column col-up-slow">
                                    <!-- Marquee Group 1 -->
                                    <div class="marquee-group">
                                        <!-- Card 1: Google SERP -->
                                        <div class="wall-card anim-border-pulse">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/google-color.svg" alt="" width="16" height="16"></div>
                                                <span class="mini-badge">Result #1</span>
                                            </div>
                                            <div>
                                                <div class="h-2.5 w-3/4 bg-[#f26833] rounded mb-2 shadow-[0_0_10px_rgba(242,104,51,0.5)] anim-scan"></div>
                                                <div class="skeleton-bar mb-1"></div>
                                                <div class="skeleton-bar w-2/3"></div>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Google SERP</div>
                                        </div>
                                        
                                        <!-- Card 2: Links (Counter) -->
                                        <div class="wall-card relative">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><?php echo linkawy_icon('Link', 16); ?></div>
                                                <span class="mini-badge">Links</span>
                                            </div>
                                            <div class="text-center py-1 relative">
                                                <div class="flex items-baseline justify-center gap-1">
                                                    <span class="text-[10px] font-bold text-gray-300">DR</span>
                                                    <div class="text-xl font-bold text-white anim-score"><span class="dr-counter">80</span></div>
                                                </div>
                                                <div class="absolute top-0 right-10 text-[9px] text-[#f26833] font-extrabold anim-float-plus">+3</div>
                                                <div class="text-[9px] text-gray-500">Authority Score</div>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Backlinks</div>
                                        </div>
                                        
                                        <!-- Card 3: Gemini -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/gemini-color.svg" alt="Gemini" width="16" height="16"></div>
                                                <span class="mini-badge">Gemini</span>
                                            </div>
                                            <div class="space-y-1.5 relative">
                                                <div class="h-[5px] bg-[#333] rounded-full anim-seq-1"></div>
                                                <div class="h-[5px] bg-[#333] rounded-full anim-seq-2"></div>
                                                <div class="h-[5px] bg-[#333] rounded-full anim-seq-3"></div>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">AI Overview</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Marquee Group 2 (Duplicate) -->
                                    <div class="marquee-group" aria-hidden="true">
                                         <div class="wall-card anim-border-pulse"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/google-color.svg" alt="" width="16" height="16"></div><span class="mini-badge">Result #1</span></div><div><div class="h-2.5 w-3/4 bg-[#f26833] rounded mb-2 shadow-[0_0_10px_rgba(242,104,51,0.5)] anim-scan"></div><div class="skeleton-bar mb-1"></div><div class="skeleton-bar w-2/3"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Google SERP</div></div>
                                         <div class="wall-card relative"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('Link', 16); ?></div><span class="mini-badge">Links</span></div><div class="text-center py-1 relative"><div class="flex items-baseline justify-center gap-1"><span class="text-[10px] font-bold text-gray-300">DR</span><div class="text-xl font-bold text-white anim-score"><span class="dr-counter">80</span></div></div><div class="absolute top-0 right-10 text-[9px] text-[#f26833] font-extrabold anim-float-plus">+3</div><div class="text-[9px] text-gray-500">Authority Score</div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Backlinks</div></div>
                                         <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/gemini-color.svg" alt="Gemini" width="16" height="16"></div><span class="mini-badge">Gemini</span></div><div class="space-y-1.5 relative"><div class="h-[5px] bg-[#333] rounded-full anim-seq-1"></div><div class="h-[5px] bg-[#333] rounded-full anim-seq-2"></div><div class="h-[5px] bg-[#333] rounded-full anim-seq-3"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">AI Overview</div></div>
                                    </div>

                                    <!-- Marquee Group 3 (Duplicate for Safety) -->
                                    <div class="marquee-group" aria-hidden="true">
                                         <div class="wall-card anim-border-pulse"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/google-color.svg" alt="" width="16" height="16"></div><span class="mini-badge">Result #1</span></div><div><div class="h-2.5 w-3/4 bg-[#f26833] rounded mb-2 shadow-[0_0_10px_rgba(242,104,51,0.5)] anim-scan"></div><div class="skeleton-bar mb-1"></div><div class="skeleton-bar w-2/3"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Google SERP</div></div>
                                         <div class="wall-card relative"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('Link', 16); ?></div><span class="mini-badge">Links</span></div><div class="text-center py-1 relative"><div class="flex items-baseline justify-center gap-1"><span class="text-[10px] font-bold text-gray-300">DR</span><div class="text-xl font-bold text-white anim-score"><span class="dr-counter">80</span></div></div><div class="absolute top-0 right-10 text-[9px] text-[#f26833] font-extrabold anim-float-plus">+3</div><div class="text-[9px] text-gray-500">Authority Score</div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Backlinks</div></div>
                                         <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/gemini-color.svg" alt="Gemini" width="16" height="16"></div><span class="mini-badge">Gemini</span></div><div class="space-y-1.5 relative"><div class="h-[5px] bg-[#333] rounded-full anim-seq-1"></div><div class="h-[5px] bg-[#333] rounded-full anim-seq-2"></div><div class="h-[5px] bg-[#333] rounded-full anim-seq-3"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">AI Overview</div></div>
                                    </div>
                                </div>

                                <!-- COLUMN 2: DOWN -->
                                <div class="wall-column col-down-med">
                                    <!-- Marquee Group 1 -->
                                    <div class="marquee-group">
                                        <!-- Card 1: ChatGPT -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/openai-white.svg" alt="OpenAI" width="16" height="16"></div>
                                                <span class="mini-badge">ChatGPT</span>
                                            </div>
                                            <div class="bg-[#111] border border-[#222] p-2 rounded text-[9px] text-gray-400 leading-relaxed opacity-90 relative">
                                                <span class="anim-typewriter-text"><?php esc_html_e('"الظهور في اجابات الذكاء الاصطناعي..."', 'linkawy'); ?></span>
                                                <span class="inline-block w-0.5 h-2.5 bg-[#f26833] anim-cursor-real align-middle"></span>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">LLMO / GEO</div>
                                        </div>
                                        
                                        <!-- Card 2: Blog Post (Sequential Typing Slower) -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><?php echo linkawy_icon('FileText', 16); ?></div>
                                                <span class="mini-badge">Content</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 bg-[#1a1a1a] rounded-md border border-[#333]"></div>
                                                <div class="flex-1 space-y-1 relative">
                                                    <div class="h-[5px] bg-[#222] rounded-full anim-seq-1 anim-slow-duration"></div>
                                                    <div class="h-[5px] bg-[#222] rounded-full anim-seq-2-content anim-slow-duration"></div>
                                                </div>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Blog Post</div>
                                        </div>
                                        
                                        <!-- Card 3: Maps (Coverage) -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><?php echo linkawy_icon('MapPin', 16); ?></div>
                                                <span class="mini-badge">Local SEO</span>
                                            </div>
                                            <div class="h-10 bg-[#1a1a1a] rounded relative overflow-hidden border border-[#222] flex items-center justify-center">
                                                <div class="relative w-16 h-8">
                                                    <div class="anim-area-dot anim-area-dot--0 w-1.5 h-1.5 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div>
                                                    <div class="anim-area-dot w-1 h-1 absolute top-2 left-4" ></div>
                                                    <div class="anim-area-dot anim-area-dot--1_5 w-1 h-1 absolute bottom-2 right-4"></div>
                                                    <div class="anim-area-dot anim-area-dot--2 w-1 h-1 absolute top-1 right-2"></div>
                                                    <div class="anim-area-dot anim-area-dot--2_5 w-1 h-1 absolute bottom-1 left-2"></div>
                                                </div>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Maps Ranking</div>
                                        </div>
                                    </div>

                                    <!-- Marquee Group 2 (Duplicate) -->
                                    <div class="marquee-group" aria-hidden="true">
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/openai-white.svg" alt="OpenAI" width="16" height="16"></div><span class="mini-badge">ChatGPT</span></div><div class="bg-[#111] border border-[#222] p-2 rounded text-[9px] text-gray-400 leading-relaxed opacity-90 relative"><span class="anim-typewriter-text"><?php esc_html_e('"الظهور في اجابات الذكاء الاصطناعي..."', 'linkawy'); ?></span><span class="inline-block w-0.5 h-2.5 bg-[#f26833] anim-cursor-real align-middle"></span></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">LLMO / GEO</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('FileText', 16); ?></div><span class="mini-badge">Content</span></div><div class="flex items-center gap-2"><div class="w-8 h-8 bg-[#1a1a1a] rounded-md border border-[#333]"></div><div class="flex-1 space-y-1 relative"><div class="h-[5px] bg-[#222] rounded-full anim-seq-1 anim-slow-duration"></div><div class="h-[5px] bg-[#222] rounded-full anim-seq-2-content anim-slow-duration"></div></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Blog Post</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('MapPin', 16); ?></div><span class="mini-badge">Local SEO</span></div><div class="h-10 bg-[#1a1a1a] rounded relative overflow-hidden border border-[#222] flex items-center justify-center"><div class="relative w-16 h-8"><div class="anim-area-dot anim-area-dot--0 w-1.5 h-1.5 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div><div class="anim-area-dot w-1 h-1 absolute top-2 left-4" ></div><div class="anim-area-dot anim-area-dot--1_5 w-1 h-1 absolute bottom-2 right-4"></div><div class="anim-area-dot anim-area-dot--2 w-1 h-1 absolute top-1 right-2"></div><div class="anim-area-dot anim-area-dot--2_5 w-1 h-1 absolute bottom-1 left-2"></div></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Maps Ranking</div></div>
                                    </div>
                                    
                                    <!-- Marquee Group 3 (Duplicate) -->
                                    <div class="marquee-group" aria-hidden="true">
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/openai-white.svg" alt="OpenAI" width="16" height="16"></div><span class="mini-badge">ChatGPT</span></div><div class="bg-[#111] border border-[#222] p-2 rounded text-[9px] text-gray-400 leading-relaxed opacity-90 relative"><span class="anim-typewriter-text"><?php esc_html_e('"الظهور في اجابات الذكاء الاصطناعي..."', 'linkawy'); ?></span><span class="inline-block w-0.5 h-2.5 bg-[#f26833] anim-cursor-real align-middle"></span></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">LLMO / GEO</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('FileText', 16); ?></div><span class="mini-badge">Content</span></div><div class="flex items-center gap-2"><div class="w-8 h-8 bg-[#1a1a1a] rounded-md border border-[#333]"></div><div class="flex-1 space-y-1 relative"><div class="h-[5px] bg-[#222] rounded-full anim-seq-1 anim-slow-duration"></div><div class="h-[5px] bg-[#222] rounded-full anim-seq-2-content anim-slow-duration"></div></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Blog Post</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('MapPin', 16); ?></div><span class="mini-badge">Local SEO</span></div><div class="h-10 bg-[#1a1a1a] rounded relative overflow-hidden border border-[#222] flex items-center justify-center"><div class="relative w-16 h-8"><div class="anim-area-dot anim-area-dot--0 w-1.5 h-1.5 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div><div class="anim-area-dot w-1 h-1 absolute top-2 left-4" ></div><div class="anim-area-dot anim-area-dot--1_5 w-1 h-1 absolute bottom-2 right-4"></div><div class="anim-area-dot anim-area-dot--2 w-1 h-1 absolute top-1 right-2"></div><div class="anim-area-dot anim-area-dot--2_5 w-1 h-1 absolute bottom-1 left-2"></div></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Maps Ranking</div></div>
                                    </div>
                                </div>

                                <!-- COLUMN 3: UP -->
                                <div class="wall-column col-up-fast">
                                    <!-- Marquee Group 1 -->
                                    <div class="marquee-group">
                                        <!-- Card 1: Digital PR -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><?php echo linkawy_icon('Megaphone', 16); ?></div>
                                                <span class="mini-badge">Digital PR</span>
                                            </div>
                                            <div class="flex gap-1 mt-1">
                                                <div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div>
                                                <div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div>
                                                <div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Media Coverage</div>
                                        </div>
                                        
                                        <!-- Card 2: Niche Edits -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><?php echo linkawy_icon('PenLine', 16); ?></div>
                                                <span class="mini-badge">Niche Edits</span>
                                            </div>
                                            <div class="bg-[#111] p-2 rounded text-[9px] text-gray-500 border border-[#222]">
                                                Contextual <span class="text-[#f26833] font-bold animate-[pulse_3s_infinite]">Link</span> added.
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Curated Links</div>
                                        </div>
                                        
                                        <!-- Card 3: Growth -->
                                        <div class="wall-card anim-border-pulse">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><?php echo linkawy_icon('ChartLine', 16); ?></div>
                                                <span class="mini-badge">Organic Growth</span>
                                            </div>
                                            <div class="flex items-end gap-1 h-10">
                                                <div class="w-1/4 bg-[#222] rounded-t flux-bar-1"></div>
                                                <div class="w-1/4 bg-[#333] rounded-t flux-bar-2"></div>
                                                <div class="w-1/4 bg-[#ea6431] opacity-60 rounded-t flux-bar-3"></div>
                                                <div class="w-1/4 bg-[#f26833] rounded-t shadow-[0_0_10px_rgba(242,104,51,0.5)] flux-bar-4"></div>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Traffic</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Marquee Group 2 (Duplicate) -->
                                    <div class="marquee-group" aria-hidden="true">
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('Megaphone', 16); ?></div><span class="mini-badge">Digital PR</span></div><div class="flex gap-1 mt-1"><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Media Coverage</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('PenLine', 16); ?></div><span class="mini-badge">Niche Edits</span></div><div class="bg-[#111] p-2 rounded text-[9px] text-gray-500 border border-[#222]">Contextual <span class="text-[#f26833] font-bold animate-[pulse_3s_infinite]">Link</span> added.</div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Curated Links</div></div>
                                        <div class="wall-card anim-border-pulse"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('ChartLine', 16); ?></div><span class="mini-badge">Organic Growth</span></div><div class="flex items-end gap-1 h-10"><div class="w-1/4 bg-[#222] rounded-t flux-bar-1"></div><div class="w-1/4 bg-[#333] rounded-t flux-bar-2"></div><div class="w-1/4 bg-[#ea6431] opacity-60 rounded-t flux-bar-3"></div><div class="w-1/4 bg-[#f26833] rounded-t shadow-[0_0_10px_rgba(242,104,51,0.5)] flux-bar-4"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Traffic</div></div>
                                    </div>

                                    <!-- Marquee Group 3 (Duplicate) -->
                                    <div class="marquee-group" aria-hidden="true">
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('Megaphone', 16); ?></div><span class="mini-badge">Digital PR</span></div><div class="flex gap-1 mt-1"><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Media Coverage</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('PenLine', 16); ?></div><span class="mini-badge">Niche Edits</span></div><div class="bg-[#111] p-2 rounded text-[9px] text-gray-500 border border-[#222]">Contextual <span class="text-[#f26833] font-bold animate-[pulse_3s_infinite]">Link</span> added.</div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Curated Links</div></div>
                                        <div class="wall-card anim-border-pulse"><div class="flex justify-between items-start"><div class="icon-box"><?php echo linkawy_icon('ChartLine', 16); ?></div><span class="mini-badge">Organic Growth</span></div><div class="flex items-end gap-1 h-10"><div class="w-1/4 bg-[#222] rounded-t flux-bar-1"></div><div class="w-1/4 bg-[#333] rounded-t flux-bar-2"></div><div class="w-1/4 bg-[#ea6431] opacity-60 rounded-t flux-bar-3"></div><div class="w-1/4 bg-[#f26833] rounded-t shadow-[0_0_10px_rgba(242,104,51,0.5)] flux-bar-4"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Traffic</div></div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div><!-- /.hero-dark-section -->

    <!-- Dark Platforms Conveyor Belt (attached below hero) -->
    <section class="dark-platforms-bar">
        <div class="dark-platforms-container">
            <h2 class="dark-platforms-label"><?php esc_html_e('شركة سيو رائدة في تحويل الزيارات إلى أرباح حقيقية عبر مختلف المنصات', 'linkawy'); ?></h2>
            <div class="platforms-conveyor" id="platformsConveyor">
                <div class="platforms-track" id="platformsTrack">
                    <!-- JS will populate items here -->
                </div>
            </div>
        </div>
    </section>

    </div><!-- /.hero-dark-wrapper -->

    <?php /* قسم الفيديو معطّل مؤقتاً
    <!-- Dark Video Section (attached below platforms) -->
    <section class="dark-video-section">
        <div class="dark-video-container">
            <span class="dark-video-badge">تعرّف علينا</span>
            <h2 class="dark-video-title">كيف نحقق النتائج لعملائنا</h2>
            <p class="dark-video-desc">نجمع بين الإبداع والبيانات في استراتيجيات سيو متكاملة تحقق نتائج حقيقية وملموسة لمشروعك.</p>
            <div class="dark-video-wrapper">
                <iframe 
                    src="https://www.youtube.com/embed/tMBdA2gkXgk?rel=0&modestbranding=1" 
                    title="Linkawy - خدماتنا" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>
    */ ?>

    <!-- Programs/Pricing Section -->
    <section class="programs-section fp-scroll-anchor" id="خدمات-سيو" data-surface="white">
        <div class="container programs-container">
            <!-- Left Side: Sticky Header -->
            <div class="programs-intro">
                <span class="badge services-badge">
                    <span id="services-slide-text" class="services-slide-text">Shopify
                        SEO</span>
                </span>
                <h2><?php esc_html_e('خدمات السيو التي نقدمها', 'linkawy'); ?></h2>
                <p><?php esc_html_e('استكشف استراتيجياتنا المخصصة التي تقدم التوجيه والدعم لمساعدتك على تصدر نتائج البحث وتحقيق النمو المستدام بثقة.', 'linkawy'); ?></p>
                <p><?php esc_html_e('نوازن في كل خدمة بين تحليل الكلمات، تحسين المحتوى، وفهم سلوك محركات البحث حتى لا تتحول خطة السيو إلى قائمة مهام تقنية فقط.', 'linkawy'); ?></p>
                <p><?php esc_html_e('اختيار أفضل شركة سيو هنا يعني اختيار شريك يعرف كيف يحول الظهور إلى فرص تجارية واضحة.', 'linkawy'); ?></p>
                <a href="#contact" class="cta-button fp-cta-margin"><?php esc_html_e('أطلب استشارة مجانية', 'linkawy'); ?></a>
            </div>

            <!-- Right Side: Grid -->
            <div class="programs-grid">
                <!-- Card 1: Shopify SEO -->
                <div class="program-card program-card--shopify">
                    <div class="icon-box">
                        <?php echo file_get_contents( get_template_directory() . '/assets/images/partners/shopify.svg' ); ?>
                    </div>
                    <h3><?php esc_html_e('سيو شوبيفاي', 'linkawy'); ?></h3>
                    <span class="service-subtitle">Shopify SEO</span>
                    <p><?php esc_html_e('نساعد متاجر شوبيفاي على تحسين الصفحات، المنتجات، وبنية المحتوى بما يتوافق مع متطلبات محركات البحث. نعمل على رفع فرص الظهور في النتائج، تحسين الوصول للمنتجات، وزيادة الزيارات المستهدفة، بما يدعم نمو المتجر ويعزز حضور العلامة التجارية أمام العملاء المحتملين.', 'linkawy'); ?></p>
                </div>

                <!-- Card 2: Salla SEO -->
                <div class="program-card program-card--salla">
                    <div class="icon-box">
                        <?php echo file_get_contents( get_template_directory() . '/assets/images/partners/sall.svg' ); ?>
                    </div>
                    <h3><?php esc_html_e('سيو سلة', 'linkawy'); ?></h3>
                    <span class="service-subtitle">Salla SEO</span>
                    <p><?php esc_html_e('نقدم خدمات SEO مخصصة لمتاجر سلة، تشمل تحسين الصفحات، الأقسام، المنتجات، والمحتوى الداخلي للمتجر. نركز على تسهيل ظهور منتجاتك في نتائج البحث، وتحسين تجربة التصفح والوصول، بما يساهم في زيادة الزيارات العضوية ورفع فرص تحقيق مبيعات أكبر بشكل مستدام.', 'linkawy'); ?></p>
                </div>

                <!-- Card 4: On-Page SEO -->
                <div class="program-card">
                    <div class="icon-box">
                        <?php echo linkawy_icon('FileText', 24); ?>
                    </div>
                    <h3><?php esc_html_e('السيو الداخلي', 'linkawy'); ?></h3>
                    <span class="service-subtitle">On-Page SEO</span>
                    <p><?php esc_html_e('نعمل على تحسين العناصر الداخلية في موقعك مثل العناوين، المحتوى، الروابط الداخلية، والهيكلة العامة للصفحات. الهدف هو مساعدة محركات البحث على فهم صفحاتك بشكل أفضل، ورفع جودة التجربة للزائر، بما ينعكس على ترتيب الموقع وتحسين فرص التحويل من الزيارات العضوية.', 'linkawy'); ?></p>
                </div>

                <!-- Card 5: Off-Page SEO -->
                <div class="program-card">
                    <div class="icon-box">
                        <?php echo linkawy_icon('Link', 24); ?>
                    </div>
                    <h3><?php esc_html_e('السيو الخارجي', 'linkawy'); ?></h3>
                    <span class="service-subtitle">Off-Page SEO</span>
                    <p><?php esc_html_e('نعزز حضور موقعك خارج نطاقه الداخلي عبر استراتيجيات السيو الخارجي، وعلى رأسها بناء روابط خلفية عالية الجودة من مواقع موثوقة وذات صلة. يساعد ذلك في رفع موثوقية موقعك أمام محركات البحث، وتحسين ترتيبه، وتوسيع انتشاره الرقمي على المستوى المحلي أو الإقليمي.', 'linkawy'); ?></p>
                </div>

                <!-- Card 6: SEO Audits -->
                <div class="program-card">
                    <div class="icon-box">
                        <?php echo linkawy_icon('ScanSearch', 24); ?>
                    </div>
                    <h3><?php esc_html_e('فحص مشاكل الموقع', 'linkawy'); ?></h3>
                    <span class="service-subtitle">SEO Audits</span>
                    <p><?php esc_html_e('نقدم تدقيقًا شاملًا لموقعك للكشف عن المشكلات التي تؤثر على ظهوره في نتائج البحث، سواء كانت تقنية، أو مرتبطة بسرعة الموقع، أو الفهرسة، أو المحتوى، أو الروابط. ثم نضع لك صورة واضحة عن نقاط الضعف والفرص، مع توصيات عملية تساعدك على تحسين الأداء بفعالية، ويشمل الفحص تحليل منافسين سرعة الموقع تحسين الأداء.', 'linkawy'); ?></p>
                </div>

                <!-- Card 7: SEO Consulting -->
                <div class="program-card">
                    <div class="icon-box">
                        <?php echo linkawy_icon('Lightbulb', 24); ?>
                    </div>
                    <h3><?php esc_html_e('استشارات SEO', 'linkawy'); ?></h3>
                    <span class="service-subtitle">SEO Consulting</span>
                    <p><?php esc_html_e('نوفر استشارات SEO عملية تناسب طبيعة مشروعك ومرحلة نموه، سواء كنت تبدأ من الصفر أو تسعى لتطوير نتائجك الحالية. نساعدك في بناء رؤية واضحة، تحليل الكلمات، تحليل المنافسين، تحديد الأولويات، واختيار الخطوات التي تمنحك أفضل فرصة للظهور وتحقيق نمو حقيقي عبر محركات البحث.', 'linkawy'); ?></p>
                </div>

                <!-- Card 8: Technical SEO -->
                <div class="program-card">
                    <div class="icon-box">
                        <?php echo linkawy_icon('Code', 24); ?>
                    </div>
                    <h3><?php esc_html_e('السيو التقني', 'linkawy'); ?></h3>
                    <span class="service-subtitle">Technical SEO</span>
                    <p><?php esc_html_e('نحسن الجوانب التقنية في موقعك لضمان توافقه مع متطلبات محركات البحث وسهولة الزحف والفهرسة. يشمل ذلك تحسين سرعة الموقع، تجربة الجوال، الأمان، بنية الروابط، والهيكلة التقنية للموقع، بما يساهم في رفع كفاءة الموقع وتحسين فرص ظهوره وترتيبه في النتائج، مع تحليل منافسين سرعة الموقع تحسين الأداء.', 'linkawy'); ?></p>
                </div>

                <!-- Card 8: GEO / AI SEO -->
                <div class="program-card">
                    <div class="icon-box">
                        <?php echo linkawy_icon('Sparkles', 24); ?>
                    </div>
                    <h3><?php esc_html_e('سيو الذكاء الإصطناعي', 'linkawy'); ?></h3>
                    <span class="service-subtitle">GEO</span>
                    <p><?php esc_html_e('نساعدك على تهيئة محتوى موقعك ليظهر بشكل أفضل في محركات الإجابة وتجارب البحث المعتمدة على الذكاء الاصطناعي. نركز على بناء محتوى واضح، موثوق، ومنظم يسهل فهمه واقتباسه، بما يعزز فرص ظهور علامتك التجارية في النتائج التفسيرية والإجابات المباشرة.', 'linkawy'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- SEO Proof Section -->
    <section class="seo-proof-section" data-surface="cream">
        <div class="section-container">
            <h2 class="section-title"><?php esc_html_e('في المتوسط ساعدنا عملائنا في زيادة المبيعات العضوية لأكثر من', 'linkawy'); ?> <span class="highlight">270%</span> <?php esc_html_e('عن طريق الزيارات المستهدفة من Google و ChatGPT', 'linkawy'); ?></h2>
            <div class="seo-image-container glass-card">
                <video class="js-lazy-video" muted loop playsinline preload="none" width="748" height="300" data-poster="<?php echo get_template_directory_uri(); ?>/assets/images/results/gsc-proof-poster.webp" data-src="<?php echo get_template_directory_uri(); ?>/assets/images/results/gsc-proof.mp4" aria-label="<?php esc_attr_e('لقطة من Google Search Console توضح نمو الزيارات العضوية والنقرات بعد تطبيق استراتيجيات أفضل شركة سيو لينكاوي', 'linkawy'); ?>"></video>
                <script>
                /* Lazy video: load poster + mp4 only near the viewport; play only if motion is allowed. */
                (function () {
                    var v = document.currentScript.previousElementSibling;
                    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                    function start() {
                        v.poster = v.getAttribute('data-poster');
                        if (reduce) { return; }
                        v.src = v.getAttribute('data-src');
                        var p = v.play();
                        if (p && p.catch) { p.catch(function () {}); }
                    }
                    if (!('IntersectionObserver' in window)) { start(); return; }
                    var io = new IntersectionObserver(function (entries) {
                        if (entries[0].isIntersecting) { io.disconnect(); start(); }
                    }, { rootMargin: '300px 0px' });
                    io.observe(v);
                })();
                </script>
            </div>
        </div>
    </section>

    <div class="lk-sunset lk-sunset--up" aria-hidden="true"><img src="<?php echo esc_url(LINKAWY_URI . '/assets/images/ds/sunset-cream-to-dark.webp'); ?>" alt="" width="1920" height="406" loading="lazy" decoding="async"></div>

    <!-- Strategy Section (كيف نحقق نتائج تنعكس على المبيعات؟) -->
    <section class="strategy-section strategy-section--dark" id="services">
        <div class="section-container">
            <div class="strategy-grid">
                <div class="strategy-intro">
                    <h2><?php esc_html_e('تحسين محركات البحث...', 'linkawy'); ?> <br><span><?php esc_html_e('هو آخر خطوة عندنا', 'linkawy'); ?></span></h2>
                    <p class="description-text"><?php esc_html_e('لأن أولويتنا هي زيادة مبيعاتك، خطوات عملنا تبدأ من البيزنس وتنتهي بالتسويق.', 'linkawy'); ?></p>
                    <p class="description-text"><?php esc_html_e('نستخدم أحدث استراتيجيات النمو لرفع معدل التحويل، وزيادة عدد العملاء المؤهلين، وخفض تكلفة اكتساب العميل عبر المحتوى وتحسين رحلة المستخدم. والنتائج؟ تقدر تشوفها بنفسك تحت وتحكم!', 'linkawy'); ?></p>
                    <p class="highlight-text"><?php esc_html_e('باستخدام تلك الإستراتيجية نهدف إلى تحويل من', 'linkawy'); ?> <span class="highlight">100%</span> <?php esc_html_e('من زوار موقعك إلى عملاء جاهزين للشراء.', 'linkawy'); ?></p>
                </div>
                <div class="accordion">
                    <div class="accordion-item active" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">01</span>
                                <h3><?php esc_html_e('تحليل السوق، والمنافسين، ونوايا الشراء', 'linkawy'); ?></h3>
                            </div>
                            <div class="accordion-icon"><?php echo linkawy_icon('ChevronDown', 18); ?></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner"><?php esc_html_e('نبدأ بفهم السوق، تحليل الكلمات التي تعكس نية شراء حقيقية، والأسئلة التي يبحث عنها العميل قبل اتخاذ قرار الشراء.', 'linkawy'); ?></div>
                        </div>
                    </div>
                    <div class="accordion-item" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">02</span>
                                <h3><?php esc_html_e('هندسة صفحات البيع ورفع معدلات التحويل', 'linkawy'); ?></h3>
                            </div>
                            <div class="accordion-icon"><?php echo linkawy_icon('ChevronDown', 18); ?></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner"><?php esc_html_e('نقوم بتحسين صفحات الهبوط لتكون مقنعة بصرياً ونصياً، مما يزيد من نسبة تحويل الزوار إلى مشترين فعليين.', 'linkawy'); ?></div>
                        </div>
                    </div>
                    <div class="accordion-item" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">03</span>
                                <h3><?php esc_html_e('صناعة محتوى يبيع القيمة', 'linkawy'); ?></h3>
                            </div>
                            <div class="accordion-icon"><?php echo linkawy_icon('ChevronDown', 18); ?></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner"><?php esc_html_e('نركز على إنشاء محتوى يجيب على أسئلة العملاء ويعالج اعتراضاتهم، مما يدفعهم لاتخاذ قرار الشراء بدلاً من مجرد جذب الزيارات غير المفيدة.', 'linkawy'); ?></div>
                        </div>
                    </div>
                    <div class="accordion-item" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">04</span>
                                <h3><?php esc_html_e('التحسين لمحركات البحث والذكاء الاصطناعي', 'linkawy'); ?></h3>
                            </div>
                            <div class="accordion-icon"><?php echo linkawy_icon('ChevronDown', 18); ?></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner"><?php esc_html_e('نعمل على تحسين البنية التقنية للموقع وملاءمته لمعايير محركات البحث (SEO) وأنظمة الذكاء الاصطناعي الحديثة لضمان أقصى وصول عضوي.', 'linkawy'); ?></div>
                        </div>
                    </div>
                    <div class="accordion-item" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">05</span>
                                <h3><?php esc_html_e('قياس الربحية.. وليس الترتيب', 'linkawy'); ?></h3>
                            </div>
                            <div class="accordion-icon"><?php echo linkawy_icon('ChevronDown', 18); ?></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner"><?php esc_html_e('نركز في تقاريرنا على المقاييس التي تترجم مباشرة إلى أرباح (مثل العائد على الإنفاق الإعلاني ROAS)، بدلاً من التركيز على مؤشرات الغرور (Vanity Metrics) كالترتيب أو حجم الزيارات.', 'linkawy'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- شركاء النجاح -->
    <section class="partners-section">
        <div class="partners-container">
            <h2 class="partners-title"><?php esc_html_e('شركاء النجاح:', 'linkawy'); ?></h2>
            <div class="partners-marquee">
                <div class="partners-track">
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/dinar.svg" alt="Dinar" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/asharq.svg" alt="Asharq" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/move.svg" alt="Move" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/alyom.svg" alt="Alyom" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/inspire.svg" alt="Inspire" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/francis.svg" alt="Francis" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/aswaq.svg" alt="Aswaq" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/reef.svg" alt="Reef" loading="lazy" width="120" height="40"></div>
                    <!-- Duplicate set for seamless marquee loop -->
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/dinar.svg" alt="Dinar" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/asharq.svg" alt="Asharq" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/move.svg" alt="Move" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/alyom.svg" alt="Alyom" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/inspire.svg" alt="Inspire" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/francis.svg" alt="Francis" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/aswaq.svg" alt="Aswaq" loading="lazy" width="120" height="40"></div>
                    <div class="partners-item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/clients/reef.svg" alt="Reef" loading="lazy" width="120" height="40"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- قصص نجاح المتاجر -->
    <?php
    $success_args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    );
    $success_args = linkawy_front_page_merge_tax_query_args(
        $success_args,
        'linkawy_front_success_category',
        'linkawy_front_success_tag'
    );
    $success_stories = new WP_Query($success_args);
    
    if ($success_stories->have_posts()) :
    ?>
    <section class="success-stories-section" data-surface="dark">
        <div class="container">
            <div class="success-stories-header">
                <h2 class="success-stories-title"><?php esc_html_e('قصص نجاح المتاجر', 'linkawy'); ?></h2>
                <a href="<?php echo esc_url(linkawy_get_front_page_section_archive_url('linkawy_front_success_category', 'linkawy_front_success_tag')); ?>" class="success-stories-link">
                    <?php esc_html_e('المزيد من قصص النجاح', 'linkawy'); ?>

                </a>
            </div>
            
            <div class="success-stories-grid">
                <?php
                // Cycle: Purple Blue → Teal Green → Green Lime (reusing theme card gradients)
                $story_gradients      = linkawy_get_card_gradients();
                $story_palette        = array('purple', 'emerald', 'green');
                $story_color_index    = 0;
                while ($success_stories->have_posts()) : $success_stories->the_post();
                    $story_key        = $story_palette[$story_color_index % 3];
                    $story_bg         = isset($story_gradients[$story_key]['value']) ? $story_gradients[$story_key]['value'] : $story_gradients['purple']['value'];
                    $story_color_index++;
                ?>
                <article class="success-story-card">
                    <div class="story-card-image" style="--card-bg: <?php echo esc_attr($story_bg); ?>;">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php 
                            // Use linkawy-card size (400px) with proper sizes attribute
                            // Grid: 3col desktop, 2col tablet, 1col mobile
                            the_post_thumbnail('linkawy-card', array(
                                'loading' => 'lazy',
                                'sizes' => '(max-width: 768px) calc(100vw - 2rem), (max-width: 1023px) calc(50vw - 2rem), 380px'
                            )); 
                            ?>
                        <?php endif; ?>
                    </div>
                    <div class="story-card-content">
                        <h3 class="story-card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <p class="story-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <span class="story-card-meta"><?php echo esc_html(linkawy_reading_time()); ?></span>
                    </div>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Process Section -->
    <section class="process-section fp-scroll-anchor" id="كيف-نعمل" data-surface="white">
        <div class="process-container">
            <!-- Left Column: Sticky Info -->
            <div class="process-sticky-col">
                <h2 class="process-subtitle"><?php esc_html_e('كيف يتصدر موقعك النتائج الأولى على محركات البحث عن طريق شركة سيو لينكاوي؟', 'linkawy'); ?></h2>

                <p class="process-description fp-process-desc"><?php esc_html_e('الخطوة الأولى نحو النجاح الرقمي تبدأ من هنا! عند تعاونك مع أفضل شركة سيو، نتبع خطوات مدروسة لضمان تحسين ترتيب موقعك في محركات البحث وتحقيق نتائج ملموسة.', 'linkawy'); ?></p>

                <div class="fp-mt-2">
                    <a href="#contact" class="cta-button"><?php esc_html_e('ابدأ الآن', 'linkawy'); ?></a>
                </div>
            </div>

            <!-- Right Column: Timeline -->
            <div class="process-timeline-col">
                <div class="timeline-list">

                    <!-- Step 1 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><?php echo linkawy_icon('ScanSearch', 22); ?></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge"><?php esc_html_e('الخطوة الأولى', 'linkawy'); ?></span>
                            <h3 class="timeline-title"><?php esc_html_e('نحلل موقعك لنكتشف فرص النمو', 'linkawy'); ?></h3>
                            <p class="timeline-desc"><?php esc_html_e('نراجع موقعك بالكامل، نحدد نقاط القوة والضعف، ونكتشف أين تضيع عليك الزيارات والفرص قبل منافسيك عبر تحليل منافسين سرعة الموقع تحسين الأداء.', 'linkawy'); ?></p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><?php echo linkawy_icon('Search', 22); ?></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge"><?php esc_html_e('الخطوة الثانية', 'linkawy'); ?></span>
                            <h3 class="timeline-title"><?php esc_html_e('نختار الكلمات عبر تحليل الكلمات التي تجذب عملاء حقيقيين', 'linkawy'); ?></h3>
                            <p class="timeline-desc"><?php esc_html_e('لا نطارد كلمات بلا قيمة، بل نستهدف ما يبحث عنه عملاؤك فعلًا عندما يكونون مستعدين للشراء أو التواصل.', 'linkawy'); ?></p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><?php echo linkawy_icon('Compass', 22); ?></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge"><?php esc_html_e('الخطوة الثالثة', 'linkawy'); ?></span>
                            <h3 class="timeline-title"><?php esc_html_e('نبني استراتيجية سيو مصممة لك', 'linkawy'); ?></h3>
                            <p class="timeline-desc"><?php esc_html_e('نضع خطة واضحة تناسب نشاطك وأهدافك، تشمل المحتوى، الصفحات، والبنية التقنية — بدون حلول جاهزة.', 'linkawy'); ?></p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><?php echo linkawy_icon('Rocket', 22); ?></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge"><?php esc_html_e('الخطوة الرابعة', 'linkawy'); ?></span>
                            <h3 class="timeline-title"><?php esc_html_e('ننفّذ التحسينات ونحرّك النتائج', 'linkawy'); ?></h3>
                            <p class="timeline-desc"><?php esc_html_e('نبدأ التنفيذ العملي لتحسين موقعك ورفع ظهوره، خطوة بخطوة، حتى يتحول إلى قناة جذب فعّالة.', 'linkawy'); ?></p>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><?php echo linkawy_icon('ChartLine', 22); ?></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge"><?php esc_html_e('الخطوة الخامسة', 'linkawy'); ?></span>
                            <h3 class="timeline-title"><?php esc_html_e('نراقب الأداء ونحسّن باستمرار', 'linkawy'); ?></h3>
                            <p class="timeline-desc"><?php esc_html_e('نقيس النتائج، نراجع الأداء، ونعدّل الاستراتيجية باستمرار لضمان أفضل نمو ممكن.', 'linkawy'); ?></p>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><?php echo linkawy_icon('TrendingUp', 22); ?></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge"><?php esc_html_e('الخطوة السادسة', 'linkawy'); ?></span>
                            <h3 class="timeline-title"><?php esc_html_e('نتابع النتائج ونبني نموًا مستدامًا', 'linkawy'); ?></h3>
                            <p class="timeline-desc"><?php esc_html_e('نقدم تقارير واضحة، وخطة طويلة المدى تضمن استمرار التقدم وتفوّقك في نتائج البحث.', 'linkawy'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Linkawy Section (9 Reasons) -->
    <section id="why-linkawy" class="problems-section reasons-section" data-surface="cream">
        <div class="container">
            <div class="section-header">
                <h2><?php esc_html_e('9 أسباب لاختيار أفضل شركة سيو لينكاوي', 'linkawy'); ?></h2>
            </div>

            <div class="problems-grid reasons-grid">
                <!-- Card 1 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">1.</span>
                    </div>
                    <h3><?php esc_html_e('خبرة عابرة للقارات', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('نمتلك سجلًا حافلاً يمتد لأكثر من 12 عاماً في تقديم خدمات تحسين محركات البحث (SEO) في أسواق تنافسية مثل الإمارات، السعودية، وأمريكا. نحن شركة سيو لا نطبق استراتيجيات عامة، بل ننقل لك خبرات عالمية في تصدر نتائج البحث الأولى.', 'linkawy'); ?></p>
                </div>

                <!-- Card 2 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">2.</span>
                    </div>
                    <h3><?php esc_html_e('تحليل الكلمات المفتاحية الأكثر ربحية', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('نبتعد عن الحلول التقليدية؛ حيث نبدأ عملنا بـ تحليل الكلمات المفتاحية (Keyword Analysis) بدقة لنستهدف العبارات التي تجلب لك "عملاء" وليس مجرد "زيارات". هدفنا هو رفع معدل التحويل (Conversion Rate) وضمان أعلى عائد على الاستثمار.', 'linkawy'); ?></p>
                </div>

                <!-- Card 3 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">3.</span>
                    </div>
                    <h3><?php esc_html_e('نتائج موثقة في زيادة الظهور الرقمي', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('نجاحنا يُقاس بالأرقام. لدينا قائمة من قصص النجاح في زيادة حركة المرور المجانية (Organic Traffic) لشركات كبرى، حيث ساعدناهم في القفز إلى الصفحة الأولى في محركات البحث، مما أدى لزيادة ملموسة في المبيعات والانتشار.', 'linkawy'); ?></p>
                </div>

                <!-- Card 4 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">4.</span>
                    </div>
                    <h3><?php esc_html_e('تحسين السيو التقني (Technical SEO) بالكامل', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('نقوم بضبط كل تفاصيل موقعك "خلف الكواليس". من تحسين سرعة الموقع، وضبط بنية البيانات (Schema Markup)، إلى تحسين تجربة المستخدم (UX)، لضمان زحف عناكب محركات البحث وأرشفة صفحاتك بأفضل صورة ممكنة.', 'linkawy'); ?></p>
                </div>

                <!-- Card 5 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">5.</span>
                    </div>
                    <h3><?php esc_html_e('تقارير أداء دورية وشفافية مطلقة', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('في لينكاوي، نحن شركة سيو نؤمن بالوضوح. ستحصل على تقارير مفصلة لمراقبة أداء تحليل الكلمات المفتاحية ووضع الروابط، وتتواصل مباشرة مع خبير السيو المهندس علي عطوة وفريق العمل لمناقشة تطورات المشروع دون أي تعقيدات إدارية.', 'linkawy'); ?></p>
                </div>

                <!-- Card 6 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">6.</span>
                    </div>
                    <h3><?php esc_html_e('مواكبة مستمرة لـ "تحديثات خوارزميات محركات البحث"', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('عالم السيو متغير، ونحن نراقب خوارزميات محركات البحث (Google Algorithms) لحظة بلحظة. نقوم بتعديل خططنا باستمرار لضمان حماية موقعك من أي تراجعات، مع التركيز على استراتيجيات White Hat SEO بعيداً عن أي ممارسات قد تضر موقعك.', 'linkawy'); ?></p>
                </div>

                <!-- Card 7 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">7.</span>
                    </div>
                    <h3><?php esc_html_e('بناء روابط قوية (Backlinks) واستراتيجية محتوى', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('لا نكتفي بالتحسين الداخلي فقط، بل نركز على بناء الروابط (Link Building) من مواقع ذات سلطة عالية (High DA)، بالتوازي مع تسويق بالمحتوى احترافي يجعل من موقعك مرجعاً في مجالك ويقوي "سلطة النطاق" (Domain Authority) لديك.', 'linkawy'); ?></p>
                </div>

                <!-- Card 8 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">8.</span>
                    </div>
                    <h3><?php esc_html_e('استشارات مباشرة من خبير السيو الأول', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('الميزة التنافسية في "لينكاوي" كـ شركة سيو هي أنك تتعامل مع العقل المدبر مباشرة. المهندس علي عطوة يضع خبرته الطويلة بين يديك عبر استشارات فنية متخصصة تضمن لك اتخاذ قرارات تسويقية ذكية مبنية على بيانات حقيقية.', 'linkawy'); ?></p>
                </div>

                <!-- Card 9 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">9.</span>
                    </div>
                    <h3><?php esc_html_e('تدريب فريقك على ممارسات السيو المستدام', 'linkawy'); ?></h3>
                    <p><?php esc_html_e('نحن شركة سيو نبني معك نظاماً يدوم؛ حيث نحرص على تدريب فريقك على أساسيات كتابة المحتوى المتوافق مع السيو وكيفية الحفاظ على النتائج المحققة، لضمان استمرارية تصدرك للمنافسين حتى على المدى الطويل.', 'linkawy'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="container">
            <div class="benefits-inner-container">
                <div class="section-header center-text">
                    <h2><?php esc_html_e('نقود مشروعك نحو صدارة محركات البحث وتعظيم العائد في 3 خطوات', 'linkawy'); ?></h2>
                </div>

                <div class="benefits-grid">
                    <!-- Text Column -->
                    <div class="benefits-content">
                        <div class="benefit-item" data-target="img-1">
                            <div class="benefit-text-wrap">
                                <h3><?php esc_html_e('1. فهم السوق والجمهور', 'linkawy'); ?></h3>
                                <p><?php esc_html_e('هذه الخطوة تساعدنا على اكتشاف الفرص الأقوى، وتحديد ما يبحث عنه عملاؤك المحتملون، وبناء أساس صحيح يجعل الزيارات القادمة إلى موقعك أكثر قيمة وقابلية للتحول إلى مبيعات.', 'linkawy'); ?></p>
                            </div>
                        </div>

                        <div class="benefit-item" data-target="img-2">
                            <div class="benefit-text-wrap">
                                <h3><?php esc_html_e('2. خطة سيو  واضحة الأهداف', 'linkawy'); ?></h3>
                                <p><?php esc_html_e('نحن لا نسعى إلى زيادة الأرقام شكليًا، بل نركز على جذب زيارات مؤهلة تحمل نية حقيقية، لأن الزيارة التي يمكن أن تتحول إلى عميل أهم بكثير من أي رقم بلا أثر.', 'linkawy'); ?></p>
                            </div>
                        </div>

                        <div class="benefit-item" data-target="img-3">
                            <div class="benefit-text-wrap">
                                <h3><?php esc_html_e('3. نتائج تنمو يومًا بعد يوم', 'linkawy'); ?></h3>
                                <p><?php esc_html_e('السيو ليس نتيجة لحظية، بل مسار نمو تراكمي يزداد أثره مع الوقت. لذلك نعمل على تحقيق نمو شهري مستمر في الزيارات العضوية، مع تحسين فرص التحويل ورفع جودة الوصول إلى الجمهور المناسب.', 'linkawy'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="benefits-images">
                        <div class="benefit-img active" id="img-1">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/growth/seo-product-research.png"
                                alt="<?php esc_attr_e('تحليل سوق وجمهور ومتجر إلكتروني ضمن استراتيجية سيو لفهم سلوك البحث في محركات البحث', 'linkawy'); ?>" loading="lazy" width="400" height="300">
                            <p class="benefit-img-caption"><?php esc_html_e('نبدأ بدراسة نشاطك التجاري والسوق الذي تنافس فيه، مع فهم الفئة المستهدفة واحتياجاتها وطريقة بحثها الفعلية في محركات البحث، كأساس لاستراتيجية سيو تركز على النمو.', 'linkawy'); ?></p>
                        </div>
                        <div class="benefit-img" id="img-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/growth/seo-marketing-plan.webp"
                                alt="<?php esc_attr_e('تخطيط استراتيجية سيو لتحسين الظهور في نتائج البحث واستهداف كلمات مرتبطة بقرار الشراء', 'linkawy'); ?>" loading="lazy" width="400" height="300">
                            <p class="benefit-img-caption"><?php esc_html_e('بعد فهم السوق والجمهور، نضع خطة ضمن استراتيجية سيو مدروسة تستهدف تحسين ظهور موقعك في الكلمات المفتاحية الأكثر ارتباطًا بقرار الشراء.', 'linkawy'); ?></p>
                        </div>
                        <div class="benefit-img" id="img-3">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/growth/sales-growth-dashboard.png"
                                alt="<?php esc_attr_e('لوحة مؤشرات لزيادة الزيارات العضوية والمبيعات بعد تطبيق استراتيجية سيو', 'linkawy'); ?>" loading="lazy" width="400" height="300">
                            <p class="benefit-img-caption"><?php esc_html_e('مع هذا التقدم المنتظم في استراتيجية سيو، تبدأ النتائج بالظهور بشكل أوضح على مستوى الطلبات والمبيعات والنمو التجاري.', 'linkawy'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php /* English has no posts yet: hide the blog section there. */ if (!linkawy_is_en()) : ?>
    <section class="blog-posts-section" data-surface="cream">
        <div class="blog-posts-container">
            <div class="blog-posts-header">
                <div class="blog-posts-header-text">
                    <h2><?php esc_html_e('أحدث المقالات من المدونة', 'linkawy'); ?></h2>
                    <p><?php esc_html_e('نشارك معكم آخر التحديثات والاستراتيجيات في عالم تحسين محركات البحث.', 'linkawy'); ?></p>
                </div>
                <a href="<?php echo esc_url(linkawy_get_front_page_section_archive_url('linkawy_front_blog_category', 'linkawy_front_blog_tag')); ?>" class="blog-posts-btn">
                    <?php esc_html_e('تصفح كل المقالات', 'linkawy'); ?>
                    <?php echo linkawy_icon('ArrowRight', 16); ?>
                </a>
            </div>

            <div class="blog-posts-grid">
                <?php
                $blog_args = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $blog_args = linkawy_front_page_merge_tax_query_args(
                    $blog_args,
                    'linkawy_front_blog_category',
                    'linkawy_front_blog_tag'
                );
                $blog_query = new WP_Query($blog_args);

                $all_gradients = linkawy_get_card_gradients();
                // Cycle: Yellow Green → Pink Rose → Orange Coral (reusing theme card gradients)
                $blog_palette      = array('lime', 'pink', 'orange');
                $blog_color_index  = 0;

                if ($blog_query->have_posts()) :
                    while ($blog_query->have_posts()) : $blog_query->the_post();
                        $categories    = get_the_category();
                        $category_name = !empty($categories) ? $categories[0]->name : '';

                        $card_color_key = $blog_palette[$blog_color_index % 3];
                        $card_gradient  = isset($all_gradients[$card_color_key]['value']) ? $all_gradients[$card_color_key]['value'] : $all_gradients['orange']['value'];
                        $blog_color_index++;
                ?>
                <a href="<?php the_permalink(); ?>" class="blog-post-card">
                    <div class="blog-post-image" style="--card-gradient: <?php echo esc_attr($card_gradient); ?>;">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php // Far below the fold: override WP's auto fetchpriority=high / eager on the first images
                            the_post_thumbnail('medium_large', array('loading' => 'lazy', 'fetchpriority' => 'low', 'decoding' => 'async')); ?>
                        <?php endif; ?>
                        <?php if ($category_name) : ?>
                            <span class="blog-post-category-badge"><?php echo esc_html($category_name); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="blog-post-content">
                        <h3><?php the_title(); ?></h3>
                        <p class="story-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                        <div class="story-card-meta blog-post-card-meta">
                            <span class="blog-post-meta-author">
                                <?php
                                // صورة الكاتب من «معلومات Linkawy الإضافية» (_author_avatar / _author_avatar_id) مع احتياطي Gravatar
                                echo linkawy_get_author_avatar_img(
                                    (int) get_the_author_meta('ID'),
                                    32,
                                    'blog-post-author-avatar avatar'
                                );
                                ?>
                                <span class="blog-post-meta-name"><?php echo esc_html(get_the_author()); ?></span>
                            </span>
                            <span class="blog-post-meta-sep" aria-hidden="true">·</span>
                            <span class="blog-post-meta-read"><?php echo esc_html(linkawy_reading_time()); ?></span>
                        </div>
                    </div>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>

    <!-- About / Intro Section -->
    <section class="about-section" data-surface="white">
        <div class="container about-container">
            <div class="about-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ali-atwa-seo-consulting.webp" alt="<?php esc_attr_e('استشارات سيو', 'linkawy'); ?>" width="500" height="600" loading="lazy">
            </div>
            <div class="about-content">
                <span class="about-label"><?php esc_html_e('أهلًا بالمؤسس', 'linkawy'); ?></span>
                <h2><?php esc_html_e('استشارات أفضل شركة سيو برؤية بيزنس', 'linkawy'); ?></h2>
                <p><?php esc_html_e('ندرك حجم الضغط الذي تواجهه كمؤسس وأنت ترى ميزانيتك تُستنزف في الإعلانات، لذا صممنا هذه الـ استشارات سيو لتخرجك من مصيدة \'الدفع مقابل الظهور\' والتحسينات الشكلية. من خلال العمل مباشرة مع خبير سيو يمتلك رؤية بيزنس، ستُمنح منهجية استراتيجية نقلت شركات ناشئة من مجرد التواجد إلى الهيمنة عبر الزيارات المجانية.', 'linkawy'); ?></p>
                <a href="#contact" class="cta-button"><?php esc_html_e('اطلب استشارة سيو', 'linkawy'); ?></a>
            </div>
        </div>
    </section>

    <section class="seo-faq-section" id="seo-faq" data-surface="white">
        <div class="seo-faq-container">
            <div class="seo-faq-header">
                <h2><?php esc_html_e('الأسئلة الشائعة', 'linkawy'); ?></h2>
            </div>

            <div class="seo-faq-grid">
                <!-- العمود الأول -->
                <div class="seo-faq-column">
                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('ما هي خدمات تحسين محركات البحث (SEO) التي تقدمونها؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('نقدم مجموعة شاملة من خدمات السيو تشمل: التحسين الداخلي (On-Page SEO)، التحسين الخارجي وبناء الروابط (Off-Page SEO)، السيو التقني (Technical SEO)، تحسين المحتوى، تحليل الكلمات المفتاحية، تحسين سيو المتاجر الإلكترونية على شوبيفاي وسلة وزد، بالإضافة إلى استشارات السيو المتخصصة.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('كم من الوقت يستغرق تحسين ترتيب موقعي في نتائج البحث؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('تحسين محركات البحث عملية تراكمية وليست فورية. عادةً تبدأ النتائج الملموسة بالظهور خلال 3 إلى 6 أشهر من بدء العمل، وتتحسن بشكل مستمر مع مرور الوقت. النتائج تعتمد على حالة الموقع الحالية، المنافسة في المجال، وحجم العمل المطلوب.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('هل تقدمون خدمات السيو للمتاجر الإلكترونية؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('نعم، نحن متخصصون في تحسين محركات البحث للمتاجر الإلكترونية على مختلف المنصات مثل شوبيفاي وسلة وزد ووكومرس. نعمل على تحسين صفحات المنتجات والتصنيفات والبنية التقنية للمتجر لزيادة الزيارات العضوية وتحويلها إلى مبيعات حقيقية.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('ما الفرق بين السيو الداخلي والسيو الخارجي؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('السيو الداخلي (On-Page) يركز على تحسين عناصر الموقع نفسه مثل المحتوى، العناوين، الوصف، الصور، والروابط الداخلية. أما السيو الخارجي (Off-Page) فيركز على بناء سمعة الموقع خارجياً من خلال الروابط الخلفية (Backlinks) من مواقع موثوقة، والعلاقات العامة الرقمية، والإشارات الاجتماعية.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('كيف يتم تحديد سعر خدمة السيو؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('يعتمد التسعير على عدة عوامل منها: حجم الموقع وعدد صفحاته، مستوى المنافسة في المجال، حالة الموقع التقنية الحالية، الأهداف المطلوب تحقيقها، ونطاق العمل. نقدم عروض أسعار مخصصة بعد تحليل دقيق لموقعك ومتطلباتك.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- العمود الثاني -->
                <div class="seo-faq-column">
                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('هل يمكنكم ضمان تصدر موقعي للنتيجة الأولى في محركات البحث؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('لا يمكن لأي شركة سيو محترفة ضمان المرتبة الأولى بشكل مطلق، لأن خوارزميات محركات البحث تتغير باستمرار. لكننا نضمن لك تطبيق أفضل الممارسات العالمية، واستراتيجيات مدروسة تحقق نمواً ملموساً في الترتيب والزيارات والمبيعات بشكل مستدام.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('ما أهمية بناء الروابط الخلفية (Backlinks) للسيو؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('الروابط الخلفية من أهم عوامل ترتيب محركات البحث. كل رابط من موقع موثوق يُعتبر بمثابة "تصويت ثقة" لموقعك. نحن نبني روابط عالية الجودة من مواقع ذات سلطة عالية (High Domain Authority) بطرق آمنة تتوافق مع إرشادات محركات البحث لتعزيز ترتيب موقعك بشكل دائم.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('هل تقدمون تقارير أداء دورية لمتابعة تقدم المشروع؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('نعم، نوفر تقارير أداء تفصيلية بشكل شهري تشمل: تطور ترتيب الكلمات المفتاحية، حجم الزيارات العضوية، تحليل الروابط المبنية، أداء الصفحات، ومعدلات التحويل. كما يمكنك التواصل مباشرة مع فريق العمل لمناقشة أي تفاصيل في أي وقت.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('ما هو السيو التقني وهل يحتاجه موقعي؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('السيو التقني يعالج البنية التحتية للموقع لتسهيل زحف وفهرسة محركات البحث. يشمل تحسين سرعة الموقع، التوافق مع الجوال، بنية الروابط، خرائط الموقع (Sitemap)، ملف Robots.txt، وبيانات Schema المنظمة. كل موقع يحتاج سيو تقني سليم كأساس لأي استراتيجية سيو ناجحة، مع تحليل منافسين سرعة الموقع تحسين الأداء.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3><?php esc_html_e('كيف يتم قياس نجاح استراتيجية السيو؟', 'linkawy'); ?></h3>
                            <span class="seo-faq-toggle"><?php echo linkawy_icon('Plus', 20); ?></span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                <?php esc_html_e('نقيس النجاح من خلال مؤشرات أداء حقيقية تشمل: نمو الزيارات العضوية، تحسن ترتيب الكلمات المفتاحية المستهدفة، زيادة معدلات التحويل والمبيعات، تحسن سلطة النطاق (Domain Authority)، والعائد على الاستثمار (ROI). نركز على المقاييس التي تترجم مباشرة إلى إيرادات وليس مجرد أرقام.', 'linkawy'); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    (function() {
        document.addEventListener('DOMContentLoaded', function() {
            var faqItems = document.querySelectorAll('.seo-faq-item');
            
            faqItems.forEach(function(item) {
                var question = item.querySelector('.seo-faq-question');
                var answer = item.querySelector('.seo-faq-answer');
                var answerInner = item.querySelector('.seo-faq-answer-inner');
                
                question.addEventListener('click', function() {
                    var isActive = item.classList.contains('active');
                    
                    // Close all items
                    faqItems.forEach(function(otherItem) {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.seo-faq-answer').style.maxHeight = '0';
                    });
                    
                    // Toggle clicked item
                    if (!isActive) {
                        item.classList.add('active');
                        answer.style.maxHeight = answerInner.scrollHeight + 24 + 'px';
                    }
                });
            });
        });
    })();
    </script>

    <!-- Results Section (proof) — redesign: after the FAQ, per the UI kit order -->
    <section class="results-section" id="results-proof" data-surface="cream-warm">
        <div class="section-container">
            <div class="section-header results-header">
                <span class="results-live-badge"><span class="results-live-dot"></span>LIVE RESULTS</span>
                <h2 class="section-title results-title"><?php esc_html_e('نتائج SEO', 'linkawy'); ?></h2>
                <p class="results-desc"><?php esc_html_e('شاهد النتائج من داخل الحسابات والمتاجر', 'linkawy'); ?></p>
            </div>

            <!-- Slider -->
            <div class="swiper resultsSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-1.webp" class="result-image" alt="<?php esc_attr_e('لقطة من Google Search Console توضح مؤشرات الأداء والزيارات العضوية بعد تطبيق سيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-2.webp" class="result-image" alt="<?php esc_attr_e('لقطة من لوحة تحليلات متجر إلكتروني تظهر أداء الزيارات والمبيعات ضمن نتائج تحسين السيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-3.webp" class="result-image" alt="<?php esc_attr_e('لقطة من Google Search Console لمراجعة تغطية الفهرسة والظهور في نتائج البحث بعد العمل على السيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-4.webp" class="result-image" alt="<?php esc_attr_e('لقطة من لوحة تحليلات متجر على منصة سلة توضح مؤشرات الزيارات والأداء بعد تحسين سيو المتجر', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-5.webp" class="result-image" alt="<?php esc_attr_e('لقطة أخرى من لوحة تحليلات متجر سلة تبين تطور الأداء والزيارات في إطار استراتيجية سيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-6.webp" class="result-image" alt="<?php esc_attr_e('لقطة من Google Search Console تعرض تقارير الأداء ونمو الزيارات من محركات البحث بعد السيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>

                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-1.webp" class="result-image" alt="<?php esc_attr_e('لقطة من Google Search Console توضح مؤشرات الأداء والزيارات العضوية بعد تطبيق سيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-2.webp" class="result-image" alt="<?php esc_attr_e('لقطة من لوحة تحليلات متجر إلكتروني تظهر أداء الزيارات والمبيعات ضمن نتائج تحسين السيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-3.webp" class="result-image" alt="<?php esc_attr_e('لقطة من Google Search Console لمراجعة تغطية الفهرسة والظهور في نتائج البحث بعد العمل على السيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-4.webp" class="result-image" alt="<?php esc_attr_e('لقطة من لوحة تحليلات متجر على منصة سلة توضح مؤشرات الزيارات والأداء بعد تحسين سيو المتجر', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-5.webp" class="result-image" alt="<?php esc_attr_e('لقطة أخرى من لوحة تحليلات متجر سلة تبين تطور الأداء والزيارات في إطار استراتيجية سيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-6.webp" class="result-image" alt="<?php esc_attr_e('لقطة من Google Search Console تعرض تقارير الأداء ونمو الزيارات من محركات البحث بعد السيو', 'linkawy'); ?>" loading="lazy" decoding="async"></div>
                </div>
            </div>

            <!-- Navigation Arrows: 20px below slider -->
            <div class="results-nav-arrows flex items-center justify-center gap-3 mt-5 md:mt-6" dir="ltr">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <!-- CTA: 40px below arrows -->
            <div class="text-center mt-8 md:mt-10">
                <a href="#contact" class="btn-cyber" data-link><?php esc_html_e('ابدأ قصة نجاحك الآن', 'linkawy'); ?> <?php echo linkawy_icon('ArrowRight', 18); ?></a>
            </div>
        </div>
    </section>

    <?php get_template_part('template-parts/contact-form-section'); ?>

    <!-- Hero Counter Animation Script -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.dr-counter');
        
        counters.forEach(counter => {
            const updateCount = () => {
                const target = 92;
                const count = +counter.innerText;
                const speed = 80; 
                const inc = 1; 

                if (count < target) {
                    counter.innerText = count + inc;
                    // Add active visual state during counting
                    counter.closest('.anim-score').classList.add('score-active');
                    setTimeout(updateCount, speed);
                } else {
                    // Remove active state when done
                    counter.closest('.anim-score').classList.remove('score-active');
                    
                    // Wait then reset to simulate continuous system updates
                    setTimeout(() => {
                        counter.innerText = "80";
                        updateCount();
                    }, 5000); // 5 seconds pause before next cycle
                }
            };
            updateCount();
        });
    });
    </script>


    <!-- Conveyor Belt Platforms -->
    <script>
    (function() {
        var platforms = [
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/sall.svg', name: 'Salla', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/zid.svg', name: 'Zid', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/shopify.svg', name: 'Shopify', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/woocommerce.svg', name: 'WooCommerce', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/ds/brands/wordpress.svg', name: 'WordPress', badge: 'Expert' }
        ];

        var PAUSE = 3000; // ms between each step

        var conveyor = document.getElementById('platformsConveyor');
        var track = document.getElementById('platformsTrack');
        if (!conveyor || !track) return;

        function getVisibleCount() {
            return window.innerWidth < 768 ? 2 : 5;
        }

        // Get actual gap from CSS
        function getGap() {
            var gapStr = window.getComputedStyle(track).gap;
            return parseFloat(gapStr) || 16;
        }

        // Calculate item width based on conveyor width and actual gap
        function getItemWidth() {
            var visible = getVisibleCount();
            var gap = getGap();
            var cw = conveyor.getBoundingClientRect().width;
            return (cw - gap * (visible - 1)) / visible;
        }

        function createBox(p) {
            var box = document.createElement('div');
            box.className = 'dark-platform-box';
            box.innerHTML =
                '<img src="' + p.img + '" alt="' + p.name + '" width="32" height="32" loading="lazy">' +
                '<span class="dark-platform-name">' + p.name + '</span>' +
                '<span class="dark-platform-badge">' + p.badge + '</span>';
            return box;
        }

        // Keep a circular index
        var nextIndex = 0;

        function init() {
            var visible = getVisibleCount();
            var itemW = getItemWidth();
            conveyor.style.setProperty('--item-width', itemW + 'px');
            track.innerHTML = '';
            track.style.transition = 'none';
            track.style.transform = 'translateX(0)';

            // Place VISIBLE items
            nextIndex = 0;
            for (var i = 0; i < visible; i++) {
                track.appendChild(createBox(platforms[nextIndex % platforms.length]));
                nextIndex++;
            }
        }

        var stepping = false;

        function step() {
            if (stepping) return;
            // Ensure tab is active
            if (document.hidden) return;
            
            stepping = true;

            var itemW = getItemWidth();
            var gap = getGap();
            
            // Update width in case of slight resize
            conveyor.style.setProperty('--item-width', itemW + 'px');

            // Prepend next item to the start (off-screen left)
            var newBox = createBox(platforms[nextIndex % platforms.length]);
            nextIndex++;
            track.insertBefore(newBox, track.firstChild);

            // Start offset so the new item is hidden to the left
            // The shift amount must be exactly one item width + one gap
            var shiftAmount = itemW + gap;
            
            track.style.transition = 'none';
            track.style.transform = 'translateX(-' + shiftAmount + 'px)';

            // Force reflow
            void track.offsetWidth;

            // Animate to 0
            requestAnimationFrame(() => {
                track.style.transition = 'transform 0.9s cubic-bezier(0.4, 0, 0.2, 1)';
                track.style.transform = 'translateX(0)';
            });

            // After transition ends
            // Use 'once' option to ensure listener is removed automatically and correctly
            track.addEventListener('transitionend', function handler(e) {
                if (e.target !== track) return; // Ignore bubbling events
                
                // Remove the last child (slid off-screen right)
                if (track.lastChild) track.removeChild(track.lastChild);

                stepping = false;
            }, { once: true });
        }

        // Initialize
        init();

        // Start stepping
        setInterval(step, PAUSE);

        // Recalculate on resize
        var resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                init();
            }, 200);
        });
    })();
    </script>

    <!-- Swiper for Results Section: JS loads only when the slider nears the viewport -->
    <script>
    (function() {
        var resultsEl = document.querySelector('.resultsSwiper');
        if (!resultsEl) return;
        var requested = false;

        function loadSwiper() {
            if (requested) return;
            requested = true;
            var s = document.createElement('script');
            s.src = 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.js';
            s.crossOrigin = 'anonymous';
            s.onload = initResultsSwiper;
            document.body.appendChild(s);
        }

        if (!('IntersectionObserver' in window)) {
            loadSwiper();
            return;
        }
        var io = new IntersectionObserver(function(entries) {
            if (entries[0].isIntersecting) {
                io.disconnect();
                loadSwiper();
            }
        }, { rootMargin: '600px 0px' });
        io.observe(resultsEl);
    })();

    function initResultsSwiper() {
        if (typeof Swiper === 'undefined') return;
        new Swiper('.resultsSwiper', {
            loop: true,
            speed: 600,
            effect: 'coverflow',
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 1.5,
                slideShadows: false
            },
            centeredSlides: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            spaceBetween: 10,
            breakpoints: {
                0: { slidesPerView: 1.85, centeredSlides: true, spaceBetween: 10 },
                600: { slidesPerView: 3, centeredSlides: true },
                1024: { slidesPerView: 5, centeredSlides: true }
            },
            navigation: {
                nextEl: '.results-section .swiper-button-next',
                prevEl: '.results-section .swiper-button-prev'
            }
        });
    }
    </script>


<?php
get_footer();
