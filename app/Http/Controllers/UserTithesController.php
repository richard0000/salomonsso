<?php
namespace App\Http\Controllers;

use App\Tithe;
use Illuminate\Http\Request;

class UserTithesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request, int $user_id)
    {
        $this->validateIndex($request);

        $tithes = Tithe::search($request->only('filter'))
            ->where('user_id', $user_id)
            ->whereYear('date', $request->input('year'))
            ->orderBy('date')
            ->get();

        return $this->success($tithes, 200);
    }
    /**
     * Retrieves a tithe and its related data
     *
     * @return void
     */
    public function show($user_id, $tithe_id)
    {
        $tithe = Tithe::find($tithe_id);

        if (!$tithe) {
            return $this->error("The tithe with {$tithe_id} doesn't exist", 404);
        }

        return $this->success($tithe, 200);
    }
    /**
     * Validate fields in request for store user operation
     *
     * @return void
     */
    public function validateIndex(Request $request)
    {
        $rules = [
            'year' => 'required',
        ];

        $this->validate($request, $rules);
    }
}
