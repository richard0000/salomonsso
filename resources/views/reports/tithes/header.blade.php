<table cellpadding="0" cellspacing="0">
    <!-- (1) Designación del Municipio emisor -->
    <tr class="top">
        <td class="municipio line-bottom" style="width: 10%">
            <img src="{{ url(env('APP_LOGO')) }}" style="width:50px"></img>
        </td>
        <td class="municipio line-bottom align-right">
            {{ trans('reports.tithes.title') . ' - ' . $month . '-' . $year }}
            <div>
	            <span class="titulo uppercase">
	                {{ trans('reports.tithes.createdAt') . ' ' . $today }}
	            </span>
            </div>
        </td>
    </tr>
</table>