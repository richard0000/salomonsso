@include($namespace . '.leyend')

<table cellpadding="0" cellspacing="0">
    <tr class="information">
        <td colspan="2">
            <table>
                <tr>
                    <td>
                        <div class="size-1 bold">
                            {{ trans('reports.tithes.date') }}
                        </div>
                    </td>
                    <td>
                        <div class="size-1 bold">
                            {{ trans('reports.tithes.member') }}
                        </div>
                    </td>
                    <td>
                        <div class="size-1 bold">
                            {{ trans('reports.tithes.amount') }}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="min-width: 275px">
                        <table class="montos" cellspacing="0" cellpadding="0">
                    	@foreach($tithes as $tithe)
                            <tr>
                                <td class="size-3">{{ $tithe->date }}</td>
                                <td class="size-3">{{ $tithe->member->name }}</td>
                                <td class="size-3 align-right">{{ number_format($tithe->amount, 0,',','.') }}</td>
                            </tr>
                        @endforeach
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>