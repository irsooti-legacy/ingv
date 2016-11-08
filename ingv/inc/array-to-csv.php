<?php 

/**
  * Formats a line (passed as a fields  array) as CSV and returns the CSV as a string.
  */

function arrayToCsv($input_array, $output_file_name, $delimiter) {
$temp_memory = fopen('php://memory', 'w');

$titles = array_keys($input_array[0]);

fputcsv($temp_memory, $titles, $delimiter);

// loop through the array
foreach ($input_array as $line) {
    // use the default csv handler

    // Replace points with comma, for good view on Excel or similar
    $line['magnitude'] = str_replace('.', ',', (string)$line['magnitude']);
    $line['depth'] = str_replace('.', ',', (string)$line['depth']);

    fputcsv($temp_memory, $line, $delimiter);
}

fseek($temp_memory, 0);
// modify the header to be CSV format
header('Content-Type: application/csv');
header('Content-Disposition: attachement; filename="' . $output_file_name . '.csv";');
// output the file to be downloaded
fpassthru($temp_memory);
}