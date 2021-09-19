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

    buildCategory($_POST['d']);
    $attributes_ids = buildAttributes($_POST['d']);
    $id = buildProduct($_POST['d'], $attributes_ids);

// answer function with success true or false if error
    echo json_encode([
        "success" => true,
        "action" => $_POST['action'],
        "index" => $_POST['index'],
        "max" => $_POST['max'],
        "id" => $id,
        "d" => $_POST['d'],
        "suppress_filter" => true
    ]);

// Here is you code process

    wp_die(); // mandatory die at function end
}

/* Permet à un fichier CSS de s'exécuter côté admin */

function admin_style() {
    wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/assets/css/admin.css');
}

add_action('admin_enqueue_scripts', 'admin_style');

/* Permet d'ajouter un meta titre à un produit */

function add_metatitle_to_yoast_seo($product_id, $metatitle) {
    $ret = false;

    if ($updated_title != "none") {
        $updated_title = update_post_meta($product_id, '_yoast_wpseo_title', $metatitle);
        $ret = true;
    }
    return $ret;
}

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

function insertCategory($data, $cat_name, $cat_parent) {

    $cat_slug = sanitize_title($cat_name);
    $category_parent = get_term_by('name', $cat_parent, 'product_cat');
    $cat_parent_id = $category_parent->term_id;
    if ($cat_name != "Autres tensions") {
        wp_insert_category(array(
            'taxonomy' => 'product_cat',
            'cat_name' => $cat_name,
            'category_nicename' => $cat_slug,
            'category_parent' => $cat_parent_id
        ));
    }
}

// Permet de générer les catégories associées à un produit
function buildCategory($data) {

    if ($data['Cat.4'] != 'none' && $data['Cat.4'] != '') {
        if ($data['Cat.2'] == 'Transformateurs monophasés' || $data['Cat.2'] == 'Transformateurs triphasés') {
            insertCategory($data, $data['Cat.2'], $data['Type']);
            insertCategory($data, $data['Cat.3'], $data['Cat.2']);
            insertCategory($data, $data['Cat.4'], $data['Cat.3']);
            insertCategory($data, $data['iD.principale'], $data['Cat.4']);
        } else {
            insertCategory($data, $data['Cat.3'], $data['Type']);
            insertCategory($data, $data['Cat.4'], $data['Cat.3']);
            insertCategory($data, $data['iD.principale'], $data['Cat.4']);
        }
    } else if ($data['Cat.3'] != 'none' && $data['Cat.3'] != '') {
        if ($data['Cat.2'] == 'Transformateurs monophasés' || $data['Cat.2'] == 'Transformateurs triphasés') {
            insertCategory($data, $data['Cat.2'], $data['Type']);
            insertCategory($data, $data['Cat.3'], $data['Cat.2']);
            insertCategory($data, $data['iD.principale'], $data['Cat.3']);
        } else {
            insertCategory($data, $data['Cat.3'], $data['Type']);
            insertCategory($data, $data['iD.principale'], $data['Cat.3']);
        }
    } else {
        if ($data['Cat.2'] == 'Transformateurs monophasés' || $data['Cat.2'] == 'Transformateurs triphasés') {
            insertCategory($data, $data['Cat.2'], $data['Type']);
            insertCategory($data, $data['iD.principale'], $data['Cat.2']);
        } else {
            insertCategory($data, $data['iD.principale'], $data['Type']);
        }
    }
}

function createAttributes($nom, $taxonomy) {

    if ($nom != 'none') {
        $slug = sanitize_title($nom);
        $args = ['slug' => $slug];
        $id_attribut = get_term_by('name', $nom, $taxonomy)->term_id;
        if (!$id_attribut) {
            $id_attr = wp_insert_term($nom, $taxonomy, $args);
            $id_attribut = $id_attr['term_id'];
        }
        return $id_attribut;
    }
}

function buildAttributes($data) {
    $finition_taxo = 'pa_finition';
    $tension_taxo = 'pa_tension';
    $puissance_taxo = 'pa_puissance-va';
    $courant_taxo = 'pa_courant';
    $version_taxo = 'pa_version';

    $list_attributs = [
        [$courant_taxo, $data['Courant']],
        [$puissance_taxo, $data['Puissance']],
        [$tension_taxo, $data['Tension primaire / Tension secondaire']],
        [$finition_taxo, $data['Finition']],
        [$version_taxo, $data['Version']]
    ];

    $list_ids = [];

    foreach ($list_attributs as $attribut) {
        $id = createAttributes($attribut[1], $attribut[0]);
        $list_ids[] = [$attribut[0], $id];
    }
    return $list_ids;
}

