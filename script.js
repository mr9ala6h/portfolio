function toggleMode() {
    document.body.classList.toggle("dark");

    var isDark = document.body.classList.contains("dark");
    document.getElementById("toggleBtn").textContent = isDark ? "Light Mode" : "Dark Mode";

    localStorage.setItem("mode", isDark ? "dark" : "light");
}

if (localStorage.getItem("mode") === "dark") {
    document.body.classList.add("dark");
    document.getElementById("toggleBtn").textContent = "Light Mode";
}

function toggleMenu() {
    document.getElementById("menu").classList.toggle("open");
}

var links = document.querySelectorAll("#menu a");
for (var i = 0; i < links.length; i++) {
    links[i].addEventListener("click", function () {
        document.getElementById("menu").classList.remove("open");
    });
}
