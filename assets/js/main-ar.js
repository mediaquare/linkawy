document.addEventListener('DOMContentLoaded', () => {
    // Critical: Fix for orphaned aria-hidden on body
    const fixAriaHidden = () => {
        const body = document.body;
        if (body.getAttribute('aria-hidden') === 'true') {
            const hasActiveModal = document.querySelector('.modal.show, .overlay.active, [role="dialog"][aria-hidden="false"]');
            if (!hasActiveModal) {
                body.removeAttribute('aria-hidden');
            }
        }
    };
    fixAriaHidden();

    // Critical: MutationObserver for aria-hidden
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'attributes' && mutation.attributeName === 'aria-hidden') {
                setTimeout(fixAriaHidden, 100);
            }
        });
    });
    observer.observe(document.body, { attributes: true, attributeFilter: ['aria-hidden'] });

    // Critical: Mobile Menu Toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    const navLinks = document.querySelectorAll('.main-nav a');
    const headerEl = document.querySelector('header');

    // Helper: lock body scroll when mobile nav is open
    // Note: backdrop-filter is now on header::before (not header itself),
    // so it no longer creates a containing block that breaks position:fixed
    const setNavOpen = (isOpen) => {
        document.body.style.overflow = isOpen ? 'hidden' : '';
    };

    if (mobileMenuToggle && mainNav) {
        const clearMobileNavAccordions = () => {
            mainNav.querySelectorAll('li.submenu-open').forEach((li) => li.classList.remove('submenu-open'));
        };

        const isMobileNavAccordion = () => window.matchMedia('(max-width: 768px)').matches;

        mobileMenuToggle.addEventListener('click', () => {
            mobileMenuToggle.classList.toggle('active');
            mainNav.classList.toggle('active');
            const open = mainNav.classList.contains('active');
            setNavOpen(open);
            if (!open) {
                clearMobileNavAccordions();
            }
        });

        navLinks.forEach((link) => {
            link.addEventListener('click', () => {
                const li = link.closest('li');
                const isParentToggle =
                    li &&
                    li.classList.contains('menu-item-has-children') &&
                    link === li.querySelector(':scope > a') &&
                    isMobileNavAccordion();
                if (isParentToggle) {
                    return;
                }
                mobileMenuToggle.classList.remove('active');
                mainNav.classList.remove('active');
                setNavOpen(false);
                clearMobileNavAccordions();
            });
        });

        document.addEventListener('click', (e) => {
            if (!mainNav.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                mobileMenuToggle.classList.remove('active');
                mainNav.classList.remove('active');
                setNavOpen(false);
                clearMobileNavAccordions();
            }
        });

        mainNav.querySelectorAll('li.menu-item-has-children').forEach((li) => {
            const parentLink = li.querySelector(':scope > a');
            const panel = li.querySelector(':scope > ul.sub-menu, :scope > .mega-menu');
            if (!parentLink || !panel) {
                return;
            }
            parentLink.addEventListener('click', (e) => {
                if (!isMobileNavAccordion()) {
                    return;
                }
                e.preventDefault();
                const wasOpen = li.classList.contains('submenu-open');
                mainNav.querySelectorAll('li.menu-item-has-children.submenu-open').forEach((o) => {
                    o.classList.remove('submenu-open');
                });
                if (!wasOpen) {
                    li.classList.add('submenu-open');
                }
            });
        });
    }

    // Critical: Header scroll effect for homepage dark header
    const header = document.querySelector('header');
    const isHomepage = document.body.classList.contains('home') || document.body.classList.contains('front-page');
    
    if (header && isHomepage) {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        };
        
        // Check initial scroll position
        handleScroll();
        
        // Add scroll listener with passive flag for better performance
        window.addEventListener('scroll', handleScroll, { passive: true });
    }

    // Critical: Add smooth scrolling for anchor links (User might click immediately)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // صفحة الخدمة: مكوّن Gutenberg FAQ — نفس سلوك الأكورديون وحركة max-height كقسم الأسئلة في الصفحة الرئيسية
    if (document.body.classList.contains('linkawy-service-page')) {
        document.querySelectorAll('.page-content-section .faq-block').forEach((block) => {
            const items = block.querySelectorAll('.faq-item');
            items.forEach((item) => {
                const question = item.querySelector('h2.faq-question');
                const answer = item.querySelector('.faq-answer');
                const inner = item.querySelector('.faq-answer-content');
                if (!question || !answer || !inner) {
                    return;
                }
                answer.style.maxHeight = '0';
                question.addEventListener('click', () => {
                    const isOpen = item.classList.contains('is-open');
                    items.forEach((other) => {
                        other.classList.remove('is-open');
                        const oa = other.querySelector('.faq-answer');
                        if (oa) {
                            oa.style.maxHeight = '0';
                        }
                    });
                    if (!isOpen) {
                        item.classList.add('is-open');
                        answer.style.maxHeight = `${inner.scrollHeight + 24}px`;
                    }
                });
            });
        });
    }

    // ===== Lazy Initialization for Heavy Widgets =====
    let widgetsInitialized = false;

    const initLazyWidgets = () => {
        if (widgetsInitialized) return;
        widgetsInitialized = true;

        // 1. Services Badge Slider
        const servicesText = document.getElementById('services-slide-text');
        if (servicesText) {
            const services = [
                "Shopify SEO", "Salla SEO", "On-Page SEO", "Off-Page SEO",
                "SEO Audits", "SEO Consulting", "Technical SEO", "GEO"
            ];
            let currentIndex = 0;
            const cycleText = () => {
                servicesText.style.opacity = '0';
                servicesText.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % services.length;
                    servicesText.textContent = services[currentIndex];
                    servicesText.style.transition = 'none';
                    servicesText.style.transform = 'translateY(10px)';
                    void servicesText.offsetHeight;
                    servicesText.style.transition = 'all 0.3s ease';
                    servicesText.style.opacity = '1';
                    servicesText.style.transform = 'translateY(0)';
                }, 300);
            };
            // Start cycle immediately after lazy init
            cycleText();
            setInterval(cycleText, 3000);
        }

        // 2. Benefits Section Interaction
        const benefitItems = document.querySelectorAll('.benefit-item');
        const benefitImages = document.querySelectorAll('.benefit-img');
        if (benefitItems.length > 0) {
            benefitItems.forEach(item => {
                item.addEventListener('mouseenter', () => {
                    const targetId = item.getAttribute('data-target');
                    benefitImages.forEach(img => {
                        if (img.id === targetId) img.classList.add('active');
                        else img.classList.remove('active');
                    });
                });
            });
        }

        // Accordion functionality for <details>
        const details = document.querySelectorAll('details');
        details.forEach(targetDetail => {
            targetDetail.addEventListener('click', () => {
                details.forEach(detail => {
                    if (detail !== targetDetail) detail.removeAttribute('open');
                });
            });
        });

        // 3. Solutions Section Interaction & Preloading
        const themeUrl = (typeof linkawySiteData !== 'undefined' && linkawySiteData.themeUrl) ? linkawySiteData.themeUrl : '';
        const solutionsData = [
            {
                title: "خارطة طريق شخصية",
                text: "لا مزيد من النصائح العامة التي لا تناسب وضعك. في جلستنا الأولى، نحلل مهاراتك الفريدة وخبراتك وأهدافك لإنشاء استراتيجية مخصصة لتحقيق الدخل مصممة خصيصاً لك. ستعرف بالضبط ما الذي يجب تحقيق الدخل منه، ومن تستهدف، وأي مسار سيوصلك للدخل بأسرع وقت.",
                image: themeUrl + "/assets/images/Frame-2147228124.webp"
            },
            {
                title: "استراتيجيات مجربة",
                text: "توقف عن التخمين وابدأ في التنفيذ. نحن نزودك باستراتيجيات مجربة ميدانياً ولّدت الملايين من العائدات عبر صناعات مختلفة. لا نظريات، فقط تطبيقات عملية تعمل بفعالية.",
                image: themeUrl + "/assets/images/Frame-2147225355.webp"
            },
            {
                title: "توجيه خطوة بخطوة",
                text: "من فكرتك الأولى إلى بيعك الأول، نسير معك في كل خطوة. الإعدادات التقنية، مسارات التسويق، نصوص البيع - نغطي كل شيء حتى لا تشعر بالضياع أبداً.",
                image: themeUrl + "/assets/images/Frame-2147225356.webp"
            },
            {
                title: "دعم مستمر",
                text: "بناء عمل تجاري هو رحلة، وليس سباقاً. دعمنا لا ينتهي بعد الإرشاد. تحصل على إمكانية الوصول إلى شبكة من رواد الأعمال ذوي التفكير المماثل والوصول المباشر إلى وائل في المحطات الحاسمة.",
                image: themeUrl + "/assets/images/Frame-2147228124.webp"
            }
        ];

        const solutionListItems = document.querySelectorAll('.solution-list li');
        const solutionTitle = document.querySelector('.solution-text h3');
        const solutionText = document.querySelector('.solution-text p');
        const solutionImage = document.querySelector('.solution-image-card img');

        if (solutionListItems.length > 0) {
            // Preload images only when lazy init triggers
            solutionsData.forEach(item => {
                const img = new Image();
                img.src = item.image;
            });

            solutionListItems.forEach((item, index) => {
                item.addEventListener('mouseenter', () => {
                    solutionListItems.forEach(li => li.classList.remove('active'));
                    item.classList.add('active');
                    const contentContainer = document.querySelector('.solution-content');
                    contentContainer.style.opacity = '0.5';
                    setTimeout(() => {
                        if (solutionsData[index]) {
                            solutionTitle.textContent = solutionsData[index].title;
                            solutionText.textContent = solutionsData[index].text;
                            solutionImage.src = solutionsData[index].image;
                            solutionImage.alt = solutionsData[index].title;
                        }
                        contentContainer.style.opacity = '1';
                    }, 200);
                });
            });
        }

        // 4. Strategy Section Accordion
        const strategyAccordionItems = document.querySelectorAll('.strategy-section .accordion-item');
        if (strategyAccordionItems.length > 0) {
            strategyAccordionItems.forEach(item => {
                if (item.classList.contains('active')) {
                    const content = item.querySelector('.accordion-content');
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
            strategyAccordionItems.forEach(item => {
                const header = item.querySelector('.accordion-header');
                const content = item.querySelector('.accordion-content');
                header.addEventListener('click', () => {
                    const isActive = item.classList.contains('active');
                    strategyAccordionItems.forEach(otherItem => {
                        otherItem.classList.remove('active');
                        otherItem.querySelector('.accordion-content').style.maxHeight = null;
                    });
                    if (!isActive) {
                        item.classList.add('active');
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });
        }

        // 4b. FAQ Section Accordion – smooth open/close (same effect as strategy section)
        const faqDetails = document.querySelectorAll('.faq-section .accordion details');
        if (faqDetails.length > 0) {
            faqDetails.forEach(detail => {
                const summary = detail.querySelector('summary');
                const content = detail.querySelector('.content');
                if (!summary || !content) return;
                const isOpen = detail.hasAttribute('open');
                content.style.maxHeight = isOpen ? content.scrollHeight + 'px' : '0';
                summary.addEventListener('click', (e) => {
                    e.preventDefault();
                    const open = detail.hasAttribute('open');
                    if (open) {
                        content.style.maxHeight = content.scrollHeight + 'px';
                        requestAnimationFrame(() => { content.style.maxHeight = '0'; });
                        content.addEventListener('transitionend', function onEnd() {
                            content.removeEventListener('transitionend', onEnd);
                            detail.removeAttribute('open');
                        }, { once: true });
                    } else {
                        detail.setAttribute('open', '');
                        requestAnimationFrame(() => {
                            content.style.maxHeight = content.scrollHeight + 'px';
                        });
                    }
                });
            });
        }

        // Upgrade: Footer Accordion & Mega Menu logic can stay here or be critical?
        // Let's put Footer Accordion here (only for mobile, needs interaction usually)
        const footerAccordions = document.querySelectorAll('.footer-accordion-header');
        footerAccordions.forEach(header => {
            header.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    const parent = header.parentElement;
                    const isActive = parent.classList.contains('active');
                    document.querySelectorAll('.footer-accordion').forEach(acc => acc.classList.remove('active'));
                    if (!isActive) parent.classList.add('active');
                }
            });
        });

        // Mega Menu + قوائم فرعية عادية (نفس منطق التأخير لتجاوز الفراغ بين الرابط والقائمة)
        const isDesktopHeaderNav = () => window.matchMedia('(min-width: 769px)').matches;

        const dropdownItems = document.querySelectorAll('.has-dropdown');
        let closeTimeout;

        dropdownItems.forEach(item => {
            const megaMenu = item.querySelector('.mega-menu');
            if (megaMenu) {
                item.addEventListener('mouseenter', () => {
                    if (!isDesktopHeaderNav()) return;
                    clearTimeout(closeTimeout);
                    megaMenu.style.opacity = '1';
                    megaMenu.style.visibility = 'visible';
                    megaMenu.style.transform = 'translateX(-50%) translateY(0)';
                });
                item.addEventListener('mouseleave', () => {
                    if (!isDesktopHeaderNav()) return;
                    closeTimeout = setTimeout(() => {
                        megaMenu.style.opacity = '0';
                        megaMenu.style.visibility = 'hidden';
                        megaMenu.style.transform = 'translateX(-50%) translateY(10px)';
                    }, 500);
                });
                megaMenu.addEventListener('mouseenter', () => {
                    if (!isDesktopHeaderNav()) return;
                    clearTimeout(closeTimeout);
                });
                megaMenu.addEventListener('mouseleave', () => {
                    if (!isDesktopHeaderNav()) return;
                    closeTimeout = setTimeout(() => {
                        megaMenu.style.opacity = '0';
                        megaMenu.style.visibility = 'hidden';
                        megaMenu.style.transform = 'translateX(-50%) translateY(10px)';
                    }, 200);
                });
            }
        });

        const clearSubMenuInline = (ul) => {
            ul.style.opacity = '';
            ul.style.visibility = '';
            ul.style.transform = '';
            ul.style.pointerEvents = '';
        };

        document.querySelectorAll('nav.main-nav li.menu-item-has-children:not(.has-dropdown)').forEach((item) => {
            const subMenu = item.querySelector(':scope > ul.sub-menu');
            if (!subMenu) return;
            let subCloseTimeout;
            const showSub = () => {
                subMenu.style.opacity = '1';
                subMenu.style.visibility = 'visible';
                subMenu.style.transform = 'translateY(0)';
                subMenu.style.pointerEvents = 'auto';
            };
            const hideSub = () => {
                subMenu.style.opacity = '0';
                subMenu.style.visibility = 'hidden';
                subMenu.style.transform = 'translateY(10px)';
                subMenu.style.pointerEvents = 'none';
            };
            item.addEventListener('mouseenter', () => {
                if (!isDesktopHeaderNav()) return;
                clearTimeout(subCloseTimeout);
                subMenu.__linkawyNavCloseT = undefined;
                showSub();
            });
            item.addEventListener('mouseleave', () => {
                if (!isDesktopHeaderNav()) return;
                clearTimeout(subCloseTimeout);
                subCloseTimeout = setTimeout(hideSub, 500);
                subMenu.__linkawyNavCloseT = subCloseTimeout;
            });
            subMenu.addEventListener('mouseenter', () => {
                if (!isDesktopHeaderNav()) return;
                clearTimeout(subCloseTimeout);
                subMenu.__linkawyNavCloseT = undefined;
            });
            subMenu.addEventListener('mouseleave', () => {
                if (!isDesktopHeaderNav()) return;
                clearTimeout(subCloseTimeout);
                subCloseTimeout = setTimeout(hideSub, 200);
                subMenu.__linkawyNavCloseT = subCloseTimeout;
            });
        });

        document.addEventListener('focusin', (e) => {
            document.querySelectorAll('nav.main-nav li.menu-item-has-children:not(.has-dropdown) > ul.sub-menu').forEach((ul) => {
                const li = ul.parentElement;
                if (li && li.contains(e.target)) {
                    return;
                }
                clearSubMenuInline(ul);
            });
        });

        window.matchMedia('(min-width: 769px)').addEventListener('change', (ev) => {
            document.querySelectorAll('nav.main-nav li.submenu-open').forEach((li) => li.classList.remove('submenu-open'));
            if (ev.matches) return;
            clearTimeout(closeTimeout);
            document.querySelectorAll('nav.main-nav li.menu-item-has-children:not(.has-dropdown) > ul.sub-menu').forEach((ul) => {
                if (ul.__linkawyNavCloseT) {
                    clearTimeout(ul.__linkawyNavCloseT);
                    ul.__linkawyNavCloseT = undefined;
                }
                clearSubMenuInline(ul);
            });
            document.querySelectorAll('.has-dropdown .mega-menu').forEach((mega) => {
                mega.style.opacity = '';
                mega.style.visibility = '';
                mega.style.transform = '';
            });
        });

        // Sticky Nav can be initialized here too.
        setupStickyAndScrollSpy();
    };

    // Helper for Sticky & ScrollSpy - Optimized with IntersectionObserver
    // This eliminates forced reflow by avoiding getBoundingClientRect() during scroll
    const setupStickyAndScrollSpy = () => {
        // Alphabet Nav Sticky - Using IntersectionObserver
        const alphabetNavWrapper = document.querySelector('.alphabet-nav-wrapper');
        if (alphabetNavWrapper) {
            // Create a sentinel element above the nav to detect when nav should become sticky
            const sentinel = document.createElement('div');
            sentinel.style.cssText = 'position:absolute;top:0;left:0;right:0;height:1px;pointer-events:none;visibility:hidden;';
            alphabetNavWrapper.parentNode.insertBefore(sentinel, alphabetNavWrapper);

            // Sync scroll baseline when sticky toggles (avoids false "scroll down" on first stick)
            let lastScrollY = window.scrollY;
            let suppressConcealUntil = 0;

            // Position sentinel at the point where sticky should activate
            const stickyTop = parseInt(getComputedStyle(alphabetNavWrapper).top) || 80;
            sentinel.style.top = (alphabetNavWrapper.offsetTop - stickyTop) + 'px';

            const stickyObserver = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        // When sentinel is not visible (scrolled past), nav should be sticky
                        if (!entry.isIntersecting) {
                            alphabetNavWrapper.classList.add('is-sticky');
                            lastScrollY = window.scrollY;
                        } else {
                            alphabetNavWrapper.classList.remove('is-sticky');
                            alphabetNavWrapper.classList.remove('is-concealed');
                            lastScrollY = window.scrollY;
                        }
                    });
                },
                { threshold: 0, rootMargin: `-${stickyTop}px 0px 0px 0px` }
            );
            stickyObserver.observe(sentinel);

            // Mobile only: hide sticky alphabet bar when scrolling down, show when scrolling up
            const mqAlphabetHide = window.matchMedia('(max-width: 768px)');

            const updateAlphabetScrollConceal = () => {
                if (!mqAlphabetHide.matches) {
                    alphabetNavWrapper.classList.remove('is-concealed');
                    return;
                }
                const y = window.scrollY;
                if (!alphabetNavWrapper.classList.contains('is-sticky')) {
                    alphabetNavWrapper.classList.remove('is-concealed');
                    lastScrollY = y;
                    return;
                }
                if (Date.now() < suppressConcealUntil) {
                    lastScrollY = y;
                    return;
                }
                const delta = y - lastScrollY;
                const threshold = 8;
                if (delta > threshold) {
                    alphabetNavWrapper.classList.add('is-concealed');
                } else if (delta < -threshold) {
                    alphabetNavWrapper.classList.remove('is-concealed');
                }
                lastScrollY = y;
            };

            window.addEventListener('scroll', updateAlphabetScrollConceal, { passive: true });

            const onMqAlphabetHide = () => {
                if (!mqAlphabetHide.matches) {
                    alphabetNavWrapper.classList.remove('is-concealed');
                }
            };
            if (mqAlphabetHide.addEventListener) {
                mqAlphabetHide.addEventListener('change', onMqAlphabetHide);
            } else if (mqAlphabetHide.addListener) {
                mqAlphabetHide.addListener(onMqAlphabetHide);
            }

            alphabetNavWrapper.querySelectorAll('a').forEach((link) => {
                link.addEventListener('click', () => {
                    suppressConcealUntil = Date.now() + 900;
                    alphabetNavWrapper.classList.remove('is-concealed');
                });
            });
        }

        // Glossary Scroll Spy - Using IntersectionObserver
        // This completely eliminates scroll-based layout reads
        const glossaryGroups = document.querySelectorAll('.glossary-group');
        const alphabetLinks = document.querySelectorAll('.alphabet-nav a');
        
        if (glossaryGroups.length > 0 && alphabetLinks.length > 0) {
            // Build a map for quick link lookup
            const linkMap = new Map();
            alphabetLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && href.startsWith('#')) {
                    linkMap.set(href.substring(1), link);
                }
            });
            
            // Track which sections are currently visible
            const visibleSections = new Set();
            let currentActive = null;
            
            const updateActiveFromVisible = () => {
                if (visibleSections.size === 0) return;
                
                // Find the topmost visible section (first in DOM order)
                let topSection = null;
                for (const group of glossaryGroups) {
                    if (visibleSections.has(group.id)) {
                        topSection = group.id;
                        break;
                    }
                }
                
                if (topSection && topSection !== currentActive) {
                    // Remove previous active
                    if (currentActive && linkMap.has(currentActive)) {
                        linkMap.get(currentActive).classList.remove('active');
                    }
                    // Add new active
                    if (linkMap.has(topSection)) {
                        linkMap.get(topSection).classList.add('active');
                    }
                    currentActive = topSection;
                }
            };
            
            // Create IntersectionObserver for scroll spy
            const scrollSpyObserver = new IntersectionObserver(
                (entries) => {
                    entries.forEach(entry => {
                        const sectionId = entry.target.id;
                        if (entry.isIntersecting) {
                            visibleSections.add(sectionId);
                        } else {
                            visibleSections.delete(sectionId);
                        }
                    });
                    updateActiveFromVisible();
                },
                {
                    // Trigger when section enters top portion of viewport
                    rootMargin: '-80px 0px -60% 0px',
                    threshold: 0
                }
            );
            
            // Observe all glossary groups
            glossaryGroups.forEach(group => {
                if (group.id) {
                    scrollSpyObserver.observe(group);
                }
            });
            
            // Set initial active state without causing reflow
            if (glossaryGroups[0] && glossaryGroups[0].id) {
                const firstLink = linkMap.get(glossaryGroups[0].id);
                if (firstLink) {
                    firstLink.classList.add('active');
                    currentActive = glossaryGroups[0].id;
                }
            }
        }
    };

    // Events to trigger Lazy Init
    const userEvents = ['mousemove', 'mousedown', 'keydown', 'touchstart', 'scroll'];
    userEvents.forEach(event => {
        window.addEventListener(event, initLazyWidgets, { once: true, passive: true });
    });
});
