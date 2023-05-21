<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shironime</title>

    <!--CSS-->

    <!-- Normalize -->
    <link rel="stylesheet" href="assets/css/normalize.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Login and Register -->
    <link rel="stylesheet" href="assets/css/loginRegister.css">

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
    
            <div class="d-flex formGlobalContainer">
                <div class="container" id="container">
                    <div class="form-container sign-up-container">
                        <form action="#">
                            <h1>Crear cuenta</h1>
                            <input type="text" placeholder="Nombre de usuario" />
                            <input type="email" placeholder="Email" />
                            <input type="password" placeholder="Contraseña" />
                            <button>Crear</button>
                        </form>
                    </div>
                    <div class="form-container sign-in-container">
                        <form action="#">
                            <h1>Iniciar sesión</h1>
                            <input type="text" placeholder="Nombre de usuario" />
                            <input type="password" placeholder="Contraseña" />
                            <button>Iniciar</button>
                        </form>
                    </div>
                    <div class="overlay-container">
                        <div class="overlay" id="overlay">
                            <div class="overlay-panel overlay-left">
                                <h1>Bienvenido de nuevo</h1>
                                <p>Inicia sesión para poder disfrutar de los mejores episodios de anime</p>
                                <button class="ghost" id="iniciarSesion">Iniciar sesión</button>
                            </div>
                            <div class="overlay-panel overlay-right">
                                <h1>Saludos desconocido</h1>
                                <p>Registrate ya para disfrutar de todo el contenido de anime que desees</p>
                                <button class="ghost" id="registrarse">Registrarse</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('registrarse');
        const signInButton = document.getElementById('iniciarSesion');
        const container = document.getElementById('container');
        const overlay = document.getElementById('overlay');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
            overlay.style.backgroundImage = 'url("../assets/img/chica-pelo-largo-negro-blusa-blanca-fondo-morado")';
            overlay.style.backgroundPosition = "-60px 0";
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
            overlay.style.backgroundImage = 'url("../assets/img/chica-pelo-rosa-guitarra-camiseta")';
            overlay.style.backgroundPosition = "100px 0";
        });
    </script>

</body>

</html>