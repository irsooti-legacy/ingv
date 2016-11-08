<?php

    header("Access-Control-Allow-Origin: *");
    
    include "ingv/INGV.php";

    $INGV_start = new INGV;
    
    if (isset($_GET['request'])) {
        $request = $_GET['request'];
        switch ($request) {
            case 'json':
                $INGV_start->getJSON();
                break;
            case 'xml':
                $INGV_start->getXML();
                break;
            case 'csv':
                $INGV_start->getCSV();
                break;
            default:
                $INGV_start->getJSON();
        }
    }

    else $INGV_start->getJSON();