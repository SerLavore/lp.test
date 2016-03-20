<div class = "add_product_container">
    <form enctype="multipart/form-data" action="/admin_products/insert" method="POST" class = "add_product_form">
        <div class = "add_product_static">
           <h1>Добавить продукт</h1>
            <span class = "close_block">
                <img src="/content/images/delete.png">
            </span>
            <div class = "add_product_data">
                    <div class = "add_product_image">
                        <img src="/content/images/noimage.jpg" class="main_prod_img"/>
                        <ul class = "other_prod_img">
                            <li><img src="/content/images/noimage.jpg" class = "secondary_prod_img"/></li>
                            <li><img src="/content/images/noimage.jpg" class = "secondary_prod_img"/></li>
                            <li><img src="/content/images/noimage.jpg" class = "secondary_prod_img"/></li>
                        </ul>

                        <input type = "hidden" name = "main_photo" value = "" class = "main_ph"/>
                        <input type = "hidden" name = "secondary_photos" value = "" class = "scnd_photos"/>

                        <div class = "link_to_files">
                            <span class = "span_link_to_file">Добавить/Изменить фото</span>
                        </div>
            </div>
                <div class = "add_products_main_data">
                    <table class = "add_product_table">
                        <tbody>
                            <tr>
                                <td>
                                    <p>Название:</p>
                                </td>
                                <td>
                                    <input type = "text" name = "name" value = ""/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Категория:</p>
                                </td>
                                <td>
                                    <select name = "category" class = "select_category">
                                        <option disabled>Выберите категорию</option>
                                        <?php
                                            if($data["category"])
                                            {
                                                foreach($data["category"] as $cat)
                                                {
                                                    ?>
                                        <option value = "<?=$cat["tag"]?>"><?=$cat["name"]?></option>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Подкатегория:</p>
                                </td>
                                <td>
                                    <select name = "subcategory" class = "select_subcategory">
                                        <option disabled>Выберите подкатегорию</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Описание:</p>
                                </td>
                                <td>
                                    <textarea name="description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Титульное название:</p>
                                </td>
                                <td>
                                    <input type = "text" name = "meta_title" value = ""/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Мини-описание (255 символов):</p>
                                </td>
                                <td>
                                    <textarea name="meta_description"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name = "submit" value="Добавить"/>
                                </td>
                                <td>
                                    <p class = "error_add"></p>
                                    <p class = "success_add"></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
