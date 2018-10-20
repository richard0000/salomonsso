<?php
namespace App\Http\Controllers;

use App\Tithe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use StdClass;

class TitheDatesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $this->validateIndex($request);

        $maxTithe = new Carbon(Tithe::max('date'));
        $minTithe = new Carbon(Tithe::min('date'));

        $dates          = new StdClass();
        $dates->years = $this->buildYears($minTithe->year, $maxTithe->year);
        $dates->months  = $this->buildMonths();

        return $this->success($dates, 200);
    }
    /**
     * Build an array with the months as the frontend requires
     *
     * @return void
     */
    public function buildYears(int $minYear, int $maxYear)
    {
        $years = [];
        $index = 1;
        for ($i=$minYear; $i <= $maxYear; $i++) {
            $year = [
                "id" => strval($i),
                "name" => strval($i)
            ];

            $years[]= $year;
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
    /**
     * Validate fields in request for store user operation
     *
     * @return void
     */
    public function validateIndex(Request $request)
    {
        $rules = [
            'filter.church_id_eq' => 'required',
        ];

        $this->validate($request, $rules);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function isAuthorized(Request $request)
    {
        $resource = "tithes";

        return $this->authorizetithe($request, $resource);
    }
}
