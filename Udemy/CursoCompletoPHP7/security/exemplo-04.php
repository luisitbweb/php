<html>
    <head>
        <title>reCAPTCHA demo: Simple page</title>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://www.google.com/recaptcha/api.js?render=6LcnDcQUAAAAAEDFdJ3cXy_eV6NoZZme-GGEWCST"></script>
    </head>
    <body>
        <form action="cadastrar.php" method="POST">
            <div class="g-recaptcha" data-sitekey="6LcnDcQUAAAAAEDFdJ3cXy_eV6NoZZme-GGEWCST"></div>

            <script>
                grecaptcha.ready(function () {
                    grecaptcha.execute('6LcnDcQUAAAAAEDFdJ3cXy_eV6NoZZme-GGEWCST', {action: 'homepage'}).then(function (token) {
                        ...
                    });
                });
            </script>

            <br/>
            <input type="email" name="inputEmail"/>
            <button type="submit">Enviar</button>
        </form>

        <script type="text/javascript">
            var onloadCallback = function () {
                alert("grecaptcha is ready!");
            };
        </script>
    </body>
</html>