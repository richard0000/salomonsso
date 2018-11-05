<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportTitheController extends GeneralTithesController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $tithes = $this->getTithesByMonth($request);

        return $this->exportTithesPDF([
            'tithes' => $tithes,
            'year'   => $request->input('year'),
            'month'  => $request->input('month'),
        ]);
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
