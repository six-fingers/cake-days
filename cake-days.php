<?php
require_once 'vendor/autoload.php';

use UtilityClass\CakeDays;
use UtilityClass\CSVManager;
use UtilityClass\Employee;
use UtilityClass\OffDaysChecker;

// CLI Usage Hint
if ($argc != 2) {
    echo "Usage: php cake-days.php <input_file.csv>\n";
    exit(1);
}

// Get the input file path from command-line arguments
// This line is not really necessary but it was added for readability
$input_file_path = $argv[1];
$employees = getEmployeesFromFile($input_file_path);

$cake_days_class = new CakeDays(
    $employees,
    new OffDaysChecker()
);

$cake_days = $cake_days_class->getCakeDays();

$rows = getRowsForCsv($cake_days);

$output_filename = 'cake-days-' . date('Y') . '.csv';

CSVManager::write(
    'cake-days-' . date('Y') . '.csv',
    $rows,
    ['Date', 'Number of Small Cakes', 'Number of Large Cakes', 'Names of people getting cake']
);

echo "Cake schedule has been generated in $output_filename\n";

/**
 * @return Employee[]
 */
function getEmployeesFromFile(string $path): array
{
    $csv_data = CSVManager::read($path);

    $employees = [];
    foreach ($csv_data as $row) {
        $employees[] = new Employee($row[0], $row[1]);
    }

    return $employees;
}

/**
 * @param array<string, string[]> $cake_days
 * @return string[][]
 */
function getRowsForCsv(array $cake_days): array
{
    $rows = [];

    foreach ($cake_days as $date => $names) {
        // RULE: There is never more than one cake a day.
        if (count($names) > 1) {
            // RULE: If two or more cakes days coincide, we instead provide one large cake to share.
            // RULE: If there is to be cake two days in a row, we instead provide one large cake on the second day.
            $rows[] = [$date, '0', '1', implode(',', $names)];
        } else {
            $rows[] = [$date, '1', '0', implode(',', $names)];
        }
    }

    return $rows;
}