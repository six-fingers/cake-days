<?php

use PHPUnit\Framework\TestCase;

class CakeDaysScriptTest extends TestCase
{
    public function testSuccessIfValidCsv()
    {
        $command = 'php cake-days.php employees_dob.csv';
        exec($command, $output, $returnVar);

        $this->assertEquals(0, $returnVar);

        $output_filename = 'cake-days-' . date('Y') . '.csv';
        $success_string = "Cake schedule has been generated in $output_filename";
        $this->assertStringContainsString($success_string, implode("\n", $output));

        $rows = [];
        if (($handle = fopen($output_filename, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $rows[] = $data;
            }
            fclose($handle);
        }

        $this->assertNotEmpty($rows, 'CSV file is empty');

        $this->assertSame(['Date', 'Number of Small Cakes', 'Number of Large Cakes', 'Names of people getting cake'], $rows[0]);
        $this->assertSame(['2025-06-23', '1', '0', 'Mary'], $rows[1]);
        $this->assertSame(['2025-10-15', '1', '0', 'Steve'], $rows[2]);
    }

    public function testUsageHint()
    {
        $command = 'php cake-days.php';
        exec($command, $output, $returnVar);

        $this->assertEquals(1, $returnVar);

        $this->assertStringContainsString('Usage: php cake-days.php <input_file.csv>', implode("\n", $output));
    }

    public function testFileNotFound()
    {
        $command = 'php cake-days.php non_existing_file.csv';
        exec($command, $output, $returnVar);

        $this->assertEquals(0, $returnVar);

        $this->assertStringContainsString('Failed to open stream: No such file or directory', implode("\n", $output));
    }
}
