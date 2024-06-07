<?php
namespace App\Helpers;

class SingleOccurrence
{
    /**
     * @param array $numbers
     * @return array
     */
    public static function findSingle(array $numbers): array
    {
        if (!count($numbers)) {
            return [];
        }

        $counts = [];
        foreach ($numbers as $number) {
            if (is_numeric($number)) {
                $number = strval($number);
                if (!isset($counts[$number])) {
                    $counts[$number] = 0;
                }
                $counts[$number]++;
            }
        }

        $result = [];
        foreach ($counts as $number => $count) {
            if ($count == 1) {
                $result[] = floatval($number);
            }
        }

        return $result;
    }
}
