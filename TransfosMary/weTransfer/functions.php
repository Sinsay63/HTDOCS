<?php

/**
 * /////////////////////// START Importer section (depending with importer option page ACF)
 */


add_action( 'wp_ajax_third', 'thirdProcessCSV' );
add_action( 'wp_ajax_nopriv_third', 'thirdProcessCSV' );
function thirdProcessCSV()
{
    // Function Dedicted to Categories import
    global $sitepress;
    $data = json_decode(html_entity_decode(stripslashes($_POST['d'])));
    $dataArr = json_decode(html_entity_decode(stripslashes($_POST['d'])), true);

    $cat = $dataArr['Type_produit'];
    $catSlug = sanitize_title($cat);
    $catDesc = $dataArr['DESCRIPTIF_FRANCAIS'];

    $catEn = $dataArr['Type_produit'];
    $catSlugEn = sanitize_title($catEn);
    $catDescEn = $dataArr['DESCRIPTIF_ANGLAIS'];

    $termFr = term_exists( $cat, 'product_cat', null );

    if($termFr['term_id'] !== null) {
        // ==== Update

        $termEn = icl_object_id($termFr['term_id'], 'product_cat', false,'en');

//        update_field('cols_filters', 'M / T / D', 'product_cat_'.$termFr['term_id']);
//        update_field('cols_filters', 'M / T / D', 'product_cat_'.$termEn);

        echo json_encode([
            "success" => true,
            "done" => "update",
            "action" => $_POST['action'],
            "index" => $_POST['index'],
            "max" => $_POST['max'],
            "id_fr" => $termFr['term_id'],
            "id_en" => $termEn,
            "d" => $data
        ]);

    } else {
        // ==== Creation

        $taxonomy = 'product_cat';
        $fr_category = wp_insert_term( $cat, $taxonomy, array(
            'description' => $catDesc, // optional
            'slug' => $catSlug // optional
        ) );

        $en_category = wp_insert_term( $catEn, $taxonomy, array(
            'description' => $catDescEn, // optional
            'slug' => $catSlugEn.'-en' // optional
        ) );

        // Join translations
        $wpml_element_type = apply_filters( 'wpml_element_type', 'product_cat' );
        $get_language_args = array('element_id' => $fr_category['term_taxonomy_id'], 'element_type' => $wpml_element_type );
        $original_post_language_info = apply_filters( 'wpml_element_language_details', null, $get_language_args );
        $set_language_args = array(
            'element_id'    => $en_category['term_taxonomy_id'],
            'element_type'  => $wpml_element_type,
            'trid'   => $original_post_language_info->trid,
            'language_code'   => 'en',
            'source_language_code' => $original_post_language_info->language_code
        );
        do_action( 'wpml_set_element_language_details', $set_language_args );

//        update_field('cols_filters', 'M / T / D / Crea', 'product_cat_'.$fr_category['term_taxonomy_id']);
//        update_field('cols_filters', 'M / T / D / Crea', 'product_cat_'.$en_category['term_taxonomy_id']);

        echo json_encode([
            "success" => true,
            "done" => "create",
            "action" => $_POST['action'],
            "index" => $_POST['index'],
            "max" => $_POST['max'],
            "id_fr" => $fr_category['term_taxonomy_id'],
            "id_en" => $en_category['term_taxonomy_id'],
            "d" => $data
        ]);

    }

    wp_die(); // mandatory die at function end
}

