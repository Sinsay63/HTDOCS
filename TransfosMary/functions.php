<?php

// Add custom Theme Functions here
// 

$products_ids = array();

/* Création des pages d'options */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page('Base de données');
    acf_add_options_page('Configurateur');
    acf_add_options_page('Détail produit WooCommerce');
}

/* Ajout des scripts JS à Wordpress */

function my_scripts_method() {
    if (is_page()) {
        global $wp_query;
        $template_name = get_post_meta($wp_query->post->ID, '_wp_page_template', true);

        if ($template_name == 'template-devis.php') {
            wp_enqueue_script(
                    'configurateur',
                    get_stylesheet_directory_uri() . '/assets/js/configurateur.js',
                    array('jquery'),
                    false,
                    true
            );
        }
        if ($template_name == 'template-detail.php') {
            wp_enqueue_script(
                    'detail',
                    get_stylesheet_directory_uri() . '/assets/js/detail.js',
                    array('jquery'),
                    false,
                    true
            );
        }
    }
}

add_action('wp_enqueue_scripts', 'my_scripts_method');

/* Ajouter un script JS exécuté du côté Admin */
add_action('admin_enqueue_scripts', function () {

    wp_enqueue_script(
            'importer',
            get_stylesheet_directory_uri() . '/assets/js/importer.js',
            array('jquery'),
            false,
            true
    );

    wp_localize_script('importer', 'adminAjax', [
        'ajaxUrl' => admin_url('admin-ajax.php')
    ]);
});

/* Traitement à effectuer lorsque un nouveau CSV a été upload */
add_action('wp_ajax_first', 'my_ajax_first_handler');
add_action('wp_ajax_nopriv_first', 'my_ajax_first_handler');

function my_ajax_first_handler() {

    $reference = get_field('champs_reference', 'option');

    // answer function with success true or false if error
    echo json_encode([
        "success" => true,
        "action" => $_POST['action'],
        "index" => $_POST['index'],
        "max" => $_POST['max'],
        "d" => $_POST['d']
    ]);

    // Here is you code process
    buildCategory($_POST['d']);

    buildProduct($_POST['d']);

    wp_die(); // mandatory die at function end
}

/* Permet à un fichier CSS de s'exécuter côté admin */

function admin_style() {
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/assets/css/admin.css');
}

add_action('admin_enqueue_scripts', 'admin_style');

/* Permet d'ajouter une meta description à un produit */

function add_metadescription_to_yoast_seo($product_id, $metadesc) {

    $ret = false;

    if ($updated_desc != "none") {
        $updated_desc = update_post_meta($product_id, '_yoast_wpseo_metadesc', $metadesc);
        $ret = true;
    }

    return $ret;
}

/* Permet d'ajouter des mots clés à un produit */

function add_metakeywords_to_yoast_seo($product_id, $metakeywords) {

    $ret = false;

    if ($metakeywords != "none") {
        $updated_kw = update_post_meta($product_id, '_yoast_wpseo_focuskw', $metakeywords);
        $ret = true;
    }

    return $ret;
}

/* Permet de créer une description produit
 * Il est important de passer $data en paramètre de chaque fonction à cause des appels ajax
 */

function createDescription($data, $reference_technique, $tension_primaire, $tension_secondaire, $protection, $normes, $specificites, $courant_dappel) {
    $description = "";
    $description = $description . $reference_technique . " : " . $data[$reference_technique] . "<br>";
    $description = $description . $tension_primaire . " : " . $data[$tension_primaire] . "<br>";
    $description = $description . $tension_secondaire . " : " . $data[$tension_secondaire] . "<br>";
    $description = $description . $protection . " : " . $data[$protection] . "<br>";
    $description = $description . $normes . " : " . $data[$normes] . "<br>";
    $description = $description . $specificites . " : " . $data[$specificites] . "<br>";
    $description = $description . $courant_dappel . " : " . $data[$courant_dappel] . "<br>";

    return $description;
}

function buildCategory($data) {

    $categories = [$data['iD.principale'], $data['Cat.1'], $data['Cat.2'], $data['Cat.3'], $data['Cat.4']];
    foreach ($categories as $category) {
        if ($category != 'none') {


            $cat_name = $category;
            $cat_slug = sanitize_title($cat_name);
            $cat_parent = $data['Cat.2'];

            wp_insert_category(array(
                'taxonomy' => 'product_cat',
                'cat_name' => $cat_name,
                'category_nicename' => $cat_slug,
                'category_parent' => $cat_parent
            ));
        }
    }
}

/* Permet de générer un produit */

