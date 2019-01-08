<?php
namespace App\Http\Controllers;

use App\Tithe;
use App\Traits\DateListable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use StdClass;

class UserTitheDatesController extends Controller
{
    use DateListable;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request, int $user_id)
    {
        $this->validateIndex($request);

        $maxTithe = new Carbon(Tithe::where('user_id', $user_id)->max('date'));
        $minTithe = new Carbon(Tithe::where('user_id', $user_id)->min('date'));

        $dates         = new StdClass();
        $dates->years  = $this->buildYears($minTithe->year, $maxTithe->year);
        $dates->months = $this->buildMonths();

        return $this->success($dates, 200);
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
}
