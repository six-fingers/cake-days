<?php
require_once 'vendor/autoload.php';

use UtilityClass\CSVManager;

// CLI Usage Hint
if ($argc != 2) {
    echo "Usage: php cake-days.php <input_file.csv>\n";
    exit(1);
}

// Get the input file and output file from command-line arguments
$input_file = $argv[1];

echo $argv[1];
echo "\n";

$csv_data = CSVManager::read($input_file);

var_dump($csv_data);
echo "\n";

$current_year = date('Y');
$output_filename = "cake-days-{$current_year}.csv";

echo $output_filename;