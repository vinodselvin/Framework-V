<html>
    <head>
        <title>Error 405: Method Not Allowed</title>
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
            <p><b>405</b>, Error Occurred</p>
            <span>
                The URL <b><?php echo $_SERVER['REQUEST_URI'] ?></b>, cannot be accessed via <b><?php echo $_SERVER['REQUEST_METHOD']?></b> Method.
            </span>
        </div>
    </body>
</html>
<?php
header("HTTP/1.1 405 Method Not Allowd", true, 405);