// sidebar.js
$(document).ready(function(){
    var url = window.location.href;
    var activePage = url.substr(url.lastIndexOf('/') + 1);
    $('.sidenav a').each(function(){
        var linkPage = $(this).attr('href').substr($(this).attr('href').lastIndexOf('/') + 1);
        if (linkPage === activePage) {
            $(this).addClass('active');
        }
    });
});