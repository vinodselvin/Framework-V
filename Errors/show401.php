<html>
    <head>
        <title>Error 401: Un-Authorized Access</title>
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
            <p><b>401</b>, Error Occurred</p>
            <span>
                The URL you requested <b><?php echo $_SERVER['REQUEST_URI'] ?></b>, has disabled access to you.
            </span>
        </div>
    </body>
</html>