<!DOCTYPE html>
<html>
    <head>
        <title>Acceso restringido.</title>

        <style>
            html, body {
                height: 100%;
            }

            body {
                font-family: sans-serif;
                margin: 0;
                width: 100%;
            }

            h1 {
                background-color: #24485d;
                color: #fff;
                font-size: 20px;
                font-weight: 300;
                line-height: 1.2;
                margin: 0 0 1.5em;
                padding: 30px;
            }

            p {
                color: #333;
                font-size: 16px;
                font-weight: 300;
                line-height: 1.5;
                margin: 1em 30px;
            }

            .error {
                background-color: #eee;
                border-radius: 3px;
                color: #666;
                display: inline-block;
                font-size: 12px;
                line-height: 1;
                padding: 0.5em 0.6em;
            }
        </style>
    </head>
    <body>
        <h1>
            Acceso restringido
        </h1>

        <p>
            No tienes permiso para acceder a la página solicitada.
        </p>

        <p class="error">
            403
        </p>
    </body>
</html>
