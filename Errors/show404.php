<html>
    <head>
        <title>Error 404: Page not found</title>
        <style>
            .error-div{
                margin: auto;
                margin-top: 10vh;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="error-div">
            <h1>Oops! :(</h1>
            <p><b>404</b>, Error Occurred</p>
            <span>
                The URL you requested <b><?php echo $_SERVER['REQUEST_URI'] ?></b>, <br> was not found on this server.
            </span>
        </div>
    </body>
</html>

<?php
header("HTTP/1.1 404 Not Found", true, 404);