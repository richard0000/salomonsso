<?php
namespace App\Http\Controllers;

use App\Tithe;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GeneralTithesController extends Controller
{
    /**
     * Fetch tithes filtering by request year and month, ordering by date
     *
     * @return void
     */
    public function getTithesByMonth(Request $request)
    {
        $this->validateIndex($request);

        $tithes = Tithe::search($request->only('filter'))
            ->with(['member'])
            ->whereYear('date', $request->input('year'))
            ->whereMonth('date', $request->input('month'))
            ->orderBy('date', 'desc')
            ->get();

        return $tithes;
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
            'format'              => 'required',
        ];

        $this->validate($request, $rules);
    }
    /**
     * Export tithes of a given month as a PDF report
     *
     * @param  array $params
     * @return Response
     */
    public function exportTithesPDF(array $params): Response
    {
        $namespace = 'reports.tithes';
        $today     = Carbon::now();

        $pdf = SnappyPdf::loadView($namespace . '.layout', [
            'namespace' => $namespace,
            'today'     => $today,
            'tithes'    => $params['tithes'],
            'year'      => $params['year'],
            'month'     => $params['month'],
        ]);

        return $pdf->setOptions([
            'disable-smart-shrinking' => true,
        ])->download('report.pdf');

    }
}
