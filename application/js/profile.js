$( document ).ready(function() {

    $("#sendMessage").click(function () {
        var value=this.value;
        DoPost(value);
    })

    function DoPost(value){
        console.log(value);
        $.redirect('/messages', {'id': value, 'action':'newDialog'});
    }
})