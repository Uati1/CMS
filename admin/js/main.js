$(document).ready(function () {
    ClassicEditor
    .create(document.querySelector('#body'))
    .catch(error => {
        console.error(error);
        });
});

$('#selectAll').click(function () {
    if (this.checked) {
        $('.checkbox').each(function () {
            this.checked = true;
        });
    } else {
        $('.checkbox').each(function () {
            this.checked = false;
        });
    }

});

var divBox = "<div id='load-screen'><div id='loading'></div></div>";

$('body').prepend(divBox);

$('#load-screen').delay(700).fadeOut(600, function () {
    $(this).remove();
});

function loadUsers() {
    $.get("inc/functions.php?online=result", function (data) {
        $(".onUsers").text(data);
    });
}

setInterval(function(){
    loadUsers();
}, 500);