function createDescription($data, $reference_technique, $tension_primaire, $tension_secondaire, $protection, $normes, $courant_dappel, $puissance, $echauffements, $frequence, $temp_ambiante_max, $perte_a_vide, $perte_en_charge, $chute_de_tension, $ucc, $rendement, $AxBxH, $axb, $ø, $poids, $primaire_230v_fusible_am, $primaire_230v_disjoncteur_d, $primaire_400v_fusibles_am, $primaire_400v_disjonteurs_d, $secondaire_230v_fusibles_gg, $secondaire_230v_disjoncteurs_c, $secondaire_400v_fusibles_gg, $secondaire_400v_disjoncteurs_c, $secondaire_24v, $secondaire_48v, $secondaire_230v, $autres_tensions, $ecran_electrostatique, $sondes_de_temperature_ptc_pt100_bilame, $prises_de_reglages, $couplage_primaire_etou_secondaire_etoile_triangle_zigzag, $double_primaire, $courant_dappel_frequence_echauffements_temperature_ambiante_altitude_specifiques, $tropicalisation, $supports_antivibratiles, $galets_de_roulement, $protections_primaires_et_secondaires_montees_cablees_en_usine, $couleur_specifique_du_coffret) {
    $caracteristiques = [$reference_technique, $tension_primaire, $tension_secondaire, $protection, $normes, $courant_dappel, $puissance, $echauffements, $frequence, $temp_ambiante_max, $perte_a_vide, $perte_en_charge, $chute_de_tension, $ucc, $rendement];
    $dimensions = [$AxBxH, $axb, $ø, $poids];
    $protections = [$primaire_230v_fusible_am, $primaire_230v_disjoncteur_d, $primaire_400v_fusibles_am, $primaire_400v_disjonteurs_d, $secondaire_230v_fusibles_gg, $secondaire_230v_disjoncteurs_c, $secondaire_400v_fusibles_gg, $secondaire_400v_disjoncteurs_c, $secondaire_24v, $secondaire_48v, $secondaire_230v, $autres_tensions];
    $options = [$ecran_electrostatique, $sondes_de_temperature_ptc_pt100_bilame, $prises_de_reglages, $couplage_primaire_etou_secondaire_etoile_triangle_zigzag, $double_primaire, $courant_dappel_frequence_echauffements_temperature_ambiante_altitude_specifiques,$tropicalisation, $supports_antivibratiles, $galets_de_roulement, $protections_primaires_et_secondaires_montees_cablees_en_usine, $couleur_specifique_du_coffret];

    $description = "<div style='display:flex'><div style='padding-left:50px;'>";
    $description = $description . '<p style="font-size:20px;margin-bottom: 5px; text-decoration:underline;"> Caractéristiques techniques :</p> <br>';
    $nb_carac = 0;
    foreach ($caracteristiques as $caracteristique) {
        if ($data[$caracteristique] != 'none' && $data[$caracteristique] != "\rnone") {
            $description = $description . '<b>' . $caracteristique . '</b> : ' . $data[$caracteristique] . "<br>";
            $nb_carac++;
        }
    }
    if ($nb_carac == 0) {
        $description = $description . "<b>Aucune catactéritiques trouvées.</b>";
    }
    $description = $description . "</div><div style='padding-left:50px;'>";

    $description = $description . '<p style="font-size:20px ;margin-bottom: 5px; text-decoration:underline;">Dimensions :</p> <br>';
    $nb_dimen = 0;
    foreach ($dimensions as $dimension) {
        if ($data[$dimension] != 'none') {
            $description = $description . '<b>' . $dimension . ' </b>: ' . $data[$dimension] . "<br>";
            $nb_dimen++;
        }
    }
    if ($nb_dimen == 0) {
        $description = $description . "<b>Aucune dimensions trouvées.</b>";
    }
    $description = $description . '<br><p style="font-size: 20px; margin-bottom:5px; text-decoration:underline;">Protection(s) recommandée(s) :</p> <br>';

    $nb1 = false;
    foreach ($protections as $protection) {
        if ($data[$protection] != 'none') {
            $description = $description . '<b>' . $protection . '</b> : ' . $data[$protection] . "<br>";
            $nb1 = true;
        }
    }
    if (!$nb1) {
        $description = $description . "<b> Aucune protections recommandées trouvées.</b><br>";
    }
    $description = $description . " </div></div><div style='padding-left:50px;'>";
    $description = $description . '<p style="font-size: 20px;margin-bottom:5px;text-decoration:underline;">Options:</p> <br>';
    $nb2 = false;

    foreach ($options as $option) {
        if ($data[$option] != 'none') {
            $description = $description . "<b>" . $option . "</b><br>";
            $nb2 = true;
        }
    }
    if (!$nb2) {
        $description = $description . "<b> Aucune options trouvées.</b><br>";
    }
    $description = $description . " </div>";
    return $description;
}

