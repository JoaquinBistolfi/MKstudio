function changeLanguage() {
    const selectedLang = document.getElementById("languageSelect").value;
    const sections = document.querySelectorAll(".lang");

    sections.forEach(section => {
        if (section.classList.contains(selectedLang)) {
            section.style.display = "block";
        } else {
            section.style.display = "none";
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".lang.es").style.display = "block";
});