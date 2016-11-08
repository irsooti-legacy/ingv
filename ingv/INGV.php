<?php

header("Access-Control-Allow-Origin: *");

// Dependancies
include "inc/array-to-csv.php";

class INGV {
    private static $HQ;
    private static function getINGVArray()
    {
        // This array will contain all hearthquake data
        $HQ = [];

        // Get cURL resource from: http://webservices.ingv.it/fdsnws/event/1/query

        /*
        * I choosen this format (Y-m-d\TH:i:s) because INGV server
        * wants this particular date format given from some html
        * text input. Thanks to Charlie http://php.net/manual/en/function.date.php#118457
        */

        // Should be the last record, we can't see the future! For now...'
        $endTime = date('Y-m-d\TH:i:s'); 

        // Subtracting our $endTime by 1 month
        $newdate = strtotime ( '-1 month' , strtotime ( $endTime ) ) ;

        // Turn in Y-m-d\TH:i:s
        $startTime = date ( 'Y-m-d\TH:i:s' , $newdate );

        // Defining default array container
        $params = array(
            "starttime" => $startTime,
            "endtime" => $endTime,
            "minmag" => 2,
            "maxmag" => 10,
            "mindepth" => -10,
            "maxdepth" => 1000,
            "minlat" => -90,
            "maxlat" => 90,
            "minlon" => -180,
            "maxlon" => 180,
            "minversion" => 100,
            "format" => "text",
            "limit" => 100
        );

        if (isset($_GET)) {
            // $_GET will manage our request, modifing $params property => value
            foreach (array_keys($_GET) as $prop) {
                $params[$prop] = $_GET[$prop];
            }
        }

        // Awesome function, parse an array into an urlencoded string
        $query = http_build_query($params);
        $curl = curl_init();

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://webservices.ingv.it/fdsnws/event/1/query?'.$query,
            CURLOPT_USERAGENT => 'ingv-json.herokuapp.com - github.com/irsooti',
        ));

        // Send the request & save response to $resp
        $resp = curl_exec($curl);

        // Close request to clear up some resources
        curl_close($curl);

        /*

        **  Raw parameters are separated by line break and pipe. 
        *   New row starts with a new line
        *   New record start with a pipe "|"

            [0] => #EventID
            [1] => Time
            [2] => Latitude
            [3] => Longitude
            [4] => Depth/Km
            [5] => Author
            [6] => Catalog
            [7] => Contributor
            [8] => ContributorID
            [9] => MagType
            [10] => Magnitude
            [11] => MagAuthor
            [12] => EventLocationName
        */

        // First: convert to array each line
        $hq_line_break = preg_split("/\\r\\n|\\r|\\n/", $resp);

        // Second: 
        //  [a] split each string separated by pipe in a new array 
        //  [b] and insert into an array with some property

        foreach ($hq_line_break as $key => $value) {

            // First array shows only the titles of the datas, so we don't need it
            if ($key > 0) {

                $hq_divider = explode("|", $value); // [a]
                // Last row is empty, we don't want to incur in error, if $hq_divider[0] is just an empty string, ignore it
                if ($hq_divider[0]) {
                    array_push($HQ, [ // [b]
                        "event_id" => $hq_divider[0],
                        "date_time" => $hq_divider[1],
                        "latitude" => floatval($hq_divider[2]),
                        "longitude" => floatval($hq_divider[3]),
                        "depth" => floatval($hq_divider[4]),
                        "author" => $hq_divider[5],
                        "catalog" => $hq_divider[6],
                        "contributor" => $hq_divider[7],
                        "contributor_id" => $hq_divider[8],
                        "mag_type" => $hq_divider[9],
                        "magnitude" => floatval($hq_divider[10]),
                        "mag_author" => $hq_divider[11],
                        "event_location" => $hq_divider[12]
                    ]);
                }
            }
        }

        // Thats our final filtered product. I Added params to be much clear as possible
        $HQ_final = [
            "last_update" => date('Y-m-d H:i:s'),
            "params" => array_keys($params),
            "list" => $HQ
        ];

        return $HQ_final;
    }

    public function getJSON()
    {
        header('Content-Type: application/json');
        echo json_encode($this::getINGVArray(), JSON_PRETTY_PRINT);
    }

    public function getXML()
    {
        header("Content-type: text/xml");
        echo xmlrpc_encode($this::getINGVArray());
    }

    public function getCSV()
    {
        echo arrayToCsv($this::getINGVArray()['list'], (string)date('Y-m-d__H_i_s'), ";");
    }
}