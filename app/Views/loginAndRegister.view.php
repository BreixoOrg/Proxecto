<!DOCTYPE html>
<html lang="es">

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
                        <!-- CREAR CUENTA -->
                        <form action="/register" method="post">
                            <h1>Crear cuenta</h1>
                            <input type="text" name="username" value="<?php echo isset($inputR['username']) ? $inputR['username'] : '' ?>" placeholder="Nombre de usuario" />
                            <p class="text m-2 p-0 text-danger"><?php echo isset($errores['username']) ? $errores['username'] : '' ?><?php echo isset($errores['catch']) ? $errores['catch'] : '' ?></p>
                            
                            <input type="email" name="email" value="<?php echo isset($inputR['email']) ? $inputR['email'] : '' ?>" placeholder="Email" />
                            <p class="text m-2 p-0 text-danger"><?php echo isset($errores['email']) ? $errores['email'] : '' ?></p>

                            <input type="password" name="password" placeholder="Contraseña" />
                            <p class="text m-2 p-0 text-danger"><?php echo isset($errores['password']) ? $errores['password'] : '' ?></p>
                            <button type="submit" name="bt_register">Registrarse</button>
                        </form>
                    </div>
                    <div class="form-container sign-in-container">
                        <!-- LOGEARSE -->
                        <form action="/login" method="post">
                            <h1>Iniciar sesión</h1>
                            <input type="text" name="username" value="<?php echo isset($inputL['username']) ? $inputL['username'] : '' ?>" placeholder="Nombre de usuario" />
                            
                            <input type="password" name="password" placeholder="Contraseña" />
                            <p class="text m-2 p-0 text-danger"><?php echo isset($erroresL) ? $erroresL : '' ?></p>
                            <button type="submit" name="bt_login">Iniciar</button>
                        </form>
                    </div>
                    <!-- PORTADAS QUE TAPAN -->
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