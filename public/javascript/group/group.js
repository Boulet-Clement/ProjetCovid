$('#link_description').on('click', function (e) {
    $('#content_description').show();
    $('#content_chat').hide();
    $('#content_membres').hide();
    $('#link_description').addClass("active")
    $('#link_chat').removeClass("active")
    $('#link_membres').removeClass("active")
})

$('#link_chat').on('click', function (e) {
    $('#content_chat').show();
    $('#content_description').hide();    
    $('#content_membres').hide();
    $('#link_chat').addClass("active")
    $('#link_membres').removeClass("active")
    $('#link_description').removeClass("active")
})

$('#link_membres').on('click', function (e) {
    $('#content_membres').show();
    $('#content_chat').hide();
    $('#content_description').hide();
    $('#link_membres').addClass("active")
    $('#link_description').removeClass("active")
    $('#link_chat').removeClass("active")
})