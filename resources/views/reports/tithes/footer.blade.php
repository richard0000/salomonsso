<table cellpadding="0" cellspacing="0">
    <!-- (1) Designación del Municipio emisor -->
    <tr class="top">
        <td class="municipio line-bottom align-right">
            {{ trans('reports.tithes.total') }}
            <div>
	            <span class="titulo uppercase">
	                {{ number_format($tithes->sum('amount'), 0,',','.') }}
	            </span>
            </div>
        </td>
    </tr>
</table>