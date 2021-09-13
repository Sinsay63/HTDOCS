<?php

$product_name_split = str_split('TPP 000100', 1);
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
    echo implode('', $product_name_split);