<!DOCTYPE html>
<html>
    <head>
        <title>404 error</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }
            a{
                text-decoration:none;
                color: #B0BEC5;
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">404 NOT FOUND.</div>
                <div class="content"><a href="{{ asset('/') }}">--你進入了未知連結，點我回去吧--</a></div>
            </div>
        </div>
    </body>
</html>
