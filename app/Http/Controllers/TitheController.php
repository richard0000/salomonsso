<?php
namespace App\Http\Controllers;

use App\Tithe;
use Illuminate\Http\Request;
use Log;

class TitheController extends GeneralTithesController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $tithes = $this->getTithesByMonth($request);

        return $this->success($tithes, 200);
    }

    /**
     * Retrieve only one tithe from the database
     *
     * @return void
     */
    public function show(int $titheId)
    {
        $tithe = Tithe::with(['member'])
            ->findOrFail($titheId);

        return $this->success($tithe, 200);
    }

    /**
     * Create a new tithe in the database
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validateStore($request);

        $tithe = Tithe::create($request->all());

        return $this->success("The tithe with with id {$tithe->id} has been created", 201);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $tithe = Tithe::findOrFail($id);

        if (!$tithe) {
            return $this->error("The tithe with {$id} doesn't exist", 404);
        }

        $this->validateUpdate($request, $tithe);

        $tithe->update($request->all());

        return $this->success("The tithe with with id {$tithe->id} has been updated", 200);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function destroy($id)
    {
        $tithe = Tithe::find($id);

        if (!$tithe) {
            return $this->error("The tithe with {$id} doesn't exist", 404);
        }

        $tithe->delete();

        return $this->success("The tithe with with id {$id} has been deleted", 200);
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
            'year'                => 'required',
            'month'               => 'required',
        ];

        $this->validate($request, $rules);
    }
    /**
     * Validate fields in request for store tithe operation
     *
     * @return void
     */
    public function validateStore(Request $request)
    {
        $rules = [
            'amount'  => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'date'    => 'required|date_format:Y-m-d|before:' . date('Y-m-d'),
        ];

        Log::info('New tithe being submitted: ' . PHP_EOL . response()->json($request->all()));

        $this->validate($request, $rules);
    }
    /**
     * Validate fileds in request for update tithe operation
     *
     * @return void
     */
    public function validateUpdate(Request $request, tithe $tithe)
    {
        $rules = [
            'amount'  => 'numeric',
            'user_id' => 'exists:users,id',
            'date'    => 'date_format:d-m-Y',
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
