document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.getElementById('menuToggle');
    const closeBtn = document.getElementById('closeBtn');
    const sidebar = document.getElementById('mySidebar');
    const main = document.getElementById('main');

    menuToggle.addEventListener('click', function() {
        sidebar.style.width = "250px";
        main.style.marginLeft = "250px";
    });

    closeBtn.addEventListener('click', function() {
        sidebar.style.width = "0";
        main.style.marginLeft= "0";
    });
});


