$(document).ready(function(){
    $('#menuBtn').click(function(){
        $('#sidebar').toggleClass('sidebar small-sidebar')
        $('#menuBtn').toggleClass('resposBtn')
        $('.main-content').toggleClass('large-content')

    });
});