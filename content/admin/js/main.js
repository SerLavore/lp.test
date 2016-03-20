;

Element.prototype.getStyle = function(){
    return getComputedStyle(this);
};

function getScroll() {
    return   window.pageYOffset || window.scrollY ||
        (document.documentElement && document.documentElement.scrollTop) ||
        (document.body && document.body.scrollTop) || 0;
}


$(document).ready(function(){

    var bool = true;
    var boolAside = true;
    var imgArr = [];
    var arrResult = [];

    $(".menu-link").each(function(i){

        $(this).mouseover(function(){
            $(".hovered-img").attr('src', $(this).children("span").children(".img-filled").attr('src'));
        });

    });

    $(".action_delete").each(function(i){

        $(this).click(function(){
            $.ajax({
                type: "GET",
                url: "/admin_products/delete/id/" + $(this).attr("id"),
                dataTypes: "json",
                success: function(data)
                {
                    $(".product_item_container")[i].style.display = "none";

                    var ok = $("#status_ok");

                    ok.fadeIn(1)
                        .animate({top: 300, opacity: 1}, 200)
                        .animate({ opacity: 0}, 300)
                        .fadeOut(1)
                        .animate({top: 400, opacity: 0}, 1);
                }
            });
        });

    });

    //ACTION UPDATE DATA ELEMENT

    $(".action_update").each(function(){

        $(this).click(function(){
            $.ajax({
                type: "GET",
                url: "/admin_product/update_element/id" + $(this).attr("id"),
                dataTypes: "json",
                success: function(data)
                {

                }
            });
        });

    });

    $(".admin-menu").mouseleave(function(){
        $(".hovered-img").attr('src', '/content/images/checkmark.png');
    });

    $(".profile-ico").click(function(){

        var adminMenu = $(".admin-menu-container"),
            adminUl = adminMenu.children("ul");

        if(bool){
            adminMenu.animate({width: 220, height: 150}, 150);
            adminUl.fadeIn(200);
            bool = false;
        }
        else if(!bool) {
            adminUl.fadeOut(100);
            adminMenu.animate({width: 0, height: 0}, 150);
            bool = true;
        }
    });

    $(".nav-filled").click(function(){

        if(boolAside)
        {
            $("aside").animate({left: 0}, 300);
            $("#hid-container").fadeIn(300);
            boolAside = false;
        }
        else if(!boolAside)
        {
            $("aside").animate({left: -250}, 300);
            $("#hid-container").fadeOut(300);
            boolAside = true;
        }


    });

    $(".product_add").click(function(){

        $(".add_product_container").fadeIn(300);

    });

    $(".close_block").click(function(){

        $(".add_product_container").fadeOut(300);

    });

    $(".close_block_i").click(function(){

        $(".add_img_container").fadeOut(300);
        $(".add_product_container").fadeIn(300);

    });

    $(".link_to_files").click(function(){

        $(".add_img_container").fadeIn(300);
        $(".add_product_container").fadeOut(300);

    });

    $(".open_folder").click(function(){

        $(".img_folder_container").fadeIn(300);
        $(".add_img_container").fadeOut(300);

    });

    $(".close_block_f").click(function(){

        $(".img_folder_container").fadeOut(300);
        $(".add_img_container").fadeIn(300);

    });

    $(".add_product_imgs").change(function(){

        $.ajax({
            type: "POST",
            url: "/admin_products/upload_images",
            dataTypes: "text",
            contentType: false,
            processData: false,
            data: {"files" : $(".add_product_imgs").val()},
            success: function(data)
            {
                /*var jsonp = JSON.stringify(data);
                jsonp = $.parseJSON(jsonp);*/

                console.log(data);
            }
        })

    });

    $(".select_category").change(function(){

        var option = $(".select_category :selected").val();

        $.ajax({
            type: "GET",
            url: "/admin_products/add_subcat",
            dataType: "json",
            data: {"option" : option},
            success: function(data)
            {
                var jsonp = JSON.stringify(data);
                jsonp = $.parseJSON(jsonp);

                $(".select_subcategory").html(jsonp);
            }
        });

    });

    $(function() {
        $('.add_product_form').submit(function(e) {
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
                        $(".success_add").html("Товар добавлен")
                            .fadeIn(500);
                        setTimeout(function(){
                            $(".success_add").fadeOut(500);
                        }, 1000);
                    }
                    else{
                        $(".error_add").html(data)
                            .fadeIn(500);
                        setTimeout(function(){
                            $(".error_add").fadeOut(500);
                        }, 5000);
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

    $(function(){
        $(".open_folder").click(function(e){
            $.ajax({
                type: "POST",
                url: "/admin_products/get_image_folder",
                dataType: "json",
                success: function(data)
                {
                    var jsonp = JSON.stringify(data);
                    jsonp = $.parseJSON(jsonp);

                    $('.imgs_folder').html(jsonp);

                    imgArr = [];
                    var k = 0,
                        counter = 0;

                    $(".choose_img").each(function(i){

                        $(this).click(function(){

                            var selectedImage = $(this).find(".img_folder_id").val(),
                                chooseImg = $(".choose_img"),
                                spanOK = $(".select_element"),
                                arrEl = $(this).find(".arr_el");

                                if(spanOK[i].getStyle().display == "none")
                                {
                                    if(counter >= 0 && counter < 4)
                                    {
                                        var img = $(this).find(".img_fldr").attr("src");

                                        chooseImg[i].style.outline = "solid 2px #4caf50";
                                        spanOK[i].style.display = "block";

                                        arrEl.val(k);

                                        imgArr.push(img);
                                        k++;
                                        counter++;
                                    }
                                }
                                else
                                {
                                    chooseImg[i].style.outline = "solid 2px #eee";
                                    spanOK[i].style.display = "none";

                                    delete imgArr[arrEl.val()];
                                    counter--;
                                }


                            arrResult = imgArr.filter(function(e){return e});

                            /*console.log(counter);
                            console.log(imgArr);
                            console.log("Array Element: " + arrEl.val());
                            console.log("Image ID: " + selectedImage);
                            console.log(arrResult);*/

                        });

                    });
                }
            });
        });
    });

    $(".save_selected_images").click(function(){

        var table = $(".selected_images > .saved_imgs"),
            delEl = $(".delete_element");

        $(".img_folder_container").fadeOut(300);
        $(".add_img_container").fadeIn(300);

        table.each(function(i){
            $(this).attr('src', arrResult[i]);
        });

        delEl.each(function(j){
            $(this).click(function(){
                $(this).parent().find(".saved_imgs").attr("src", "/content/images/noimage.jpg");

                delete arrResult[j];

                console.log(arrResult);
            });
        });

        console.log(arrResult);
        console.log(table);

    });

    $(".choose_selected_images").click(function(){

        if(arrResult.length > 0){

            var mainIMG = $(".main_prod_img"),
                secondaryIMG = $(".secondary_prod_img"),
                secStr;

            secondaryIMG.each(function(b){
                $(this).attr("src","/content/images/noimage.jpg" );
            });

            arrResult = arrResult.filter(function(e){return e});

            mainIMG.attr("src", arrResult[0]);

            $(".main_ph").val(arrResult[0]);

            secondaryIMG.each(function(i){
               $(this).attr("src", arrResult[++i]);
            });

            var res = arrResult;

            delete res[0];
            res = res.filter(function(e){return e});

            secStr = res.join(",");

            $(".scnd_photos").val(secStr);

            $(".add_img_container").fadeOut(300);
            $(".add_product_container").fadeIn(300);

            console.log(arrResult);
            console.log(secStr);
        }

    });

});


