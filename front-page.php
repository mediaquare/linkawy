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
                            أفضل <span class="text-[#f26833]">شركة سيو</span>
                            <br>
                            للمتاجر الإلكترونية والشركات
                        </h1>
                        
                        <p class="text-lg text-gray-400 mb-8 leading-relaxed font-medium">
                            نقدم استراتيجيات سيو متكاملة مدعومة بالذكاء الاصطناعي تضمن لك تصدر النتائج. لا نكتفي بتحسين الترتيب، بل نحول الزيارات إلى إيرادات ومبيعات حقيقية لضمان نمو مستدام لمشروعك.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#خدمات-سيو" class="inline-flex items-center justify-center gap-2 bg-accent text-white px-8 py-3.5 rounded-full font-bold text-lg shadow-[0_0_20px_rgba(242,104,51,0.3)] hover:shadow-[0_0_30px_rgba(242,104,51,0.5)] hover:-translate-y-0.5 transition-all w-full sm:w-auto hover-accent">
                                <span>اكتشف الخدمات</span>
                            </a>
                             <a href="#كيف-نعمل" class="inline-flex items-center justify-center gap-2 bg-transparent border border-[#333] text-gray-300 px-8 py-3.5 rounded-full font-bold text-lg hover:bg-[#111] hover:text-white hover:border-gray-500 transition-all w-full sm:w-auto">
                                <span>كيف نعمل؟</span>
                            </a>
                        </div>

                        <!-- Client Logos Section -->
                        <div class="hero-clients mt-12 pt-8 border-t border-[#222]">
                            <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-8">
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest whitespace-nowrap">عملاء تشرفنا بمعاونتهم:</p>
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
                                                <div class="icon-box"><i class="fab fa-google"></i></div>
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
                                                <div class="icon-box"><i class="fas fa-link"></i></div>
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
                                                <div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/gemini-color.svg" alt="Gemini" width="16" height="16"></div>
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
                                         <div class="wall-card anim-border-pulse"><div class="flex justify-between items-start"><div class="icon-box"><i class="fab fa-google"></i></div><span class="mini-badge">Result #1</span></div><div><div class="h-2.5 w-3/4 bg-[#f26833] rounded mb-2 shadow-[0_0_10px_rgba(242,104,51,0.5)] anim-scan"></div><div class="skeleton-bar mb-1"></div><div class="skeleton-bar w-2/3"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Google SERP</div></div>
                                         <div class="wall-card relative"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-link"></i></div><span class="mini-badge">Links</span></div><div class="text-center py-1 relative"><div class="flex items-baseline justify-center gap-1"><span class="text-[10px] font-bold text-gray-300">DR</span><div class="text-xl font-bold text-white anim-score"><span class="dr-counter">80</span></div></div><div class="absolute top-0 right-10 text-[9px] text-[#f26833] font-extrabold anim-float-plus">+3</div><div class="text-[9px] text-gray-500">Authority Score</div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Backlinks</div></div>
                                         <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/gemini-color.svg" alt="Gemini" width="16" height="16"></div><span class="mini-badge">Gemini</span></div><div class="space-y-1.5 relative"><div class="h-[5px] bg-[#333] rounded-full anim-seq-1"></div><div class="h-[5px] bg-[#333] rounded-full anim-seq-2"></div><div class="h-[5px] bg-[#333] rounded-full anim-seq-3"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">AI Overview</div></div>
                                    </div>

                                    <!-- Marquee Group 3 (Duplicate for Safety) -->
                                    <div class="marquee-group" aria-hidden="true">
                                         <div class="wall-card anim-border-pulse"><div class="flex justify-between items-start"><div class="icon-box"><i class="fab fa-google"></i></div><span class="mini-badge">Result #1</span></div><div><div class="h-2.5 w-3/4 bg-[#f26833] rounded mb-2 shadow-[0_0_10px_rgba(242,104,51,0.5)] anim-scan"></div><div class="skeleton-bar mb-1"></div><div class="skeleton-bar w-2/3"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Google SERP</div></div>
                                         <div class="wall-card relative"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-link"></i></div><span class="mini-badge">Links</span></div><div class="text-center py-1 relative"><div class="flex items-baseline justify-center gap-1"><span class="text-[10px] font-bold text-gray-300">DR</span><div class="text-xl font-bold text-white anim-score"><span class="dr-counter">80</span></div></div><div class="absolute top-0 right-10 text-[9px] text-[#f26833] font-extrabold anim-float-plus">+3</div><div class="text-[9px] text-gray-500">Authority Score</div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Backlinks</div></div>
                                         <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/gemini-color.svg" alt="Gemini" width="16" height="16"></div><span class="mini-badge">Gemini</span></div><div class="space-y-1.5 relative"><div class="h-[5px] bg-[#333] rounded-full anim-seq-1"></div><div class="h-[5px] bg-[#333] rounded-full anim-seq-2"></div><div class="h-[5px] bg-[#333] rounded-full anim-seq-3"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">AI Overview</div></div>
                                    </div>
                                </div>

                                <!-- COLUMN 2: DOWN -->
                                <div class="wall-column col-down-med">
                                    <!-- Marquee Group 1 -->
                                    <div class="marquee-group">
                                        <!-- Card 1: ChatGPT -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/openai.svg" alt="OpenAI" width="16" height="16"></div>
                                                <span class="mini-badge">ChatGPT</span>
                                            </div>
                                            <div class="bg-[#111] border border-[#222] p-2 rounded text-[9px] text-gray-400 leading-relaxed opacity-90 relative">
                                                <span class="anim-typewriter-text">"الظهور في اجابات الذكاء الاصطناعي..."</span>
                                                <span class="inline-block w-0.5 h-2.5 bg-[#f26833] anim-cursor-real align-middle"></span>
                                            </div>
                                            <div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">LLMO / GEO</div>
                                        </div>
                                        
                                        <!-- Card 2: Blog Post (Sequential Typing Slower) -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><i class="fas fa-pen-nib"></i></div>
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
                                                <div class="icon-box"><i class="fas fa-map-marker-alt"></i></div>
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
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/openai.svg" alt="OpenAI" width="16" height="16"></div><span class="mini-badge">ChatGPT</span></div><div class="bg-[#111] border border-[#222] p-2 rounded text-[9px] text-gray-400 leading-relaxed opacity-90 relative"><span class="anim-typewriter-text">"الظهور في اجابات الذكاء الاصطناعي..."</span><span class="inline-block w-0.5 h-2.5 bg-[#f26833] anim-cursor-real align-middle"></span></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">LLMO / GEO</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-pen-nib"></i></div><span class="mini-badge">Content</span></div><div class="flex items-center gap-2"><div class="w-8 h-8 bg-[#1a1a1a] rounded-md border border-[#333]"></div><div class="flex-1 space-y-1 relative"><div class="h-[5px] bg-[#222] rounded-full anim-seq-1 anim-slow-duration"></div><div class="h-[5px] bg-[#222] rounded-full anim-seq-2-content anim-slow-duration"></div></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Blog Post</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-map-marker-alt"></i></div><span class="mini-badge">Local SEO</span></div><div class="h-10 bg-[#1a1a1a] rounded relative overflow-hidden border border-[#222] flex items-center justify-center"><div class="relative w-16 h-8"><div class="anim-area-dot anim-area-dot--0 w-1.5 h-1.5 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div><div class="anim-area-dot w-1 h-1 absolute top-2 left-4" ></div><div class="anim-area-dot anim-area-dot--1_5 w-1 h-1 absolute bottom-2 right-4"></div><div class="anim-area-dot anim-area-dot--2 w-1 h-1 absolute top-1 right-2"></div><div class="anim-area-dot anim-area-dot--2_5 w-1 h-1 absolute bottom-1 left-2"></div></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Maps Ranking</div></div>
                                    </div>
                                    
                                    <!-- Marquee Group 3 (Duplicate) -->
                                    <div class="marquee-group" aria-hidden="true">
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><img src="<?php echo LINKAWY_URI; ?>/assets/images/openai.svg" alt="OpenAI" width="16" height="16"></div><span class="mini-badge">ChatGPT</span></div><div class="bg-[#111] border border-[#222] p-2 rounded text-[9px] text-gray-400 leading-relaxed opacity-90 relative"><span class="anim-typewriter-text">"الظهور في اجابات الذكاء الاصطناعي..."</span><span class="inline-block w-0.5 h-2.5 bg-[#f26833] anim-cursor-real align-middle"></span></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">LLMO / GEO</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-pen-nib"></i></div><span class="mini-badge">Content</span></div><div class="flex items-center gap-2"><div class="w-8 h-8 bg-[#1a1a1a] rounded-md border border-[#333]"></div><div class="flex-1 space-y-1 relative"><div class="h-[5px] bg-[#222] rounded-full anim-seq-1 anim-slow-duration"></div><div class="h-[5px] bg-[#222] rounded-full anim-seq-2-content anim-slow-duration"></div></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Blog Post</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-map-marker-alt"></i></div><span class="mini-badge">Local SEO</span></div><div class="h-10 bg-[#1a1a1a] rounded relative overflow-hidden border border-[#222] flex items-center justify-center"><div class="relative w-16 h-8"><div class="anim-area-dot anim-area-dot--0 w-1.5 h-1.5 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"></div><div class="anim-area-dot w-1 h-1 absolute top-2 left-4" ></div><div class="anim-area-dot anim-area-dot--1_5 w-1 h-1 absolute bottom-2 right-4"></div><div class="anim-area-dot anim-area-dot--2 w-1 h-1 absolute top-1 right-2"></div><div class="anim-area-dot anim-area-dot--2_5 w-1 h-1 absolute bottom-1 left-2"></div></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Maps Ranking</div></div>
                                    </div>
                                </div>

                                <!-- COLUMN 3: UP -->
                                <div class="wall-column col-up-fast">
                                    <!-- Marquee Group 1 -->
                                    <div class="marquee-group">
                                        <!-- Card 1: Digital PR -->
                                        <div class="wall-card">
                                            <div class="flex justify-between items-start">
                                                <div class="icon-box"><i class="fas fa-bullhorn"></i></div>
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
                                                <div class="icon-box"><i class="fas fa-edit"></i></div>
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
                                                <div class="icon-box"><i class="fas fa-chart-line"></i></div>
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
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-bullhorn"></i></div><span class="mini-badge">Digital PR</span></div><div class="flex gap-1 mt-1"><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Media Coverage</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-edit"></i></div><span class="mini-badge">Niche Edits</span></div><div class="bg-[#111] p-2 rounded text-[9px] text-gray-500 border border-[#222]">Contextual <span class="text-[#f26833] font-bold animate-[pulse_3s_infinite]">Link</span> added.</div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Curated Links</div></div>
                                        <div class="wall-card anim-border-pulse"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-chart-line"></i></div><span class="mini-badge">Organic Growth</span></div><div class="flex items-end gap-1 h-10"><div class="w-1/4 bg-[#222] rounded-t flux-bar-1"></div><div class="w-1/4 bg-[#333] rounded-t flux-bar-2"></div><div class="w-1/4 bg-[#ea6431] opacity-60 rounded-t flux-bar-3"></div><div class="w-1/4 bg-[#f26833] rounded-t shadow-[0_0_10px_rgba(242,104,51,0.5)] flux-bar-4"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Traffic</div></div>
                                    </div>

                                    <!-- Marquee Group 3 (Duplicate) -->
                                    <div class="marquee-group" aria-hidden="true">
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-bullhorn"></i></div><span class="mini-badge">Digital PR</span></div><div class="flex gap-1 mt-1"><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div><div class="h-5 w-7 bg-[#1a1a1a] border border-[#333] rounded-sm hover:bg-[#222] transition-colors"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Media Coverage</div></div>
                                        <div class="wall-card"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-edit"></i></div><span class="mini-badge">Niche Edits</span></div><div class="bg-[#111] p-2 rounded text-[9px] text-gray-500 border border-[#222]">Contextual <span class="text-[#f26833] font-bold animate-[pulse_3s_infinite]">Link</span> added.</div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Curated Links</div></div>
                                        <div class="wall-card anim-border-pulse"><div class="flex justify-between items-start"><div class="icon-box"><i class="fas fa-chart-line"></i></div><span class="mini-badge">Organic Growth</span></div><div class="flex items-end gap-1 h-10"><div class="w-1/4 bg-[#222] rounded-t flux-bar-1"></div><div class="w-1/4 bg-[#333] rounded-t flux-bar-2"></div><div class="w-1/4 bg-[#ea6431] opacity-60 rounded-t flux-bar-3"></div><div class="w-1/4 bg-[#f26833] rounded-t shadow-[0_0_10px_rgba(242,104,51,0.5)] flux-bar-4"></div></div><div class="text-[9px] text-gray-500 font-bold uppercase tracking-wide">Traffic</div></div>
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
            <h2 class="dark-platforms-label">شركة سيو رائدة في تحويل الزيارات إلى أرباح حقيقية عبر مختلف المنصات</h2>
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
    <section class="programs-section fp-scroll-anchor" id="خدمات-سيو">
        <div class="container programs-container">
            <!-- Left Side: Sticky Header -->
            <div class="programs-intro">
                <span class="badge services-badge">
                    <span id="services-slide-text" class="services-slide-text">Shopify
                        SEO</span>
                </span>
                <h2>خدمات السيو التي نقدمها</h2>
                <p>استكشف استراتيجياتنا المخصصة التي تقدم التوجيه والدعم لمساعدتك على تصدر نتائج البحث وتحقيق النمو
                    المستدام بثقة.</p>
                <a href="#contact" class="cta-button fp-cta-margin">أطلب استشارة مجانية</a>
            </div>

            <!-- Right Side: Grid -->
            <div class="programs-grid">
                <!-- Card 1: Shopify SEO -->
                <div class="program-card program-card--shopify">
                    <div class="icon-box">
                        <?php echo file_get_contents( get_template_directory() . '/assets/images/partners/shopify.svg' ); ?>
                    </div>
                    <h3>سيو شوبيفاي</h3>
                    <span class="service-subtitle">Shopify SEO</span>
                    <p>نساعد متاجر شوبيفاي على تحسين الصفحات، المنتجات، وبنية المحتوى بما يتوافق مع متطلبات محركات البحث.
                        نعمل على رفع فرص الظهور في النتائج، تحسين الوصول للمنتجات، وزيادة الزيارات المستهدفة، بما يدعم
                        نمو المتجر ويعزز حضور العلامة التجارية أمام العملاء المحتملين.</p>
                </div>

                <!-- Card 2: Salla SEO -->
                <div class="program-card program-card--salla">
                    <div class="icon-box">
                        <?php echo file_get_contents( get_template_directory() . '/assets/images/partners/sall.svg' ); ?>
                    </div>
                    <h3>سيو سلة</h3>
                    <span class="service-subtitle">Salla SEO</span>
                    <p>نقدم خدمات SEO مخصصة لمتاجر سلة، تشمل تحسين الصفحات، الأقسام، المنتجات، والمحتوى الداخلي للمتجر.
                        نركز على تسهيل ظهور منتجاتك في نتائج البحث، وتحسين تجربة التصفح والوصول، بما يساهم في زيادة
                        الزيارات العضوية ورفع فرص تحقيق مبيعات أكبر بشكل مستدام.</p>
                </div>

                <!-- Card 4: On-Page SEO -->
                <div class="program-card">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="-10 -226 532 468" fill="currentColor"><path d="M0 168v-296c0-13 11-24 24-24s24 11 24 24v288c0 13 11 24 24 24s24-11 24-24v-312c0-35 29-64 64-64h288c35 0 64 29 64 64v320c0 35-29 64-64 64H64c-35 0-64-29-64-64zm160-288v64c0 18 14 32 32 32h64c18 0 32-14 32-32v-64c0-18-14-32-32-32h-64c-18 0-32 14-32 32zm24 240c-13 0-24 11-24 24s11 24 24 24h240c13 0 24-11 24-24s-11-24-24-24H184zm-24-72c0 13 11 24 24 24h240c13 0 24-11 24-24s-11-24-24-24H184c-13 0-24 11-24 24zM360-72c-13 0-24 11-24 24s11 24 24 24h64c13 0 24-11 24-24s-11-24-24-24h-64z"/></svg>
                    </div>
                    <h3>السيو الداخلي</h3>
                    <span class="service-subtitle">On-Page SEO</span>
                    <p>نعمل على تحسين العناصر الداخلية في موقعك مثل العناوين، المحتوى، الروابط الداخلية، والهيكلة العامة
                        للصفحات. الهدف هو مساعدة محركات البحث على فهم صفحاتك بشكل أفضل، ورفع جودة التجربة للزائر، بما
                        ينعكس على ترتيب الموقع وتحسين فرص التحويل من الزيارات العضوية.</p>
                </div>

                <!-- Card 5: Off-Page SEO -->
                <div class="program-card">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 560 560" fill="currentColor"><path d="M37 337c0 7 6 13 14 13 7 0 13-6 13-13 0-42 17-83 47-113 5-5 5-13 0-19-6-5-14-5-19 0-35 35-55 83-55 132zm166 146c0 7 6 13 14 13 40 0 79-16 108-45 5-5 5-13 0-19-6-5-14-5-19 0-24 24-56 37-89 37-8 0-14 6-14 14zm2-391c-5 5-5 13 0 19 6 5 14 5 19 0 30-30 71-47 113-47 7 0 13-6 13-13 0-8-6-14-13-14-49 0-97 20-132 55zm2 223c-5 5-5 14 0 19s14 5 19 0l108-108c5 5 14 5 19 0s5-14 0-19c-10-11-27-11-38 0L207 315zm225-9c-5 5-5 13 0 19 6 5 14 5 19 0 29-29 45-68 45-108 0-8-6-14-13-14-8 0-14 6-14 14 0 33-13 65-37 89z"/><path d="M263 149c-21 21-56 21-77 0s-21-55 0-77c42-42 98-62 157-62 114 0 207 93 207 207 0 55-22 107-61 146-21 21-55 21-76 0s-21-55 0-76c18-19 29-44 29-70 0-55-44-99-99-99-30 0-59 9-81 31zm0 0zm-39-38c30-30 71-47 113-47 7 0 13-6 13-13 0-8-6-14-13-14-49 0-97 20-132 55-5 5-5 13 0 19 6 5 14 5 19 0zm272 106c0-8-6-14-13-14-8 0-14 6-14 14 0 33-13 65-37 89-5 5-5 13 0 19 6 5 14 5 19 0 29-29 45-68 45-108zm-347-31c21 21 21 56 0 77-22 22-31 50-31 80 0 55 44 99 99 99 26 0 51-10 70-29 21-21 55-21 76 0s21 55 0 77c-39 38-91 60-146 60-114 0-207-92-207-207 0-58 20-115 62-157 22-21 56-21 77 0zm-38 38c5-5 5-13 0-19-6-5-14-5-19 0-35 35-55 83-55 132 0 7 6 13 14 13 7 0 13-6 13-13 0-42 17-83 47-113zm214 227c5-5 5-13 0-19-6-5-14-5-19 0-24 24-56 37-89 37-8 0-14 6-14 14 0 7 6 13 14 13 40 0 79-16 108-45zm-29-263c21-21 55-21 76 0s21 55 0 76L264 372c-21 21-55 21-76 0s-21-55 0-76l108-108zm57 19c-10-11-27-11-38 0L207 315c-5 5-5 14 0 19s14 5 19 0l108-108c5 5 14 5 19 0s5-14 0-19z"/></svg>
                    </div>
                    <h3>السيو الخارجي</h3>
                    <span class="service-subtitle">Off-Page SEO</span>
                    <p>نعزز حضور موقعك خارج نطاقه الداخلي عبر استراتيجيات السيو الخارجي، وعلى رأسها بناء روابط خلفية عالية
                        الجودة من مواقع موثوقة وذات صلة. يساعد ذلك في رفع موثوقية موقعك أمام محركات البحث، وتحسين
                        ترتيبه، وتوسيع انتشاره الرقمي على المستوى المحلي أو الإقليمي.</p>
                </div>

                <!-- Card 6: SEO Audits -->
                <div class="program-card">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="22 -258 546 545" fill="currentColor"><path d="M256-248c124 0 224 100 224 224 0 50-16 97-44 134l122 122-46 45-122-122c-37 28-83 45-134 45C133 200 32 100 32-24s101-224 224-224zm0 64c-88 0-160 72-160 160s72 160 160 160c89 0 160-72 160-160s-71-160-160-160zm28 132h68V4h-68v68h-56V4h-68v-56h68v-68h56v68z"/></svg>
                    </div>
                    <h3>فحص مشاكل الموقع</h3>
                    <span class="service-subtitle">SEO Audits</span>
                    <p>نقدم تدقيقًا شاملًا لموقعك للكشف عن المشكلات التي تؤثر على ظهوره في نتائج البحث، سواء كانت تقنية،
                        أو مرتبطة بالسرعة، أو الفهرسة، أو المحتوى، أو الروابط. ثم نضع لك صورة واضحة عن نقاط الضعف
                        والفرص، مع توصيات عملية تساعدك على تحسين الأداء بفعالية.</p>
                </div>

                <!-- Card 7: SEO Consulting -->
                <div class="program-card">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="-10 -286 580 608" fill="currentColor"><path d="M52-227c37-33 90-49 158-49 79 0 139 22 174 67 7 8 8 20 3 30-4 9-14 15-25 15h-12c-75 0-143 17-194 60-38 33-58 74-67 118-2 10-10 19-20 22-10 2-21-1-28-9C12-5 0-48 0-94c0-52 15-100 52-133zm298 119c-67 0-120 15-157 47s-53 77-53 128c0 47 13 89 45 121 30 30 74 48 130 53l70 61c7 7 16 10 25 10 21 0 38-17 38-38 0-15-5-29-6-44 37-11 66-30 86-57 23-30 32-67 32-106 0-51-16-96-53-128-36-32-90-47-157-47z"/></svg>
                    </div>
                    <h3>استشارات SEO</h3>
                    <span class="service-subtitle">SEO Consulting</span>
                    <p>نوفر استشارات SEO عملية تناسب طبيعة مشروعك ومرحلة نموه، سواء كنت تبدأ من الصفر أو تسعى لتطوير
                        نتائجك الحالية. نساعدك في بناء رؤية واضحة، تحليل المنافسين، تحديد الأولويات، واختيار الخطوات التي
                        تمنحك أفضل فرصة للظهور وتحقيق نمو حقيقي عبر البحث.</p>
                </div>

                <!-- Card 8: Technical SEO -->
                <div class="program-card">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="-11 -258 532 532" fill="currentColor"><path d="M303-248h-96l-7 56c-17 4-33 11-47 20l-45-35-68 68 35 45c-8 15-15 30-19 47l-57 7 1 96 56 7c4 17 11 32 19 47l-35 45 68 68 45-35c14 9 30 16 47 20l7 56h96l7-55c17-5 34-11 49-20l43 34 68-68-33-43c8-15 15-32 20-49l54-7v-96l-54-7c-5-17-12-34-20-49l33-43-68-68-43 34c-16-9-32-15-49-20l-7-55zm-3 157-48 208-5 19-39-9 5-19 48-208 4-20 39 9-4 20zM182-10 165 8c12 13 23 23 32 32l-29 28-46-46-14-14 46-46 14-14 29 28-14 14zm0 0zm176-28c25 24 40 40 47 46-7 6-22 22-47 46l-14 14-28-28c9-9 20-19 32-32l-32-32 28-28 14 14z"/></svg>
                    </div>
                    <h3>السيو التقني</h3>
                    <span class="service-subtitle">Technical SEO</span>
                    <p>نحسن الجوانب التقنية في موقعك لضمان توافقه مع متطلبات محركات البحث وسهولة الزحف والفهرسة. يشمل ذلك
                        تحسين سرعة التحميل، تجربة الجوال، الأمان، بنية الروابط، والهيكلة التقنية للموقع، بما يساهم في
                        رفع كفاءة الموقع وتحسين فرص ظهوره وترتيبه في النتائج.</p>
                </div>

                <!-- Card 8: GEO / AI SEO -->
                <div class="program-card">
                    <div class="icon-box">
                        <i class="fas fa-brain program-card-icon-accent"></i>
                    </div>
                    <h3>سيو الذكاء الإصطناعي</h3>
                    <span class="service-subtitle">GEO</span>
                    <p>نساعدك على تهيئة محتوى موقعك ليظهر بشكل أفضل في محركات الإجابة وتجارب البحث المعتمدة على الذكاء
                        الاصطناعي. نركز على بناء محتوى واضح، موثوق، ومنظم يسهل فهمه واقتباسه، بما يعزز فرص ظهور علامتك
                        التجارية في النتائج التفسيرية والإجابات المباشرة.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SEO Proof Section -->
    <section class="seo-proof-section">
        <div class="section-container">
            <h2 class="section-title">في المتوسط ساعدنا عملائنا في زيادة المبيعات العضوية لأكثر من <span class="highlight">270%</span> عن طريق الزيارات المستهدفة من Google و ChatGPT</h2>
            <div class="seo-image-container glass-card">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/gsc-proof.webp" alt="SEO Proof" loading="lazy" decoding="async" width="800" height="450">
            </div>
        </div>
    </section>

    <!-- Strategy Section (كيف نحقق نتائج تنعكس على المبيعات؟) -->
    <section class="strategy-section strategy-section--dark" id="services">
        <div class="section-container">
            <div class="strategy-grid">
                <div class="strategy-intro">
                    <p class="strategy-label">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/soft-star.svg' ); ?>" alt="Star Icon"
                            class="soft-star-icon" width="22" height="22" loading="lazy">
                        كيف نحقق نتائج تنعكس على المبيعات؟
                    </p>
                    <h2>تحسين محركات البحث... <br><span>هو آخر خطوة عندنا</span></h2>
                    <p class="description-text">لأن أولويتنا هي زيادة مبيعاتك، خطوات عملنا تبدأ من البيزنس وتنتهي
                        بالتسويق.</p>
                    <p class="description-text">
                        نستخدم أحدث استراتيجيات النمو لرفع معدل التحويل، وزيادة عدد العملاء المؤهلين، وخفض تكلفة اكتساب
                        العميل عبر المحتوى وتحسين رحلة المستخدم. والنتائج؟ تقدر تشوفها بنفسك تحت وتحكم!
                    </p>
                    <p class="highlight-text">
                        باستخدام تلك الإستراتيجية نهدف إلى تحويل من <span class="highlight">100%</span> من زوار موقعك
                        إلى عملاء جاهزين للشراء.
                    </p>
                </div>
                <div class="accordion">
                    <div class="accordion-item active" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">01</span>
                                <h3>تحليل السوق، والمنافسين، ونوايا الشراء</h3>
                            </div>
                            <div class="accordion-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">
                                نبدأ بفهم السوق، الكلمات التي تعكس نية شراء حقيقية، والأسئلة التي يبحث عنها العميل قبل
                                اتخاذ قرار الشراء.
                                <br><br>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">02</span>
                                <h3>هندسة صفحات البيع ورفع معدلات التحويل</h3>
                            </div>
                            <div class="accordion-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">نقوم بتحسين صفحات الهبوط لتكون مقنعة بصرياً ونصياً، مما
                                يزيد من نسبة تحويل الزوار إلى مشترين فعليين.</div>
                        </div>
                    </div>
                    <div class="accordion-item" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">03</span>
                                <h3>صناعة محتوى يبيع القيمة</h3>
                            </div>
                            <div class="accordion-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">نركز على إنشاء محتوى يجيب على أسئلة العملاء ويعالج
                                اعتراضاتهم، مما يدفعهم لاتخاذ قرار الشراء بدلاً من مجرد جذب الزيارات غير المفيدة.</div>
                        </div>
                    </div>
                    <div class="accordion-item" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">04</span>
                                <h3>التحسين لمحركات البحث والذكاء الاصطناعي</h3>
                            </div>
                            <div class="accordion-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">نعمل على تحسين البنية التقنية للموقع وملاءمته لمعايير
                                محركات البحث (SEO) وأنظمة الذكاء الاصطناعي الحديثة لضمان أقصى وصول عضوي.</div>
                        </div>
                    </div>
                    <div class="accordion-item" data-link="">
                        <div class="accordion-header">
                            <div class="accordion-title"><span class="accordion-number">05</span>
                                <h3>قياس الربحية.. وليس الترتيب</h3>
                            </div>
                            <div class="accordion-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-content">
                            <div class="accordion-content-inner">نركز في تقاريرنا على المقاييس التي تترجم مباشرة إلى
                                أرباح (مثل العائد على الإنفاق الإعلاني ROAS)، بدلاً من التركيز على مؤشرات الغرور (Vanity
                                Metrics) كالترتيب أو حجم الزيارات.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- شركاء النجاح -->
    <section class="partners-section">
        <div class="partners-container">
            <h2 class="partners-title">شركاء النجاح:</h2>
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
    $success_stories = new WP_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    ));
    
    if ($success_stories->have_posts()) :
    ?>
    <section class="success-stories-section">
        <div class="container">
            <div class="success-stories-header">
                <h2 class="success-stories-title">قصص نجاح المتاجر</h2>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="success-stories-link">
                    المزيد من قصص النجاح
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

    <!-- Process Section (كيف يتصدر موقعك النتائج الأولى على جوجل عن طريق شركة سيو؟) -->
    <section class="process-section fp-scroll-anchor" id="كيف-نعمل">
        <div class="process-container">
            <!-- Left Column: Sticky Info -->
            <div class="process-sticky-col">
                <h2 class="process-subtitle">كيف يتصدر موقعك النتائج الأولى على جوجل عن طريق شركة سيو؟</h2>

                <p class="process-description fp-process-desc">
                    الخطوة الأولى نحو النجاح الرقمي تبدأ من هنا! عند تعاونك مع أفضل شركة سيو، نتبع خطوات مدروسة لضمان
                    تحسين ترتيب موقعك في محركات البحث وتحقيق نتائج ملموسة.
                </p>

                <div class="fp-mt-2">
                    <a href="#contact" class="cta-button">ابدأ الآن</a>
                </div>
            </div>

            <!-- Right Column: Timeline -->
            <div class="process-timeline-col">
                <div class="timeline-list">

                    <!-- Step 1 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="fas fa-search-dollar"></i></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge">الخطوة الأولى</span>
                            <h3 class="timeline-title">نحلل موقعك لنكتشف فرص النمو</h3>
                            <p class="timeline-desc">نراجع موقعك بالكامل، نحدد نقاط القوة والضعف، ونكتشف أين تضيع
                                عليك الزيارات والفرص قبل منافسيك.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="fas fa-key"></i></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge">الخطوة الثانية</span>
                            <h3 class="timeline-title">نختار الكلمات التي تجذب عملاء حقيقيين</h3>
                            <p class="timeline-desc">لا نطارد كلمات بلا قيمة، بل نستهدف ما يبحث عنه عملاؤك فعلًا
                                عندما يكونون مستعدين للشراء أو التواصل.</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="fas fa-chess-board"></i></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge">الخطوة الثالثة</span>
                            <h3 class="timeline-title">نبني استراتيجية SEO مصممة لك</h3>
                            <p class="timeline-desc">نضع خطة واضحة تناسب نشاطك وأهدافك، تشمل المحتوى، الصفحات،
                                والبنية التقنية — بدون حلول جاهزة.</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="fas fa-rocket"></i></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge">الخطوة الرابعة</span>
                            <h3 class="timeline-title">ننفّذ التحسينات ونحرّك النتائج</h3>
                            <p class="timeline-desc">نبدأ التنفيذ العملي لتحسين موقعك ورفع ظهوره، خطوة بخطوة، حتى
                                يتحول إلى قناة جذب فعّالة.</p>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="fas fa-chart-line"></i></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge">الخطوة الخامسة</span>
                            <h3 class="timeline-title">نراقب الأداء ونحسّن باستمرار</h3>
                            <p class="timeline-desc">نقيس النتائج، نراجع الأداء، ونعدّل الاستراتيجية باستمرار لضمان
                                أفضل نمو ممكن.</p>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="timeline-item">
                        <div class="timeline-marker"><i class="fas fa-leaf"></i></div>
                        <div class="timeline-content">
                            <span class="timeline-step-badge">الخطوة السادسة</span>
                            <h3 class="timeline-title">نتابع النتائج ونبني نموًا مستدامًا</h3>
                            <p class="timeline-desc">نقدم تقارير واضحة، وخطة طويلة المدى تضمن استمرار التقدم وتفوّقك
                                في نتائج البحث.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Linkawy Section (9 Reasons) -->
    <section id="why-linkawy" class="problems-section reasons-section">
        <div class="container">
            <div class="section-header">
                <span class="badge">لماذا نحن</span>
                <h2>9 أسباب لاختيار أفضل شركة سيو لينكاوي</h2>
            </div>

            <div class="problems-grid reasons-grid">
                <!-- Card 1 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">1.</span>
                    </div>
                    <h3>خبرة عابرة للقارات</h3>
                    <p>نمتلك سجلًا حافلاً يمتد لأكثر من 12 عاماً في تقديم خدمات تحسين محركات البحث (SEO) في أسواق تنافسية مثل الإمارات، السعودية، وأمريكا. نحن لا نطبق استراتيجيات عامة، بل ننقل لك خبرات عالمية في تصدر نتائج البحث الأولى.</p>
                </div>

                <!-- Card 2 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">2.</span>
                    </div>
                    <h3>تحليل الكلمات المفتاحية الأكثر ربحية</h3>
                    <p>نبتعد عن الحلول التقليدية؛ حيث نبدأ عملنا بـ تحليل الكلمات المفتاحية (Keyword Analysis) بدقة لنستهدف العبارات التي تجلب لك "عملاء" وليس مجرد "زيارات". هدفنا هو رفع معدل التحويل (Conversion Rate) وضمان أعلى عائد على الاستثمار.</p>
                </div>

                <!-- Card 3 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">3.</span>
                    </div>
                    <h3>نتائج موثقة في زيادة الظهور الرقمي</h3>
                    <p>نجاحنا يُقاس بالأرقام. لدينا قائمة من قصص النجاح في زيادة حركة المرور المجانية (Organic Traffic) لشركات كبرى، حيث ساعدناهم في القفز إلى الصفحة الأولى في جوجل، مما أدى لزيادة ملموسة في المبيعات والانتشار.</p>
                </div>

                <!-- Card 4 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">4.</span>
                    </div>
                    <h3>تحسين السيو التقني (Technical SEO) بالكامل</h3>
                    <p>نقوم بضبط كل تفاصيل موقعك "خلف الكواليس". من تحسين سرعة الموقع، وضبط بنية البيانات (Schema Markup)، إلى تحسين تجربة المستخدم (UX)، لضمان زحف عناكب جوجل وأرشفة صفحاتك بأفضل صورة ممكنة.</p>
                </div>

                <!-- Card 5 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">5.</span>
                    </div>
                    <h3>تقارير أداء دورية وشفافية مطلقة</h3>
                    <p>في لينكاوي، نؤمن بالوضوح. ستحصل على تقارير مفصلة لمراقبة أداء الكلمات المفتاحية ووضع الروابط، وتتواصل مباشرة مع خبير السيو المهندس علي عطوة وفريق العمل لمناقشة تطورات المشروع دون أي تعقيدات إدارية.</p>
                </div>

                <!-- Card 6 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">6.</span>
                    </div>
                    <h3>مواكبة مستمرة لـ "تحديثات خوارزميات جوجل"</h3>
                    <p>عالم السيو متغير، ونحن نراقب خوارزميات جوجل (Google Algorithms) لحظة بلحظة. نقوم بتعديل خططنا باستمرار لضمان حماية موقعك من أي تراجعات، مع التركيز على استراتيجيات White Hat SEO بعيداً عن أي ممارسات قد تضر موقعك.</p>
                </div>

                <!-- Card 7 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">7.</span>
                    </div>
                    <h3>بناء روابط قوية (Backlinks) واستراتيجية محتوى</h3>
                    <p>لا نكتفي بالتحسين الداخلي فقط، بل نركز على بناء الروابط (Link Building) من مواقع ذات سلطة عالية (High DA)، بالتوازي مع تسويق بالمحتوى احترافي يجعل من موقعك مرجعاً في مجالك ويقوي "سلطة النطاق" (Domain Authority) لديك.</p>
                </div>

                <!-- Card 8 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">8.</span>
                    </div>
                    <h3>استشارات مباشرة من خبير السيو الأول</h3>
                    <p>الميزة التنافسية في "لينكاوي" هي أنك تتعامل مع العقل المدبر مباشرة. المهندس علي عطوة يضع خبرته الطويلة بين يديك عبر استشارات فنية متخصصة تضمن لك اتخاذ قرارات تسويقية ذكية مبنية على بيانات حقيقية.</p>
                </div>

                <!-- Card 9 -->
                <div class="problem-card">
                    <div class="problem-icon">
                        <span class="reason-number">9.</span>
                    </div>
                    <h3>تدريب فريقك على ممارسات السيو المستدام</h3>
                    <p>نحن نبني معك نظاماً يدوم؛ حيث نحرص على تدريب فريقك على أساسيات كتابة المحتوى المتوافق مع السيو وكيفية الحفاظ على النتائج المحققة، لضمان استمرارية تصدرك للمنافسين حتى على المدى الطويل.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="container">
            <div class="benefits-inner-container">
                <div class="section-header center-text">
                    <h2>نقود مشروعك نحو صدارة محركات البحث وتعظيم العائد في 3 خطوات</h2>
                </div>

                <div class="benefits-grid">
                    <!-- Text Column -->
                    <div class="benefits-content">
                        <div class="benefit-item" data-target="img-1">
                            <div class="benefit-text-wrap">
                                <h3>1. فهم السوق والجمهور</h3>
                                <p>نبدأ بدراسة نشاطك التجاري والسوق الذي تنافس فيه، مع فهم الفئة المستهدفة واحتياجاتها
                                    وطريقة بحثها الفعلية في جوجل. هذه الخطوة تساعدنا على اكتشاف الفرص الأقوى، وتحديد ما
                                    يبحث عنه عملاؤك المحتملون، وبناء أساس صحيح يجعل الزيارات القادمة إلى موقعك أكثر
                                    قيمة وقابلية للتحول إلى مبيعات.</p>
                            </div>
                        </div>

                        <div class="benefit-item" data-target="img-2">
                            <div class="benefit-text-wrap">
                                <h3>2. خطة SEO واضحة الأهداف</h3>
                                <p>بعد فهم السوق والجمهور، نضع خطة SEO مدروسة تستهدف تحسين ظهور موقعك في الكلمات
                                    المفتاحية الأكثر ارتباطًا بقرار الشراء. نحن لا نسعى إلى زيادة الأرقام شكليًا، بل
                                    نركز على جذب زيارات مؤهلة تحمل نية حقيقية، لأن الزيارة التي يمكن أن تتحول إلى عميل
                                    أهم بكثير من أي رقم بلا أثر.</p>
                            </div>
                        </div>

                        <div class="benefit-item" data-target="img-3">
                            <div class="benefit-text-wrap">
                                <h3>3. نتائج تنمو يومًا بعد يوم</h3>
                                <p>السيو ليس نتيجة لحظية، بل مسار نمو تراكمي يزداد أثره مع الوقت. لذلك نعمل على تحقيق نمو
                                    شهري مستمر في الزيارات العضوية، مع تحسين فرص التحويل ورفع جودة الوصول إلى الجمهور
                                    المناسب. ومع هذا التقدم المنتظم، تبدأ النتائج بالظهور بشكل أوضح على مستوى الطلبات
                                    والمبيعات والنمو التجاري.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Image Column -->
                    <div class="benefits-images">
                        <div class="benefit-img active" id="img-1">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/growth/seo-product-research.png"
                                alt="فهم السوق والجمهور" loading="lazy" width="400" height="300">
                        </div>
                        <div class="benefit-img" id="img-2">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/growth/seo-marketing-plan.webp"
                                alt="خطة SEO واضحة الأهداف" loading="lazy" width="400" height="300">
                        </div>
                        <div class="benefit-img" id="img-3">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/growth/sales-growth-dashboard.png"
                                alt="نتائج تنمو يومًا بعد يوم" loading="lazy" width="400" height="300">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-posts-section">
        <div class="blog-posts-container">
            <div class="blog-posts-header">
                <div class="blog-posts-header-text">
                    <h2>أحدث المقالات من المدونة</h2>
                    <p>نشارك معكم آخر التحديثات والاستراتيجيات في عالم تحسين محركات البحث.</p>
                </div>
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="blog-posts-btn">
                    تصفح كل المقالات
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                </a>
            </div>

            <div class="blog-posts-grid">
                <?php
                $blog_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

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
                            <?php the_post_thumbnail('medium_large'); ?>
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

    <!-- About / Intro Section -->
    <section class="about-section">
        <div class="container about-container">
            <div class="about-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/ali-atwa-seo-consulting.webp" alt="استشارات سيو" width="500" height="600" loading="lazy">
            </div>
            <div class="about-content">
                <span class="about-label">أهلًا بالمؤسس</span>
                <h2>استشارات سيو برؤية بيزنس</h2>
                <p>ندرك حجم الضغط الذي تواجهه كمؤسس وأنت ترى ميزانيتك تُستنزف في الإعلانات، لذا صممنا هذه الـ استشارات سيو لتخرجك من مصيدة 'الدفع مقابل الظهور' والتحسينات الشكلية. من خلال العمل مباشرة مع خبير سيو يمتلك رؤية بيزنس، ستُمنح منهجية استراتيجية نقلت شركات ناشئة من مجرد التواجد إلى الهيمنة عبر الزيارات المجانية.</p>
                <a href="#contact" class="cta-button">اطلب استشارة سيو</a>
            </div>
        </div>
    </section>

    <!-- Results Section (proof) -->
    <section class="results-section" id="results-proof">
        <div class="section-container">
            <div class="section-header results-header">
                <span class="results-live-badge"><span class="results-live-dot"></span>LIVE RESULTS</span>
                <h2 class="section-title results-title">نتائج SEO</h2>
                <p class="results-desc">شاهد النتائج من داخل الحسابات والمتاجر</p>
            </div>

            <!-- Slider -->
            <div class="swiper resultsSwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-1.webp" class="result-image" alt="Result 1" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-2.webp" class="result-image" alt="Result 2" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-3.webp" class="result-image" alt="Result 3" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-4.webp" class="result-image" alt="Result 4" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-5.webp" class="result-image" alt="Result 5" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-6.webp" class="result-image" alt="Result 6" loading="lazy" decoding="async"></div>

                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-1.webp" class="result-image" alt="Result 1 Copy" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-2.webp" class="result-image" alt="Result 2 Copy" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-3.webp" class="result-image" alt="Result 3 Copy" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-4.webp" class="result-image" alt="Result 4 Copy" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-5.webp" class="result-image" alt="Result 5 Copy" loading="lazy" decoding="async"></div>
                    <div class="swiper-slide"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/results/result-6.webp" class="result-image" alt="Result 6 Copy" loading="lazy" decoding="async"></div>
                </div>
            </div>

            <!-- Navigation Arrows: 20px below slider -->
            <div class="results-nav-arrows flex items-center justify-center gap-3 mt-5 md:mt-6" dir="ltr">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <!-- CTA: 40px below arrows -->
            <div class="text-center mt-8 md:mt-10">
                <a href="#contact" class="btn-cyber" data-link>ابدأ قصة نجاحك الآن <i class="fas fa-arrow-left"></i></a>
            </div>
        </div>
    </section>

    <section class="seo-faq-section" id="seo-faq">
        <div class="seo-faq-container">
            <div class="seo-faq-header">
                <h2>الأسئلة الشائعة</h2>
            </div>

            <div class="seo-faq-grid">
                <!-- العمود الأول -->
                <div class="seo-faq-column">
                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>ما هي خدمات تحسين محركات البحث (SEO) التي تقدمونها؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                نقدم مجموعة شاملة من خدمات السيو تشمل: التحسين الداخلي (On-Page SEO)، التحسين الخارجي وبناء الروابط (Off-Page SEO)، السيو التقني (Technical SEO)، تحسين المحتوى، تحليل الكلمات المفتاحية، تحسين سيو المتاجر الإلكترونية على شوبيفاي وسلة وزد، بالإضافة إلى استشارات السيو المتخصصة.
                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>كم من الوقت يستغرق تحسين ترتيب موقعي في نتائج البحث؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                تحسين محركات البحث عملية تراكمية وليست فورية. عادةً تبدأ النتائج الملموسة بالظهور خلال 3 إلى 6 أشهر من بدء العمل، وتتحسن بشكل مستمر مع مرور الوقت. النتائج تعتمد على حالة الموقع الحالية، المنافسة في المجال، وحجم العمل المطلوب.
                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>هل تقدمون خدمات السيو للمتاجر الإلكترونية؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                نعم، نحن متخصصون في تحسين محركات البحث للمتاجر الإلكترونية على مختلف المنصات مثل شوبيفاي وسلة وزد ووكومرس. نعمل على تحسين صفحات المنتجات والتصنيفات والبنية التقنية للمتجر لزيادة الزيارات العضوية وتحويلها إلى مبيعات حقيقية.
                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>ما الفرق بين السيو الداخلي والسيو الخارجي؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                السيو الداخلي (On-Page) يركز على تحسين عناصر الموقع نفسه مثل المحتوى، العناوين، الوصف، الصور، والروابط الداخلية. أما السيو الخارجي (Off-Page) فيركز على بناء سمعة الموقع خارجياً من خلال الروابط الخلفية (Backlinks) من مواقع موثوقة، والعلاقات العامة الرقمية، والإشارات الاجتماعية.
                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>كيف يتم تحديد سعر خدمة تحسين محركات البحث؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                يعتمد التسعير على عدة عوامل منها: حجم الموقع وعدد صفحاته، مستوى المنافسة في المجال، حالة الموقع التقنية الحالية، الأهداف المطلوب تحقيقها، ونطاق العمل. نقدم عروض أسعار مخصصة بعد تحليل دقيق لموقعك ومتطلباتك.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- العمود الثاني -->
                <div class="seo-faq-column">
                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>هل يمكنكم ضمان تصدر موقعي للنتيجة الأولى في جوجل؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                لا يمكن لأي شركة سيو محترفة ضمان المرتبة الأولى بشكل مطلق، لأن خوارزميات جوجل تتغير باستمرار. لكننا نضمن لك تطبيق أفضل الممارسات العالمية، واستراتيجيات مدروسة تحقق نمواً ملموساً في الترتيب والزيارات والمبيعات بشكل مستدام.
                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>ما أهمية بناء الروابط الخلفية (Backlinks) للسيو؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                الروابط الخلفية من أهم عوامل ترتيب جوجل. كل رابط من موقع موثوق يُعتبر بمثابة "تصويت ثقة" لموقعك. نحن نبني روابط عالية الجودة من مواقع ذات سلطة عالية (High Domain Authority) بطرق آمنة تتوافق مع إرشادات جوجل لتعزيز ترتيب موقعك بشكل دائم.
                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>هل تقدمون تقارير أداء دورية لمتابعة تقدم المشروع؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                نعم، نوفر تقارير أداء تفصيلية بشكل شهري تشمل: تطور ترتيب الكلمات المفتاحية، حجم الزيارات العضوية، تحليل الروابط المبنية، أداء الصفحات، ومعدلات التحويل. كما يمكنك التواصل مباشرة مع فريق العمل لمناقشة أي تفاصيل في أي وقت.
                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>ما هو السيو التقني وهل يحتاجه موقعي؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                السيو التقني يعالج البنية التحتية للموقع لتسهيل زحف وفهرسة محركات البحث. يشمل تحسين سرعة الموقع، التوافق مع الجوال، بنية الروابط، خرائط الموقع (Sitemap)، ملف Robots.txt، وبيانات Schema المنظمة. كل موقع يحتاج سيو تقني سليم كأساس لأي استراتيجية سيو ناجحة.
                            </div>
                        </div>
                    </div>

                    <div class="seo-faq-item">
                        <div class="seo-faq-question">
                            <h3>كيف يتم قياس نجاح استراتيجية السيو؟</h3>
                            <span class="seo-faq-toggle">+</span>
                        </div>
                        <div class="seo-faq-answer">
                            <div class="seo-faq-answer-inner">
                                نقيس النجاح من خلال مؤشرات أداء حقيقية تشمل: نمو الزيارات العضوية، تحسن ترتيب الكلمات المفتاحية المستهدفة، زيادة معدلات التحويل والمبيعات، تحسن سلطة النطاق (Domain Authority)، والعائد على الاستثمار (ROI). نركز على المقاييس التي تترجم مباشرة إلى إيرادات وليس مجرد أرقام.
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
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/shopify.svg', name: 'Shopify', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/woocommerce.svg', name: 'WooCommerce', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/wordpress.svg', name: 'WordPress', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/laravel.svg', name: 'Laravel', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/google ads.svg', name: 'Google Ads', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/google my business.svg', name: 'Google Business', badge: 'Expert' },
            { img: '<?php echo LINKAWY_URI; ?>/assets/images/partners/google-play-store.svg', name: 'Google Play', badge: 'Expert' }
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

    <!-- Swiper for Results Section -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/10.3.1/swiper-bundle.min.js" crossorigin="anonymous"></script>
    <script>
    (function() {
        if (typeof Swiper === 'undefined') return;
        var resultsEl = document.querySelector('.resultsSwiper');
        if (!resultsEl) return;
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
    })();
    </script>


<?php
get_footer();
