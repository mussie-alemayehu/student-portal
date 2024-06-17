document.addEventListener("DOMContentLoaded", function () {
    var yearSelector = document.getElementById("yearSelector");
    var semesterSelector = document.getElementById("semesterSelector");

    yearSelector.addEventListener('change', function() {
        if (this.value) {
            semesterSelector.disabled = false;
        } else {
            semesterSelector.disabled = true;
            semesterSelector.value = "";
        }
    });
});