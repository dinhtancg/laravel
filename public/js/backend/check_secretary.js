
if (!$("#secrectory").is(':selected')) {
    $("#categories").hide();

}else {
    $("#categories").show();
}
$("#secrectory").click(function () {
    if ($(this).is(":checked")) {
        $("#categories").show();

    } else {
        $("#categories").hide();

    }
});