add_action( 'wp_ajax_snd', 'sndProcessCSV' );
add_action( 'wp_ajax_nopriv_snd', 'sndProcessCSV' );
function sndProcessCSV()
{
    // Function Dedicted to Products import
    global $sitepress;
    $data = json_decode(html_entity_decode(stripslashes($_POST['d'])));
    $dataArr = json_decode(html_entity_decode(stripslashes($_POST['d'])), true);

    $fount_post = get_page_by_title($dataArr['libellé 1'].' '.$dataArr['libellé 2'], OBJECT, 'product');

    if($fount_post === null) {
        // CREATE

        // Original Translation (FR)
        $post_data= [
            'post_title'    => $dataArr['libellé 1'].' '.$dataArr['libellé 2'],
            'post_type'    => 'product',
            'post_status'   => 'publish',
        ];
        $post_id = wp_insert_post( $post_data );
        productFillFields($post_id, $dataArr);

        // Translation (EN)
        $post_data_en= [
            'post_title'    => $dataArr['libellé 1'].' '.$dataArr['libellé 2'],
            'post_type'    => 'product',
            'post_status'   => 'publish',
        ];
        $en_post_id = wp_insert_post( $post_data_en );
        productFillFields($en_post_id, $dataArr, 'en');

        $termFr = term_exists( $dataArr['TYPE PRODUIT'], 'product_cat', null );
        if($termFr) {
            wp_set_object_terms( $post_id, $dataArr['TYPE PRODUIT'], 'product_cat' );
            $termEn = icl_object_id($termFr['term_id'], 'product_cat', false,'en');
            if($termEn) {
                wp_set_object_terms( $en_post_id, $termEn, 'product_cat' );
            }
        }

        // Join translations
        $wpml_element_type = apply_filters( 'wpml_element_type', 'post_product' );
        $get_language_args = array('element_id' => $post_id, 'element_type' => 'post_product' );
        $original_post_language_info = apply_filters( 'wpml_element_language_details', null, $get_language_args );
        $set_language_args = array(
            'element_id'    => $en_post_id,
            'element_type'  => $wpml_element_type,
            'trid'   => $original_post_language_info->trid,
            'language_code'   => 'en',
            'source_language_code' => $original_post_language_info->language_code
        );
        do_action( 'wpml_set_element_language_details', $set_language_args );

        echo json_encode([
            "success" => true,
            "done" => "create",
            "action" => $_POST['action'],
            "index" => $_POST['index'],
            "max" => $_POST['max'],
            "id_fr" => $post_id,
            "id_en" => $en_post_id,
            "d" => json_decode(html_entity_decode(stripslashes($_POST['d'])))
        ]);
    } else {
        // UPDATE
        $en_post_id = icl_object_id($fount_post->ID, 'post', false,'en');

        $termFr = term_exists( $dataArr['TYPE PRODUIT'], 'product_cat', null );
        if($termFr) {
            wp_set_object_terms( $fount_post->ID, $dataArr['TYPE PRODUIT'], 'product_cat' );
            $termEn = icl_object_id($termFr['term_id'], 'product_cat', false,'en');
            if($termEn) {
                wp_set_object_terms( $en_post_id, $termEn, 'product_cat' );
            }
        }

        productFillFields($fount_post->ID, $dataArr);
        productFillFields($en_post_id, $dataArr, 'en');

        echo json_encode([
            "success" => true,
            "done" => "update",
            "action" => $_POST['action'],
            "index" => $_POST['index'],
            "max" => $_POST['max'],
            "id_fr" => $fount_post->ID,
            "id_en" => $en_post_id,
            "d" => json_decode(html_entity_decode(stripslashes($_POST['d'])))
        ]);
    }

    wp_die(); // mandatory die at function end
}

add_action( 'wp_ajax_deletePosts', 'deletePosts' );
add_action( 'wp_ajax_nopriv_deletePosts', 'deletePosts' );
function deletePosts()
{

    // Here is you code process
    $args = [
        'post_type' => $_POST['type'],
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post__not_in' => explode(",", $_POST['d']),
        'suppress_filters' => true
    ];
    $my_query = new WP_Query($args);

    $posts = [];
    foreach ($my_query->posts as $post) {
        $resp = wp_delete_post( $post->ID, true );
        if($resp) array_push($posts, $post->post_title);
        else {
            echo json_encode([
                "success" => false,
                "action" => $_POST['action'],
                "indic" => $_POST['indic'],
                "type" => $_POST['type'],
                "err" => $post,
                "posts" => $posts,
                "d" => $_POST['d']
            ]);
            wp_die(); // mandatory die at function end
        }
    }

    // answer function with success true or false if error
    echo json_encode([
        "success" => true,
        "action" => $_POST['action'],
        "indic" => $_POST['indic'],
        "posts" => $posts,
        "d" => $_POST['d']
    ]);

    wp_die(); // mandatory die at function end
}

