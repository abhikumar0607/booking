(function () {
const navbar = document.getElementById('siteNavbar');
const hero = document.querySelector('.hero');

if (!navbar) return;

// sets scrolled state based on scroll position threshold
function updateNavbarState() {
    const trigger = 40; // px scrolled before switching
    if (window.scrollY > trigger) {
    if (!navbar.classList.contains('scrolled')) {
        navbar.classList.add('scrolled');
        // add top padding to body equal to navbar height to prevent content jump
        document.body.style.paddingTop = navbar.getBoundingClientRect().height + 'px';
    }
    } else {
    if (navbar.classList.contains('scrolled')) {
        navbar.classList.remove('scrolled');
        document.body.style.paddingTop = ''; // remove padding when nav is overlay again
    }
    }
}

// initial check (in case page loads scrolled)
window.addEventListener('load', updateNavbarState);
window.addEventListener('resize', updateNavbarState);
window.addEventListener('scroll', updateNavbarState);

// Also ensure when the mobile menu opens/closes we don't hide content:
const bsCollapseEl = document.getElementById('navbarNav');
if (bsCollapseEl) {
    bsCollapseEl.addEventListener('shown.bs.collapse', function () {
    // if navbar is scrolled (fixed), keep body padding; else temporarily add padding to prevent jump on mobile open
    if (!navbar.classList.contains('scrolled')) {
        document.body.style.paddingTop = navbar.getBoundingClientRect().height + 'px';
    }
    });
    bsCollapseEl.addEventListener('hidden.bs.collapse', function () {
    if (!navbar.classList.contains('scrolled')) {
        document.body.style.paddingTop = '';
    }
    });
}
})();
