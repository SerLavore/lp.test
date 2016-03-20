$(document).ready(function () {

    /*$(".admin-auth-form").submit(function () {
        var $form = $(this);
        $.post($form.attr('action'), $('form').serialize(), function(data) {
            $(".error-text").html(data);
        });
    });
*/

    $(function() {
        $('.admin-auth-form').submit(function(e) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                dataType: 'text',
                data: $form.serialize(),
                beforeSend: function(data)
                {
                    $form.find('input[type="submit"]').attr('disabled', 'disabled');
                },
                success: function(data)
                {
                    if(data == 1)
                    {
                        $(location).attr('href','/admin');
                    }
                    else
                    {
                        $(".error-text").html(data);
                    }

                },
                complete: function(data)
                {
                    $form.find('input[type="submit"]').prop('disabled', false);
                }
            });
            e.preventDefault();
        });
    });
});
