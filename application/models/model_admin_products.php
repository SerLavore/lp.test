<?php
class Model_Admin_Products extends Model
{

    public function __construct()
    {

    }

    public function get_data(array $arr = null)
    {
        $menu = $this->query("SELECT * FROM lp_admin_menu");
        $products = $this->query("SELECT * FROM lp_products");
        $category =  $this->query("SELECT * FROM lp_categories_products");

        return array(
            "menu" => $menu,
            "products" => $products,
            "category" => $category,
        );
    }

    public function delete_product(array $arr = null)
    {
        return $this->query("DELETE FROM lp_products WHERE id =" . $arr["id"]);
    }

    public function insert_product(array $arr = null)
    {
        $this->query("INSERT INTO lp_products (name, description, title, meta_description, category_tag, subcat_tag, image, another_images) VALUES ('$arr[0]', '$arr[1]', '$arr[2]', '$arr[3]' , '$arr[4]' , '$arr[5]' , '$arr[6]' , '$arr[7]')");
        return true;
    }

    public function get_data_by_id($id)
    {
        $data = $this->query("SELECT * FROM lp_products WHERE id = " . $id);

        return array(
            "data" => $data,
        );
    }

    public function get_subcategory($where)
    {
        $subcat = $this->query("SELECT * FROM lp_subcategories_products WHERE category_tag = '$where'");

        return array(
            "subcat" => $subcat,
        );
    }

    public function get_image_folder()
    {
        $imgs = $this->query("SELECT * FROM lp_userfiles");

        return array(
            "imgs" => $imgs,
        );
    }

}
