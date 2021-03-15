<?php
    $file1=fopen('students.csv','r');
    $file2=fopen('filles.csv','w');
    $file3=fopen('gars.csv','w');

    while(!feof($file1)) {
        $data=fgetcsv($file1, 1024,';');
        if ($data[4]=="M"){
            fputcsv($file3,$data,';');
        }
        else if ($data[4]=="F"){
            fputcsv($file2,$data,';');
        }
    }
    fclose($file1);
    fclose($file2);
    fclose($file3);

?>