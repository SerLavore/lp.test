
$(document).ready(function(){

    setInterval(
        function (){
            $.ajax({
                type: "GET",
                url: "/admin/stats",
                dataType: "json",
                success: function(data)
                {
                    var jsonp = JSON.stringify(data);
                    jsonp = $.parseJSON(jsonp);

                    $('.table-stats > tbody').html(jsonp);
                }
            });
        }
        , 60000);

});
