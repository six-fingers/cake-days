<?php
require_once 'vendor/autoload.php';

use CakeDays\classes\CSVManager;


// Command-line interface
if ($argc != 2) {
    echo "Usage: php cake-days.php <input_file.csv>\n";
    exit(1);
}

// Get the input file and output file from command-line arguments
$input_file = $argv[1];

echo $argv[1];
echo "\n";


