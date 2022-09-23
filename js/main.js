$(function () {
    $('body').css("background", "#fff")
})

function testWebP(callback) {

    var webP = new Image();
    webP.onload = webP.onerror = function () {
        callback(webP.height == 2);
    };
    webP.src = "data:image/webp;base64,UklGRjoAAABXRUJQVlA4IC4AAACyAgCdASoCAAIALmk0mk0iIiIiIgBoSygABc6WWgAA/veff/0PP8bA//LwYAAA";
}

testWebP(function (support) {

    if (support == true) {
        document.querySelector('body').classList.add('webp');
    } else {
        document.querySelector('body').classList.add('no-webp');
    }
});

var fileobj;
function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    ajax_file_upload(fileobj);
}

function file_explorer() {
    document.querySelector('.content__select-file').click();
    document.querySelector('.content__select-file').onchange = function () {
        fileobj = document.querySelector('.content__select-file').files[0];
        ajax_file_upload(fileobj);
    };
}

function ajax_file_upload(file_obj) {
    if (file_obj != undefined) {
        var form_data = new FormData();
        form_data.append('file', file_obj);
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "torrent.php", true);
        xhttp.onload = function (event) {
            Output = document.querySelector('.content__message');
            if (xhttp.status == 200) {
                Output.innerHTML = "Файл успешно загружен!";
            } else {
                Output.innerHTML = "Error " + xhttp.status + " occurred when trying to upload your file.";
            }
        }

        xhttp.send(form_data);
    }
}

if (document.querySelector('.content__items')) {
    for (let i = 0; i < document.querySelectorAll('.content__items').length; i++) {
        document.querySelectorAll('.content__items')[i].addEventListener('click', function () {
            document.querySelectorAll('.form')[i].submit();
        })
    }
}