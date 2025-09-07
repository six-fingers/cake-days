<?php

namespace UtilityClass;

class CSVManager
{
    /**
     * @return string[][]
     */
    public static function read(string $filename): array
    {
        $rows = [];

        $csv_file = fopen($filename, 'r');
        if ($csv_file !== false) {

            while (($row = fgetcsv($csv_file)) !== false) {
                $rows[] = $row;
            }

            fclose($csv_file);
        }

        return $rows;
    }

    /**
     * Undocumented function
     *
     * @param string $filename
     * @param string[][] $rows
     * @param string[] $header
     */
    public static function write(string $filename, array $rows, array $header = []): void
    {
        $handle = fopen($filename, 'w');

        if (!empty($header)) {
            fputcsv($handle, $header);
        }

        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }

        fclose($handle);
    }
}
