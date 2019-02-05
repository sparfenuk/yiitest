(function($) {
    $('.pagination a').bind('click',function (event) {
        event.preventDefault();
        var data=getUrlVars(this.href);
       console.log(data);
        $.ajax({
            url: '/goods/comment-get?id='+data['id']+'&page='+data['page'],

            success: function (responce) {
                // console.log(responce);
                $('.product-reviews').html(responce);

            },

        });

    });

    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

})(jQuery);
