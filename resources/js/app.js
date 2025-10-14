import './bootstrap';

// Job Rescue App JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuButton = document.querySelector('.md\\:hidden button');
    const mobileMenu = document.createElement('div');
    mobileMenu.className = 'md:hidden bg-white shadow-lg absolute top-16 left-0 right-0 z-30 hidden';
    mobileMenu.innerHTML = `
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="#" class="text-gray-600 hover:text-orange-500 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
            <a href="#" class="text-gray-600 hover:text-orange-500 block px-3 py-2 rounded-md text-base font-medium">Cari Kerja</a>
            <a href="#" class="text-gray-600 hover:text-orange-500 block px-3 py-2 rounded-md text-base font-medium">Cari Talent</a>
            <a href="#" class="text-gray-600 hover:text-orange-500 block px-3 py-2 rounded-md text-base font-medium">Tentang</a>
            <a href="#" class="text-gray-600 hover:text-orange-500 block px-3 py-2 rounded-md text-base font-medium">Login</a>
            <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white block px-3 py-2 rounded-md text-base font-medium">Daftar</a>
        </div>
    `;
    
    if (mobileMenuButton) {
        mobileMenuButton.parentNode.appendChild(mobileMenu);
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Smooth scrolling for anchor links
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

    // Add scroll effect to navbar
    const navbar = document.querySelector('nav');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-xl');
            } else {
                navbar.classList.remove('shadow-xl');
            }
        });
    }

    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // Observe all feature cards
    document.querySelectorAll('.grid > div').forEach(card => {
        observer.observe(card);
    });
});
