<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait DateListable
 *
 * @property array $searchable
 * @property string $table
 * @property string $primaryKey
 * @method   string getTable()
 */

trait DateListable
{
    /**
     * Build an array with the months as the frontend requires
     *
     * @return void
     */
    public function buildYears(int $minYear, int $maxYear)
    {
        $years = [];
        $index = 1;
        for ($i = $minYear; $i <= $maxYear; $i++) {
            $year = [
                "id"   => strval($i),
                "name" => strval($i),
            ];

            $years[] = $year;
            $index++;
        }

        return $years;
    }
    /**
     * Build an array with the months as the frontend requires
     *
     * @return void
     */
    public function buildMonths()
    {
        $months = [
            [
                "id"   => "1",
                "name" => "Enero",
            ],
            [
                "id"   => '2',
                "name" => 'Febrero',
            ],
            [
                "id"   => '3',
                "name" => 'Marzo',
            ],
            [
                "id"   => '4',
                "name" => 'Abril',
            ],
            [
                "id"   => '5',
                "name" => 'Mayo',
            ],
            [
                "id"   => '6',
                "name" => 'Junio',
            ],
            [
                "id"   => '7',
                "name" => 'Julio',
            ],
            [
                "id"   => '8',
                "name" => 'Agosto',
            ],
            [
                "id"   => '9',
                "name" => 'Septiembre',
            ],
            [
                "id"   => '10',
                "name" => 'Octubre',
            ],
            [
                "id"   => '11',
                "name" => 'Noviembre',
            ],
            [
                "id"   => '12',
                "name" => 'Diciembre',
            ],
        ];

        return $months;
    }
}
