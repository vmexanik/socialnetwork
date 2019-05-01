$( document ).ready(function() {

    var header=$(".header"),
        table=$("table");


    setInterval(load,500);

    $( "button" ).click(function() {
        console.log('Button click!!');
        load();
    });

    function load (){
         $.ajax({
            url: "/messages",
            data: {action: "getMessageJson"},
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
                        table.append("<tr><td class='user'>" + val[i]['text'] + "</td></tr>")
                    }
                    if (val[i]['sender']=='oponent')
                    {
                        table.append("<tr><td class='oponent'>" + val[i]['text'] + "</td></tr>")
                    }

                }
            }
        });
    }



})





