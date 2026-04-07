document.addEventListener('DOMContentLoaded', () => {
    // Mobile Menu Toggle (Placeholder if needed, or if implementing a burger menu)
    // The current HTML has a simple nav, but for mobile it might need a toggle.

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Accordion functionality is handled by native <details> element
    // Optional: Close other details when one is opened
    const details = document.querySelectorAll('details');
    details.forEach(targetDetail => {
        targetDetail.addEventListener('click', () => {
            details.forEach(detail => {
                if (detail !== targetDetail) {
                    detail.removeAttribute('open');
                }
            });
        });
    });
    // Solutions Section Interaction
    // Get theme URL from localized data (fallback to relative if not available)
    const themeUrl = (typeof linkawySiteData !== 'undefined' && linkawySiteData.themeUrl) 
        ? linkawySiteData.themeUrl 
        : '';
    
    const solutionsData = [
        {
            title: "Personalized Roadmap",
            text: "No more generic advice that doesn't fit your situation. In our first session, we analyze your unique skills, experience, and goals to create a custom monetization strategy designed specifically for you. You'll know exactly what to monetize, who to target, and which path will get you to income fastest.",
            image: themeUrl + "/assets/images/Frame-2147228124.webp"
        },
        {
            title: "Proven Strategies",
            text: "Stop guessing and start executing. We provide you with field-tested strategies that have generated millions in revenue across different industries. No theory, just practical applications that work.",
            image: themeUrl + "/assets/images/Frame-2147225355.webp"
        },
        {
            title: "Step-by-Step Guidance",
            text: "From your first idea to your first sale, we walk you through every single step. Technical setups, marketing funnels, sales scripts - we cover it all so you never feel lost.",
            image: themeUrl + "/assets/images/Frame-2147225356.webp"
        },
        {
            title: "Ongoing Support",
            text: "Building a business is a journey, not a sprint. Our support doesn't end after the mentorship. You gain access to a network of like-minded entrepreneurs and direct access to Wael for critical pivots.",
            image: themeUrl + "/assets/images/Frame-2147228124.webp"
        }
    ];

    const solutionListItems = document.querySelectorAll('.solution-list li');
    const solutionTitle = document.querySelector('.solution-text h3');
    const solutionText = document.querySelector('.solution-text p');
    const solutionImage = document.querySelector('.solution-image-card img');

    // Preload images
    solutionsData.forEach(item => {
        const img = new Image();
        img.src = item.image;
    });

    if (solutionListItems.length > 0 && solutionTitle && solutionText && solutionImage) {
        solutionListItems.forEach((item, index) => {
            item.addEventListener('mouseenter', () => {
                // Remove active class from all
                solutionListItems.forEach(li => li.classList.remove('active'));
                // Add active class to current
                item.classList.add('active');

                // Update content with fade effect
                const contentContainer = document.querySelector('.solution-content');
                contentContainer.style.opacity = '0.5';

                setTimeout(() => {
                    solutionTitle.textContent = solutionsData[index].title;
                    solutionText.textContent = solutionsData[index].text;
                    solutionImage.src = solutionsData[index].image;
                    solutionImage.alt = solutionsData[index].title;
                    contentContainer.style.opacity = '1';
                }, 200);
            });
        });
    }
});
