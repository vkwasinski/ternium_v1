(function () {
    var isHome = (document.location.pathname == '/'),
    // var isHome = (document.location.pathname == '/darrow_v2/src/'),
        hasLoaded =  localStorage.getItem('load');

        // we are showing just at home
        if (!isHome)  return;

        $('#overlay').show();
        setTimeout(function(){
            $('#overlay').hide();
        }, 3000);

        localStorage.setItem('load', 1);
})();
