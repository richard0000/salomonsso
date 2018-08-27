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
        $tithes = Tithe::search($request->only('filter'))
            ->where('user_id', $user_id)
            ->paginate();

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
}
