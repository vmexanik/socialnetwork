$( document ).ready(function() {

    $("td").click(function () {
        var value=this.id;
        DoPost(value);
    })

    $(".myProfile").click(function (e) {
        var value=this.id;
        event.preventDefault();
        DoPost(value);
    })

    function DoPost(value){
        console.log(value);
        $.redirect('/profile', {'id': value});
    }


})