/* Permet de générer un produit */

function buildProduct($data, $attributes_ids) {

    $reference = get_field('champs_reference', 'option');
    $nom = get_field('champs_nom', 'option');
    $description = get_field('champs_description', 'option');
    $reference_technique = get_field('champs_reference_technique', 'option');
    $tension_primaire = get_field('champs_tension_primaire', 'option');
    $tension_secondaire = get_field('champs_tension_secondaire', 'option');
    $protection = get_field('champs_protection', 'option');
    $normes = get_field('champs_normes', 'option');
    $courant_dappel = get_field('champs_courant_dappel', 'option');
    $meta_titre_seo = get_field('champs_meta_titre_seo', 'option');
    $mots_cles_seo = get_field('champs_mots_cles_seo', 'option');
    $meta_description_seo = get_field('champs_meta_description_seo', 'option');
    $puissance = get_field('champs_puissance', 'option');
    $echauffements = get_field('champs_echauffements', 'option');
    $frequence = get_field('champs_frequence', 'option');
    $temp_ambiante_max = get_field('champs_t°_ambiante_max', 'option');
    $perte_a_vide = get_field('champs_pertes_a_vide', 'option');
    $perte_en_charge = get_field('champs_pertes_en_charge', 'option');
    $chute_de_tension = get_field('champs_chute_de_tension', 'option');
    $ucc = get_field('champs_ucc', 'option');
    $rendement = get_field('champs_rendement', 'option');
    $AxBxH = get_field('champs_a_x_b_x_h', 'option');
    $axb = get_field('champs_a_x_b', 'option');
    $ø = get_field('champs_ø', 'option');
    $poids = get_field('champs_poids', 'option');
    $primaire_230v_fusible_am = get_field('champs_primaire_230v_fusible_am', 'option');
    $primaire_230v_disjoncteur_d = get_field('champs_primaire_230v_disjoncteur_d', 'option');
    $primaire_400v_fusibles_am = get_field('champs_primaire_400v_fusibles_am', 'option');
    $primaire_400v_disjonteurs_d = get_field('champs_primaire_400v_disjonteurs_d', 'option');
    $secondaire_230v_fusibles_gg = get_field('champs_secondaire_230v_fusibles_gg', 'option');
    $secondaire_230v_disjoncteurs_c = get_field('champs_secondaire_230v_disjoncteurs_c', 'option');
    $secondaire_400v_fusibles_gg = get_field('champs_secondaire_400v_fusibles_gg', 'option');
    $secondaire_400v_disjoncteurs_c = get_field('champs_secondaire_400v_disjoncteurs_c', 'option');
    $secondaire_24v = get_field('champs_secondaire_24v', 'option');
    $secondaire_48v = get_field('champs_secondaire_48v', 'option');
    $secondaire_230v = get_field('champs_secondaire_230v', 'option');
    $autres_tensions = get_field('champs_autres_tensions', 'option');
    $ecran_electrostatique = get_field('champs_ecran_electrostatique', 'option');
    $sondes_de_temperature_ptc_pt100_bilame = get_field('champs_sondes_de_temperature_ptc_pt100_bilame', 'option');
    $prises_de_reglages = get_field('champs_prises_de_reglages', 'option');
    $couplage_primaire_etou_secondaire_etoile_triangle_zigzag = get_field('champs_couplage_primaire_etou_secondaire_etoile_triangle_zig-zag', 'option');
    $double_primaire = get_field('champs_double_primaire', 'option');
    $courant_dappel_frequence_echauffements_temperature_ambiante_altitude_specifiques = get_field('champs_courant_dappel_frequence_echauffements_temperature_ambiante_altitude_specifiques', 'option');
    $tropicalisation = get_field('champs_tropicalisation', 'option');
    $supports_antivibratiles = get_field('champs_supports_antivibratiles', 'option');
    $galets_de_roulement = get_field('champs_galets_de_roulement', 'option');
    $protections_primaires_et_secondaires_montees_cablees_en_usine = get_field('champs_protections_primaires_et_secondaires_montees-cablees_en_usine', 'option');
    $couleur_specifique_du_coffret = get_field('champs_couleur_specifique_du_coffret', 'option');

    /* Création d'un nouveau produit */
    /* wc_get_product_id_by_sku retourne l'index du produit à partir du SKU
      Si null, alors le produit n'existe pas et donc on peut le créer */
    if (!wc_get_product_id_by_sku($data[$reference]) && !wc_get_product_id_by_sku(RmvZerosFromProductName($data, $data[$nom]))) {

        $objProduct = new WC_Product();
//      Fonction de supression des 0 dans le nom des produits

        $product_name = RmvZerosFromProductName($data, $data[$nom]);

        $référence = '';
        if ($data[$reference] != 'none' && $data[$reference] != "\rnone") {
            $objProduct->set_sku($data[$reference]);
            $référence = $data[$reference];
        } else {

            $objProduct->set_sku($product_name);
            $référence = $product_name;
        }


        $objProduct->set_name($product_name);

        $objProduct->set_short_description($data[$description]);

        $categories = [$data['Type'], $data['Cat.2'], $data['Cat.3'], $data['Cat.4'], $data['iD.principale']];
        $cate = [];
        foreach ($categories as $category) {
            $cat = get_term_by('name', $category, 'product_cat');
            $id_category = $cat->term_id;
            $cate[] = $id_category;
        }
        $objProduct->set_category_ids($cate);

        $description = createDescription($data, $reference_technique, $tension_primaire, $tension_secondaire, $protection, $normes, $courant_dappel, $puissance, $echauffements, $frequence, $temp_ambiante_max, $perte_a_vide, $perte_en_charge, $chute_de_tension, $ucc, $rendement, $AxBxH, $axb, $ø, $poids, $primaire_230v_fusible_am, $primaire_230v_disjoncteur_d, $primaire_400v_fusibles_am, $primaire_400v_disjonteurs_d, $secondaire_230v_fusibles_gg, $secondaire_230v_disjoncteurs_c, $secondaire_400v_fusibles_gg, $secondaire_400v_disjoncteurs_c, $secondaire_24v, $secondaire_48v, $secondaire_230v, $autres_tensions, $ecran_electrostatique, $sondes_de_temperature_ptc_pt100_bilame, $prises_de_reglages, $couplage_primaire_etou_secondaire_etoile_triangle_zigzag, $double_primaire, $courant_dappel_frequence_echauffements_temperature_ambiante_altitude_specifiques, $tropicalisation, $supports_antivibratiles, $galets_de_roulement, $protections_primaires_et_secondaires_montees_cablees_en_usine, $couleur_specifique_du_coffret);
        $objProduct->set_description($description);

        $image = removeExtensionImage($data['Image 1']);
        $attachmentID = getAttachmentIdByTitle($image);
        $objProduct->set_image_id($attachmentID->ID);
        $image2 = removeExtensionImage($data['Plan']);
        $attachmentID2 = getAttachmentIdByTitle($image2);
        if ($data['Picto'] != 'none') {
            $image3 = removeExtensionImage($data['Picto']);
            $attachmentID3 = getAttachmentIdByTitle($image3);
            $objProduct->set_gallery_image_ids([$attachmentID2->ID, $attachmentID3->ID]);
        } else {
            $objProduct->set_gallery_image_ids([$attachmentID2->ID]);
        }

        $list_attributs = [];
        foreach ($attributes_ids as $attribut) {
            $attribute = new \WC_Product_Attribute();
            $attribute->set_options([$attribut[1]]);
            $attribute->set_id($attribut[1]);
            $attribute->set_name($attribut[0]);
            $attribute->set_visible(true);
            $attribute->set_variation(false);

            $list_attributs[] = $attribute;
        }

        $objProduct->set_attributes($list_attributs);

        $objProduct->save();
        if ($data[$meta_titre_seo] != "none") {
            add_metatitle_to_yoast_seo(wc_get_product_id_by_sku($référence), $data[$meta_titre_seo]);
        }
        add_metadescription_to_yoast_seo(wc_get_product_id_by_sku($référence), $data[$meta_description_seo]);
        add_metakeywords_to_yoast_seo(wc_get_product_id_by_sku($référence), $data[$mots_cles_seo]);

        return $objProduct->get_id();
    }
    /* Modification d'un produit existant */ else {

//      Fonction de supression des 0 dans le nom des produits        
        $product_name = RmvZerosFromProductName($data, $data[$nom]);

        if (wc_get_product_id_by_sku($data[$reference])) {
            $product_id = wc_get_product_id_by_sku($data[$reference]);
        } else {
            $ref = RmvZerosFromProductName($data, $data[$nom]);
            $product_id = wc_get_product_id_by_sku($ref);
        }

        $existing_product = wc_get_product($product_id);
        $changed = false;

        if ($existing_product->get_name() != $product_name) {
            $existing_product->set_name($product_name);
            $changed = true;
        }

        $cat_ids = $existing_product->get_category_ids();
        $categories = [$data['Type'], $data['iD.principale'], $data['Cat.2'], $data['Cat.3'], $data['Cat.4']];
        $new_cat_ids = [];
        $modif = false;
        foreach ($categories as $category) {
            $cat = get_term_by('name', $category, 'product_cat');
            $cat_id = $cat->term_id;
            foreach ($cat_ids as $id) {
                if ($cat_id != $id) {
                    $modif = true;
                }
            }
            $new_cat_ids[] = $cat_id;
        }

        if ($modif) {
            $existing_product->set_category_ids($new_cat_ids);
            $changed = true;
        }

        $image = removeExtensionImage($data['Image 1']);
        $attachmentID = getAttachmentIdByTitle($image);
        if (intval($existing_product->get_image_id()) != $attachmentID->ID) {
            $existing_product->set_image_id($attachmentID->ID);
            $changed = true;
        }

        $images = [removeExtensionImage($data['Plan']), removeExtensionImage($data['Picto'])];
        $img_ids = [];
        foreach ($images as $img) {
            $attachmentID2 = getAttachmentIdByTitle($img);
            $img_ids[] = $attachmentID2->ID;
        }

        $exist_img_ids = $existing_product->get_gallery_image_ids();
        $modif2 = false;
        if ($exist_img_ids != null || !$exist_img_ids) {
            foreach ($exist_img_ids as $exist_img_id) {
                foreach ($img_ids as $ids) {
                    if ($exist_img_id != $ids || $exist_img_id == null || !$exist_img_id) {
                        $modif2 = true;
                    }
                }
            }
        } else {
            $modif2 = true;
        }
        if ($modif2) {
            if ($data['Picto'] != 'none') {
                $existing_product->set_gallery_image_ids($img_ids);
            } else {
                $existing_product->set_gallery_image_ids([$img_ids[0]]);
            }
            $changed = true;
        }

        $list_attributs = [];
        foreach ($attributes_ids as $attribut) {
            $attribute = new \WC_Product_Attribute();
            $attribute->set_options([$attribut[1]]);
            $attribute->set_id($attribut[1]);
            $attribute->set_name($attribut[0]);
            $attribute->set_visible(true);
            $attribute->set_variation(false);

            $list_attributs[] = $attribute;
        }

        $existing_product->set_attributes($list_attributs);

        if ($existing_product->get_short_description() != $data[$description]) {
            $existing_product->set_short_description($data[$description]);
            $changed = true;
        }

        $description = createDescription($data, $reference_technique, $tension_primaire, $tension_secondaire, $protection, $normes, $courant_dappel, $puissance, $echauffements, $frequence, $temp_ambiante_max, $perte_a_vide, $perte_en_charge, $chute_de_tension, $ucc, $rendement, $AxBxH, $axb, $ø, $poids, $primaire_230v_fusible_am, $primaire_230v_disjoncteur_d, $primaire_400v_fusibles_am, $primaire_400v_disjonteurs_d, $secondaire_230v_fusibles_gg, $secondaire_230v_disjoncteurs_c, $secondaire_400v_fusibles_gg, $secondaire_400v_disjoncteurs_c, $secondaire_24v, $secondaire_48v, $secondaire_230v, $autres_tensions, $ecran_electrostatique, $sondes_de_temperature_ptc_pt100_bilame, $prises_de_reglages, $couplage_primaire_etou_secondaire_etoile_triangle_zigzag, $double_primaire, $courant_dappel_frequence_echauffements_temperature_ambiante_altitude_specifiques, $tropicalisation, $supports_antivibratiles, $galets_de_roulement, $protections_primaires_et_secondaires_montees_cablees_en_usine, $couleur_specifique_du_coffret);
        if ($existing_product->get_description() != $description) {
            $existing_product->set_description($description);
            $changed = true;
        }

        $meta_title = get_post_meta($product_id, '_yoast_wpseo_title', true);
        $meta_description = get_post_meta($product_id, '_yoast_wpseo_metadesc', true);
        $meta_keywords = get_post_meta($product_id, '_yoast_wpseo_focuskw', true);
        if ($meta_title == 'none' && $data[$meta_titre_seo == 'none']) {
            add_metatitle_to_yoast_seo($product_id, '');
        } else {
            if ($meta_title != $data[$meta_titre_seo] && $data[$meta_titre_seo != 'none']) {
                add_metatitle_to_yoast_seo($product_id, $data[$meta_titre_seo]);
                $changed = true;
            }
        }

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
            return $existing_product->get_id();
        }
    }
}

