<?php

namespace UtilityClass;

use DateTime;

class OffDaysChecker
{
    private $holidays;

    public function __construct()
    {
        $this->holidays = [
            '2025-12-25', // Christmas Day
            '2025-12-26', // Boxing Day
            '2025-01-01', // New Year's Day
        ];
    }

    public function getFirstWorkingDay(DateTime $working_day): DateTime
    {
        // RULE: If the office is closed on an employee’s birthday, they get the next working day off.
        if ($this->isWeekendOrHoliday($working_day)) {
            $working_day->modify('+1 day');
        }

        // RULE: All employees get their birthday off.
        $working_day->modify('+1 day');


        // Skip all the remaining weekends or holidays
        while ($this->isWeekendOrHoliday($working_day)) {
            $working_day->modify('+1 day');
        }

        return $working_day;
    }

    private function isWeekendOrHoliday(DateTime $working_day): bool
    {
        // RULE: The office is closed on weekends, Christmas Day, Boxing Day and New Year’s Day.
        return $this->isWeekend($working_day) || $this->isHoliday($working_day);
    }

    private function isWeekend(DateTime $working_day): bool
    {
        $dayOfWeek = $working_day->format('N'); // 1 (Monday) to 7 (Sunday)
        return $dayOfWeek > 5;
    }

    private function isHoliday(DateTime $working_day): bool
    {
        return in_array($working_day->format('Y-m-d'), $this->holidays);
    }
}
