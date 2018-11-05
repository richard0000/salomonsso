<!DOCTYPE doctype html>
<html>
    <head>
        <meta charset="utf-8">
            <title>
                {{ trans('reports.tithes.title') }}
            </title>
            <link rel="stylesheet" type="text/css" href="{{ url('assets/css/reports.css') }}">
        </meta>
    </head>
    <body>
        <div class="invoice-box">
            @include($namespace . '.header')

            @include($namespace . '.body')

            @include($namespace . '.footer')
        </div>
    </body>
</html>