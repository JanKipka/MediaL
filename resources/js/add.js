$('#addForm').submit(function() {
    let existing = $('#existing-tab');
    let newTab = $('#new-tab');
    let artistTabChoice = $('#artistTabChoice');

    if (existing.hasClass('active')) {
        artistTabChoice.val('existing');
    } else {
        artistTabChoice.val('new');
    }
});
