/*$(document).ready(function(){
    $("#table-search").on("keyup", function() {
        let value = $(this).val().toLowerCase();
        $("#mediaTable tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});*/

$(document).ready(function () {
    $.noConflict();
    $('#mediaTable').DataTable();
});
