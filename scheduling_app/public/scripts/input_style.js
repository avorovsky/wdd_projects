// script to pass value from invisible real input to visible fake one
// (additionally see comment in main.css)
document.getElementById("img_select").addEventListener("input", function(){
    document.getElementById("img_select_fake").value = document.getElementById("img_select").value;
});
