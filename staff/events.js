

document.querySelectorAll('.student').forEach(function (element) {
    element.addEventListener('click', function () {
        var studentId = this.querySelector('.id').textContent;
        window.location.href = window.location.href + "&stud_id=" + studentId;
    });
});