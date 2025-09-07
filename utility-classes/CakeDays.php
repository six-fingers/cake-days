<?php

namespace UtilityClass;

use DateTime;

class CakeDays
{
    private $employees;
    private $off_days_checker;

    /**
     * @param Employee[] $employees
     * @param OffDaysChecker $off_days_checker
     */
    public function __construct(array $employees, OffDaysChecker $off_days_checker)
    {
        $this->employees = $employees;
        $this->off_days_checker = $off_days_checker;

        usort($this->employees, function (Employee $a, Employee $b) {
            return strcmp($a->getName(), $b->getName());
        });
    }

    /**
     * @return array<string, string[]>
     */
    public function getCakeDays(): array
    {
        $cake_days = [];

        foreach ($this->employees as $employee) {
            $dob = $employee->getDob();

            $birthday = clone $dob;
            $birthday->setDate(
                date('Y'),
                (int)$birthday->format('m'),
                (int)$birthday->format('d')
            );

            $firstWorkingDay = $this->off_days_checker->getFirstWorkingDay($birthday);

            if (!isset($cake_days[$firstWorkingDay->format('Y-m-d')])) {
                $cake_days[$firstWorkingDay->format('Y-m-d')] = [];
            }

            // RULE: A small cake is provided on the employee’s first working day after their birthday.
            $cake_days[$firstWorkingDay->format('Y-m-d')][] = $employee->getName();

            ksort($cake_days);

            // RULE: For health reasons, the day after each cake must be cake-free. Any cakes due on a cake-free day are postponed to the next working day.
            $cake_days = $this->applyConsecutiveCakeDaysRule($cake_days);
        }

        return $cake_days;
    }

    /**
     * @param array<string, string[]> $cake_days
     * @return array<string, string[]>
     */
    private function applyConsecutiveCakeDaysRule(array $cake_days): array
    {
        foreach ($cake_days as $date => $names) {
            $nextDay = new DateTime($date);
            $nextDay->modify('+1 day');

            if (isset($cake_days[$nextDay->format('Y-m-d')])) {
                if (count($names) < 2) {
                    $cake_days[$nextDay->format('Y-m-d')] = array_merge($cake_days[$nextDay->format('Y-m-d')], $names);
                    sort($cake_days[$nextDay->format('Y-m-d')]);
                    unset($cake_days[$date]);
                }
            }

            $previousDay = new DateTime($date);
            $previousDay->modify('-1 day');

            if (isset($cake_days[$previousDay->format('Y-m-d')])) {
                $cake_days[$nextDay->format('Y-m-d')] = isset($cake_days[$nextDay->format('Y-m-d')])
                    ? array_merge($cake_days[$nextDay->format('Y-m-d')], $names)
                    : $names;
                unset($cake_days[$date]);
            }
        }
        return $cake_days;
    }
}