function buildProduct($data) {
    $reference = get_field('champs_reference', 'option');
    $nom = get_field('champs_nom', 'option');
    $description = get_field('champs_description', 'option');
    $reference_technique = get_field('champs_reference_technique', 'option');
    $tension_primaire = get_field('champs_tension_primaire', 'option');
    $tension_secondaire = get_field('champs_tension_secondaire', 'option');
    $protection = get_field('champs_protection', 'option');
    $normes = get_field('champs_normes', 'option');
    $specificites = get_field('champs_specificites', 'option');
    $courant_dappel = get_field('champs_courant_dappel', 'option');
    $mots_cles_seo = get_field('champs_mots_cles_seo', 'option');
    $meta_description_seo = get_field('champs_meta_description_seo', 'option');

    /* Si la référence est 'none' (produit spécifique), on ne l'ajoute pas */
    if ($data[$reference] === "none")
        return;

    /* Création d'un nouveau produit */
    /* wc_get_product_id_by_sku retourne l'index du produit à partir du SKU
      Si null, alors le produit n'existe pas et donc on peut le créer */
    if (!wc_get_product_id_by_sku($data[$reference])) {

        $objProduct = new WC_Product();
        $objProduct->set_sku($data[$reference]);

        $product_name_split = str_split($data[$nom], 1);
        foreach ($product_name_split as $key => $letter) {
            if ($letter == '0') {
                unset($product_name_split[$key]);
                while ($product_name_split[$key + 1] == '0') {
                    unset($product_name_split[$key + 1]);
                }
                break;
            }
        }
        $product_name = implode('', $product_name_split);

        $objProduct->set_name($product_name);

        $objProduct->set_short_description($data[$description]);

        $categories = [$data['iD.principale'], $data['Cat.1'], $data['Cat.2'], $data['Cat.3'], $data['Cat.4']];
        $cate = [];
        foreach ($categories as $category) {
            $cat = get_term_by('name', $category, 'product_cat');
            $id_category = $cat->term_id;
            $cate[] = $id_category;
        }
        $objProduct->set_category_ids($cate);
        $description = createDescription($data, $reference_technique, $tension_primaire, $tension_secondaire, $protection, $normes, $specificites, $courant_dappel);
        $objProduct->set_description($description);

        $objProduct->save();

        add_metadescription_to_yoast_seo(wc_get_product_id_by_sku($data[$reference]), $data[$meta_description_seo]);
        add_metakeywords_to_yoast_seo(wc_get_product_id_by_sku($data[$reference]), $data[$mots_cles_seo]);
    }
    /* Modification d'un produit existant */ else {
        $product_id = wc_get_product_id_by_sku($data[$reference]);
        $existing_product = wc_get_product($product_id);
        $changed = false;

        $product_name_split = str_split($data[$nom], 1);
        foreach ($product_name_split as $key => $letter) {
            if ($letter == '0') {
                unset($product_name_split[$key]);
                while ($product_name_split[$key + 1] == '0') {
                    unset($product_name_split[$key + 1]);
                }
                break;
            }
        }
        $product_name = implode('', $product_name_split);

        if ($existing_product->get_name() != $product_name) {

            $existing_product->set_name($product_name);
            $changed = true;
        }

        $cat_ids = $existing_product->get_category_ids();
        $categories = [$data['iD.principale'], $data['Cat.1'], $data['Cat.2'], $data['Cat.3'], $data['Cat.4']];
        foreach ($cat_ids as $id) {
            foreach ($categories as $category) {
                $cat = get_term_by('id', $category, 'product_cat');
                if ($cat) {
                    if ($id != $cat->term_id) {
                        $id_category = $cat->term_id;
                        $objProduct->set_category_ids([$id_category]);
                        $changed = true;
                    }
                }
            }
        }


        if ($existing_product->get_short_description() != $data[$description]) {
            $existing_product->set_short_description($data[$description]);
            $changed = true;
        }

        $description = createDescription($data, $reference_technique, $tension_primaire, $tension_secondaire, $protection, $normes, $specificites, $courant_dappel);
        if ($existing_product->get_description() != $description) {
            $existing_product->set_description($description);
            $changed = true;
        }

        $meta_description = get_post_meta($product_id, '_yoast_wpseo_metadesc', true);
        $meta_keywords = get_post_meta($product_id, '_yoast_wpseo_focuskw', true);
        if ($meta_description != $data[$meta_description_seo]) {
            add_metadescription_to_yoast_seo($product_id, $data[$meta_description_seo]);
            $changed = true;
        }
        if ($meta_keywords != $data[$meta_keywords]) {
            add_metakeywords_to_yoast_seo($product_id, $data[$mots_cles_seo]);
            $changed = true;
        }


        if ($changed === true) {
            $existing_product->save();
        }
    }
}

function removeZeros($data, $name_product) {

    return $product_name;
}
