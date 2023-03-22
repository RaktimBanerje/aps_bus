<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function csv($header, $data, $filename = "generated"){
    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=" . $filename .".csv");
    header("Pragma: no-cache");
    header("Expires: 0");

    $handler = fopen("php://output", "w");
    
    fputcsv($handler, $header);

    foreach($data as $element) {
        fputcsv($handler, $element);
    }

    fclose($handler);
}