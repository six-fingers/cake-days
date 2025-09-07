<?php

use PHPUnit\Framework\TestCase;
use UtilityClass\CakeDays;
use UtilityClass\Employee;
use UtilityClass\OffDaysChecker;

class ProvidedExamplesTest extends TestCase
{
    public function testDaveGetSmallCakeOnThe16th()
    {
        $employees = [new Employee('Dave', '1986-06-13')];

        $result = (new CakeDays($employees, new OffDaysChecker()))->getCakeDays();

        // var_dump($result);

        $this->assertTrue(isset($result['2025-06-16']));
        $this->assertSame(['Dave'], $result['2025-06-16']);
    }

    public function testRobGetSmallCakeOnThe8th()
    {
        $employees = [new Employee('Rob', '1950-07-06')];

        $result = (new CakeDays($employees, new OffDaysChecker()))->getCakeDays();

        $this->assertTrue(isset($result['2025-07-08']));
        $this->assertSame(['Rob'], $result['2025-07-08']);
    }

    public function testSamAndKateGetLargeCakeOnThe16th()
    {
        $employees = [
            new Employee('Sam', '1950-07-14'),
            new Employee('Kate', '1950-07-15')
        ];

        $result = (new CakeDays($employees, new OffDaysChecker()))->getCakeDays();

        $this->assertTrue(isset($result['2025-07-16']));
        $this->assertSame(['Kate', 'Sam'], $result['2025-07-16']);
    }

    public function testAlexJenGetLargeCakeOnThe23rdAndPeteGetSmallOneOnThe25th()
    {
        $employees = [
            new Employee('Alex', '1950-07-21'),
            new Employee('Jen', '1950-07-22'),
            new Employee('Pete', '1950-07-23')
        ];

        $result = (new CakeDays($employees, new OffDaysChecker()))->getCakeDays();

        $this->assertTrue(isset($result['2025-07-23']));
        $this->assertSame(['Alex', 'Jen'], $result['2025-07-23']);

        $this->assertTrue(isset($result['2025-07-25']));
        $this->assertSame(['Pete'], $result['2025-07-25']);
    }
}
