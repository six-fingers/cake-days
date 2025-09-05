<?php

namespace UtilityClass;

class CSVManager
{
    public static function read($filename): array
    {
        $rows = [];

        $csv_file = fopen($filename, 'r');
        if($csv_file !== false) {

            while(($row = fgetcsv($csv_file)) !== false) {
                $rows[] = $row;
            }

            fclose($csv_file);
        }

        return $rows;
    }
}
