//trim space
$(".is_check_space").keypress(function (event) {
    var character = String.fromCharCode(event.keyCode);
    return !/\s/.test(character);
});

//trim first space
$(".is_check_first_space").on("input", function (event) {
    var value = $(this).val().trimStart();
    $(this).val(value);
});

//only number
$("body").on("keypress", ".is_check_number", function (event) {
    var character = String.fromCharCode(event.keyCode);
    return /[0-9\s]/.test(character);
});

$("body").on("keypress", ".remove_special_and_number", function (event) {
    var character = String.fromCharCode(event.keyCode);
    return !/^[0-9_~\-!@#\$%\^&\*\(\)+=\;:'",<.>?/{}[|\\\]]+$/.test(character);
});

$("body").on("keypress", ".is_check_email", function (event) {
    var character = String.fromCharCode(event.keyCode);
    return !/^[_~\-!#\$%\^&\*\(\)+=\;:'",<>?/{}[|\\\]]+$/.test(character);
});
$("body").on("keypress", ".only_number", function (event) {
    var character = String.fromCharCode(event.keyCode);
    return /[0-9]/.test(character);
});
