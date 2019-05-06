$( document ).ready(function() {

    var header=$(".header"),
        table=$("table> tbody:last-child"),
        form=$("#ajaxForm"),
        id;



    form.hide();

    $( table ).on("click", "td",function() {
        id=this.id;
        form.show('slow');
        load(id);
        setInterval(loadHelp,100);
    });

    function loadHelp() {
        load(id);
    }

    function load (id){
         $.ajax({
            url: "/messages",
            data: {action: "getMessageJson", idDialog:id},
            type: "POST",
            dataType : "json",
            success: function (data)
            { appendMessages(data);},
        })
    }

    function appendMessages(data) {
        table.empty();
        $.each( data, function( key, val ) {
            if (key=='header') {
                header.empty();
                header.append(val);
            }
            if (key=='text')
            {
                for (var i=0; i<val.length; i++)
                {
                    if (val[i]['sender']=='user')
                    {
                        table.append("<tr><td class='user'>" + val[i]['text'] + "</td></tr>");
                    }
                    if (val[i]['sender']=='oponent')
                    {
                        table.append("<tr><td class='oponent'>" + val[i]['text'] + "</td></tr>");
                    }
                }
            }
        });
    }

     form.submit(function( event ) {
        event.preventDefault();
        var msg=$("input:first").val();
        $.ajax({
            url: "/messages",
            dataType: 'json',
            data: {message: msg, action: "setMessageJson", idDialog:id},
            type: "POST",
        })
        form[0].reset();
    });

})





