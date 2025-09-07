<?php

use PHPUnit\Framework\TestCase;
use UtilityClass\CakeDays;
use UtilityClass\Employee;
use UtilityClass\OffDaysChecker;

class ExtraScenariosTest extends TestCase
{
    // Example 3 Order Inversion
    public function testSamAndKateGetLargeCakeOnThe16thInvertedOrder()
    {
        $employees = [
            new Employee('Kate', '1950-07-15'),
            new Employee('Sam', '1950-07-14'),
        ];

        $result = (new CakeDays($employees, new OffDaysChecker()))->getCakeDays();

        $this->assertTrue(isset($result['2025-07-16']));
        $this->assertSame(['Kate', 'Sam'], $result['2025-07-16']);
    }

    // Example 4 Order Inversion
    public function testAlexJenGetLargeCakeOnThe23rdAndPeteGetSmallOneOnThe25thInvertedOrder()
    {
        $employees = [
            new Employee('Pete', '1950-07-23'),
            new Employee('Jen', '1950-07-22'),
            new Employee('Alex', '1950-07-21')
        ];

        $result = (new CakeDays($employees, new OffDaysChecker()))->getCakeDays();

        $this->assertTrue(isset($result['2025-07-23']));
        $this->assertSame(['Alex', 'Jen'], $result['2025-07-23']);

        $this->assertTrue(isset($result['2025-07-25']));
        $this->assertSame(['Pete'], $result['2025-07-25']);
    }
}