function RmvZerosFromProductName($data, $prod_name) {

    $product_name_split = str_split($prod_name, 1);
    $nombres = ['1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $stop = false;
    foreach ($product_name_split as $key => $letter) {
        if ($letter == '0') {
            unset($product_name_split[$key]);
            if ($product_name_split[$key + 1] == '0') {
                unset($product_name_split[$key + 1]);
            }
            break;
        } else {
            foreach ($nombres as $nombre) {
                if ($letter == $nombre) {
                    $stop = true;
                }
            }
        }
        if ($stop) {
            break;
        }
    }
    return implode('', $product_name_split);
}

function removeExtensionImage($word) {
    $img_split = str_split($word, 1);
    $mot = [];
    foreach ($img_split as $letter) {
        if ($letter != '.') {
            $mot[] = $letter;
        } else {
            break;
        }
    }
    return implode('', $mot);
}

function getAttachmentIdByTitle($post_name) {
    $args = array(
        'posts_per_page' => 1,
        'post_type' => 'attachment',
        'name' => trim($post_name),
    );
//    var_dump($args);

    $get_attachment = new WP_Query($args);
//    var_dump($get_attachment);

    if (!$get_attachment || !isset($get_attachment->posts, $get_attachment->posts[0])) {
        return false;
    }

    return $get_attachment->posts[0];
}

add_action('wp_ajax_deletePosts', 'deletePosts');
add_action('wp_ajax_nopriv_deletePosts', 'deletePosts');

function deletePosts() {

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
        $resp = wp_delete_post($post->ID, true);
        if ($resp) {
            array_push($posts, $post->post_title);
        } else {
            echo json_encode([
                "success" => false,
                "action" => $_POST['action'],
                "indic" => $_POST['indic'],
                "type" => $_POST['type'],
                "err" => $post,
                "posts" => $posts
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

add_filter('woocommerce_product_tabs', 'woo_reorder_tabs', 98);

function woo_reorder_tabs($tabs) {

    $tabs['additional_information']['priority'] = 5; // Reviews first
    $tabs['description']['priority'] = 10;   // Description second

    return $tabs;
}

add_filter('gettext', 'translate_woocommerce', 10, 3);

function translate_woocommerce($translation, $text, $domain) {
    if ($domain == 'woocommerce') {
        switch ($text) {
            case 'SKU':
                $translation = 'Référence ';
                break;
            case 'SKU:':
                $translation = 'Référence: ';
                break;
        }
    }
    return $translation;
}

add_action('woocommerce_before_checkout_form', 'my__scripts_checkout');

function my__scripts_checkout() {
    ?> 
    <script>
        let productTitle = document.querySelector('.product-title').innerText;
        let url = `https://transfosmary.mycoqpit.fr/mes-devis/?productName=${productTitle}`;
        const divCatProduct = document.querySelector('.product_meta');
        let href = document.createElement('a');
        href.setAttribute('href', url);
        let btnDevis = document.createElement('button');
        btnDevis.innerText = 'Demander un devis';
        btnDevis.classList.add('button');
        href.appendChild(btnDevis);
        divCatProduct.appendChild(href);
    </script>
    <?php

}
