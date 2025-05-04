
document.addEventListener('DOMContentLoaded', function () {
    // Toggle sidebar functionality
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function toggleSidebar() {
        // On desktop
        if (window.innerWidth >= 992) {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        }
        // On mobile
        else {
            sidebar.classList.toggle('mobile-active');
            sidebarOverlay.classList.toggle('active');
        }
    }

    sidebarToggle.addEventListener('click', toggleSidebar);
    sidebarOverlay.addEventListener('click', toggleSidebar);

    // Counter animation for stats
    const counterElements = document.querySelectorAll('.counter-value');
    counterElements.forEach(el => {
        const value = parseInt(el.textContent);
        const countUp = new CountUp(el, 0, value, 0, 2, {
            useEasing: true,
            useGrouping: true,
            separator: ',',
            decimal: '.',
        });

        if (!countUp.error) {
            countUp.start();
        } else {
            console.error(countUp.error);
        }
    });

    // Make table rows interactive
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('click', function (e) {
            // Don't navigate if clicking on buttons
            if (e.target.closest('.btn-action')) return;
        });
    });

    // Tooltip functionality (simplified version without Bootstrap's tooltip)
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    tooltipElements.forEach(el => {
        el.classList.add('tooltip-custom');
    });

    // Responsive sidebar behavior
    function checkWindowSize() {
        if (window.innerWidth < 992) {
            sidebar.classList.remove('collapsed');
            mainContent.classList.remove('expanded');
        }
    }

    window.addEventListener('resize', checkWindowSize);
    checkWindowSize();


});

