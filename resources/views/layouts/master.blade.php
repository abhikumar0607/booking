<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title></title>
      <meta name="description" content="">
      <meta name="keywords" content="">
      <!-- Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <!-- Google Fonts: Manrope -->
      <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
         <!-- Custom CSS -->
      <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
   </head>
   <body>
   
   <nav class="navbar navbar-expand-lg custom-navbar" id="siteNavbar" aria-label="Main navigation">
      <div class="nav-inner d-flex align-items-center">
         <a class="navbar-brand me-auto" href="#"><img src="{{ url('public/images/logo.svg') }}" class="img-fluid ht-logo" alt="Parcel Delivery"></a>

         <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-lg-center">
            <li class="nav-item"><a class="nav-link px-3" href="#for-business">For Business</a></li>
            <li class="nav-item"><a class="nav-link px-3" href="#drive">Drive With Us</a></li>
            <li class="nav-item"><a class="nav-link px-3" href="#services">Services</a></li>
            <li class="nav-item"><a class="nav-link px-3" href="#contact">Contact Us</a></li>
            </ul>
         </div>
      </div>
   </nav>
        
         @yield('content')
      
   <footer class="footer" id="contact">
      <div class="container text-center">
         <p>© RR Logistic | <a href="#">Privacy Policy</a> | <a href="#">Terms</a></p>
      </div>
   </footer>
   <!-- Bootstrap JS -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
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
      </script>
   </body>
</html>
