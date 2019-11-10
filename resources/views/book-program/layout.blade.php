<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>

        @page  {
            margin: 1cm;
        }

        *{
            font-family: "DejaVu sans";
            line-height: normal;
        }
        .internaltable td {
            border: 1px solid black;
            padding: 2px 8px;
            font-size: 13px;
        }
        .row{
            border: none;
        }

        .page_break { page-break-before: always; }

        #tourists tbody td {
            padding: 0 4px;
        }
    </style>
</head>
    <body style="padding: 0px 10px">
        @yield("content")
    </body>
</html>