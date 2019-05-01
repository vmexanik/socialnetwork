$( document ).ready(function() {

    $( "#ajaxForm" ).submit(function( event ) {
        event.preventDefault();
        $.ajax({
            url: "/messages",
            data: new FormData (this),
            type: "POST",
            contentType: false,
            processData: false,
        })
        document.getElementById("ajaxForm").reset();;
    });

})