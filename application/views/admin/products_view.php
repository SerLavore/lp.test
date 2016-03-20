<div id = "status_ok">
    <img src="/content/images/status-ok.png"/>
</div>

<?php
    include('application/views/admin/add_product_view.php');
    include('application/views/admin/add_images_product_view.php');
    include('application/views/admin/open_image_folder_view.php');
?>


<div id = "entry-content">
    <h1>Продукты</h1>
    <section class = "main_section">

        <div class = "product_add">
            <a style="cursor: pointer;">Добавить товар</a>
        </div>

        <div id="product_panel">

        </div>

        <table class="adm_products">
            <tbody>
    <?php
        if($data["products"])
        {
            foreach($data["products"] as $products){
    ?>
            <tr>
                <div class = "product_item_container">
                    <div class = "product_image">
                        <img src="/userfiles/<?=$products["image"]?>">
                    </div>
                    <div class = "product_main_data">
                        <div class="product_name">
                            <p><?=$products["name"]?></p>
                        </div>
                        <div class="product_desc">
                            <p><?=$products["description"]?></p>
                        </div>
                    </div>
                    <div class = "product_category">
                        <p><?=$products["category_tag"]?></p>
                    </div>
                    <div class = "product_subcategory">
                        <p><?=$products["subcat_tag"]?></p>
                    </div>
                    <div class = "product_sett bg_color_orange">
                        <div id="<?=$products["id"]?>" class = "action_update"><img src="/content/images/redact.png"/></div>
                    </div>
                    <div class = "product_sett bg_color_green">
                        <div id="<?=$products["id"]?>" class = "action_delete"><img src="/content/images/delete.png"/></div>
                    </div>
                </div>
            </tr>
    <?php
            }
        }
    ?>
            </tbody>
        </table>
    </section>
</div>