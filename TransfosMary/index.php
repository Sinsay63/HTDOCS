<?php

$product_name_split = str_split( '001chocolat00002',1);
        foreach ($product_name_split as $key => $letter) {
            if ($letter == '0') {
                unset($product_name_split[$key]);
                while($product_name_split[$key + 1] == '0'){
                    unset($product_name_split[$key+1]);
                }
                break;
            }
        }
        $product_name = implode('',$product_name_split);
        
        echo $product_name;