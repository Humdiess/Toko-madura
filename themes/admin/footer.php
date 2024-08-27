            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggler = document.querySelector('.navbar-toggler');
            const sidebarMenu = document.querySelector('#sidebar-menu');
        
            toggler.addEventListener('click', function () {
                const isExpanded = toggler.getAttribute('aria-expanded') === 'true';
                toggler.setAttribute('aria-expanded', !isExpanded);
                sidebarMenu.classList.toggle('show', !isExpanded);
            });
        
            var currentPath = window.location.pathname;
            var navLinks = document.querySelectorAll('.nav-link');
        
            navLinks.forEach(function(navLink) {
                var href = navLink.getAttribute('href');
            
                var linkPath = new URL(href, window.location.origin).pathname;
            
                if (currentPath === linkPath || currentPath.startsWith(linkPath)) {
                    var navItem = navLink.closest('.nav-item');
                    navItem.classList.add('active');
                    var icon = navLink.querySelector('.fas');
                    if (icon) {
                        icon.classList.add('active-icon');
                    }
                }
            });
        });    

        // Chart JS initialization
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>