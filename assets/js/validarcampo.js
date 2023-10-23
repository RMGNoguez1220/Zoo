document.addEventListener("DOMContentLoaded", function () {
    var inputElements = document.querySelectorAll(".Login-box .user-box input");

    inputElements.forEach(function (input) {
        input.addEventListener("input", function () {
            if (input.value.trim() !== "") {
                input.classList.add("validarcampo");
            } else {
                input.classList.remove("validarcampo");
            }
        });
    });
});