function productFillFields ($id, $data, $lang = 'fr') {

    // Init default product
    $objProduct = new WC_Product($id); //
    $objProduct->set_status("publish");
    $objProduct->set_stock_status('instock');
    $objProduct->set_catalog_visibility('visible');
    $objProduct->set_manage_stock(false);
    $objProduct->set_backorders('no');
    $objProduct->set_reviews_allowed(false);
    $objProduct->set_sold_individually(false);

    $attachmentID = getAttachmentIdByTitle('4X1-M84-1870-AD-ACBP');
    if($attachmentID !== false) $objProduct->set_image_id($attachmentID->ID);

    // Clear Price string removing espaces & € symbol
    $saniPrice = str_replace('€','',$data['PRIX HT']);
    $saniPrice = str_replace(' ','',$saniPrice);
    $price = floatval($saniPrice);

    // Set unique Identifier for products FR/EN
    $objProduct->set_sku($data['REF ext art']);

    // Set products price €
    $objProduct->set_price($price);
    $objProduct->set_regular_price($price);

    $objProduct->set_weight($data['POIDS TOTAL (kg)']);

//    $objProduct->set_width();
//    $objProduct->set_height();
//    $objProduct->set_length();

    // Set default quantity product
    $objProduct->set_stock_status('instock');
    $objProduct->set_manage_stock(false);

    // Fields
    update_field('prdct_type',$data['FAMILLE PRODUIT'],$id);
    update_field('prdct_connection',$data['connexion'],$id);
    update_field('prdct_typecode',$data['Code type produit'],$id);
    update_field('prdct_typeco',$data['Type Connexion'],$id);
    update_field('prdct_brandco',$data['Marque Connexion'],$id);
    update_field('prdct_var1',$data['Variante 1'],$id);
    update_field('prdct_var2',$data['Variante 2'],$id);
    update_field('prdct_capiso', $data['CAPACITE ISO (L)'],$id);
    update_field('prdct_weightaccess', $data['POIDS ACCESSOIRE (kg)'],$id);
    update_field('prdct_weighttotal', $data['POIDS TOTAL (kg)'],$id);
    update_field('prdct_trapgb', $data['TRAPEZE - GB (mm)'],$id);
    update_field('prdct_trappb', $data['TRAPEZE - PB (mm)'],$id);
    update_field('prdct_traphsp', $data['TRAPEZE - HSP (mm)'],$id);
    update_field('prdct_brandtoothtype', $data['Marque-Type DENTS'],$id);
    update_field('prdct_toothref', $data['Ref. DENTS'],$id);
    update_field('prdct_toothnb', $data['NOMBRE DENTS'],$id);
    update_field('prdct_accessbrand', $data['MARQUE ACCESSOIRES'],$id);
    update_field('prdct_accesstype', $data['TYPE ACCESSOIRES'],$id);
    update_field('prdct_standard', $data['STANDARD OUI / NON'],$id);

    // Set descriptions product
    $objProduct->set_description($data['DESCRIPTIF']);
    $objProduct->set_short_description($data['DESCRIPTIF-SIMPLIFIE']);

    // Execute save of parameters
    $product_id = $objProduct->save();

//    $parent_id = $product_id;
//
//    $variations = getCombinations($parent_id);
//
//    $data_store = WC_Data_Store::load( 'product-variable' );
//    $data_store->delete_variations($parent_id);
//    foreach ($variations as $var) {
//
//        $variation = array(
//            'post_title'    => $data['libellé 1'].' '.$data['libellé 2'].' variation',
//            'post_content' => '',
//            'post_status'  => 'publish',
//            'post_parent'  => $parent_id,
//            'post_type'    => 'product_variation'
//        );
//
//        // The variation id
//        $variation_id = wp_insert_post( $variation );
//
//        // Regular Price ( you can set other data like sku and sale price here )
//        update_post_meta( $variation_id, '_regular_price', $price );
//        update_post_meta( $variation_id, '_price', $price );
//        update_post_meta( $variation_id, '_weight', $data['POIDS TOTAL (kg)']);
//        update_post_meta( $variation_id, '_sku', $data['REF ext art']);
//        update_post_meta( $variation_id, '_stock_status', 'instock');
//        update_post_meta( $variation_id, '_manage_stock', "no");
//
//        foreach ($var as $k => $j) {
//            update_post_meta( $variation_id, 'attribute_' . $k, $j );
//        }
//
//    }
//
//    WC_Product_Variable::sync( $parent_id );
}

function testinit() {
//    $attachmentID = getAttachmentIdByTitle('LEVE-PAL-1500-AD-ACBP');
//    var_dump($attachmentID->ID);
//    $attachmentID2 = getAttachmentIdByTitle('4X1-M84-1870-AD-ACBP');
//    var_dump($attachmentID2->ID);
//    $attachmentID3 = getAttachmentIdByTitle('pince');
//    var_dump($attachmentID3->ID);
//    exit();
}
add_action('init', 'testinit');

function getAttachmentIdByTitle($post_name) {
    $args           = array(
        'posts_per_page' => 1,
        'post_type'      => 'attachment',
        'name'           => trim( $post_name ),
    );
//    var_dump($args);

    $get_attachment = new WP_Query( $args );
//    var_dump($get_attachment);

    if ( ! $get_attachment || ! isset( $get_attachment->posts, $get_attachment->posts[0] ) ) {
        return false;
    }

    return $get_attachment->posts[0];
}

/**
 * /////////////////////// END Importer section
 */

// All all types of file to be uploaded
define('ALLOW_UNFILTERED_UPLOADS', true);

// allow duplicate SKU
add_filter( 'wc_product_has_unique_sku', '__return_false' );