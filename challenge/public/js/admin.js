document.addEventListener("DOMContentLoaded", function () {
    const toggleSidebarButton = document.getElementById("toggle-sidebar");
    const sidebar = document.querySelector(".sidebar");
    const body = document.body;

    toggleSidebarButton.addEventListener("click", function () {
        if (sidebar.classList.contains("d-none")) {
            sidebar.classList.remove("d-none");
            setTimeout(() => {
                body.classList.add("sidebar-visible");
                body.classList.remove("sidebar-hidden");
            }, 100);
        } else {
            body.classList.add("sidebar-hidden");
            body.classList.remove("sidebar-visible");

            setTimeout(() => {
                sidebar.classList.add("d-none"); 
            }, 300);
        }
    });
});
