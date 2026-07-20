document.addEventListener('DOMContentLoaded', function () {
    var toggleBtn = document.querySelector('[data-sidebar-toggle]');
    var sidebar   = document.querySelector('.sidebar');
    var backdrop  = document.querySelector('.sidebar-backdrop');

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('is-open');
        if (backdrop) backdrop.classList.remove('is-open');
    }

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function () {
            sidebar.classList.toggle('is-open');
            if (backdrop) backdrop.classList.toggle('is-open');
        });
    }

    if (backdrop) {
        backdrop.addEventListener('click', closeSidebar);
    }
});
