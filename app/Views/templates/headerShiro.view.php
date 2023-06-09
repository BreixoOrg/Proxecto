<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHIRONIME</title>

    <!--CSS-->

    <!-- Normalize -->
    <link rel="stylesheet" href="assets/css/normalize.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <?php for($y = 0; $y < count($styles); $y++) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $styles[$y] ?>">
    <?php } ?>
    
    

</head>

<body class="bgBody">
    <header class="col-12 sticky-top">

        <nav class="col-12 navbar navbar-expand-md navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand p-2 fs-1 rounded navRemark" href="/shirosime">SHIRONIME</a>
                <!--Botán de bootstrap para el menú-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item navRemark rounded">
                            <a class="nav-link active" aria-current="page" href="/shironime">ANIME</a>
                        </li>
                        <li class="nav-item navRemark rounded">
                            <a class="nav-link" href="/shironime/comprar">CANJEAR SHIROCOINS</a>
                        </li>
                        <li class="nav-item navRemark rounded">
                            <a class="nav-link" href="/shironime/preguntadiaria">PREGUNTA DIARIA</a>
                        </li>
                    </ul>
                    <form action="/shironime/search" method="post" class="d-flex mb-2">
                        <input class="form-control me-2" name="animeNameToSearch" type="search" value="<?php echo isset($stringBusqueda) ? $stringBusqueda : "" ?>" placeholder="Qué buscas..." aria-label="Search">
                        <button class="btn btSearch text-white input-type2" type="submit">Buscar</button>
                    </form>
                    <div class="dropdown dropdown-menu-right mb-2 ">
                        <button class="btn btPerfil text-white input-type3" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo isset($_SESSION['usuario']['username']) ? $_SESSION['usuario']['username'] : 'USER' ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-start dropdown-menu-md-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/shironime/perfil">Perfil</a></li>
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            <li class="dropdown-item">Shirocoins: <?php echo isset($_SESSION['usuario']['shirocoin']) ? $_SESSION['usuario']['shirocoin'] : 'NO-ENCONTRADO' ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

    </header>
    
<main class=" mt-2 mb-2 rounded container bg-white p-3">
    
    <?php if(isset($_SESSION['mostrarDialog'])) { ?>
    
    <dialog class="miModal alert container" id="dialogWindow" open>

        <div class="row d-flex justify-content-around">
          <span class="col-10 fs-5"><span class="text-<?php echo $_SESSION['mostrarDialog']['isExito'] === true  ? 'success' : 'danger' ?>"><?php echo $_SESSION['mostrarDialog']['txtColor'] ?></span><?php echo $_SESSION['mostrarDialog']['txtNormal'] ?></span>
          <button type="button" class="btn-close col-1" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
    </dialog>
    
    <?php
    unset($_SESSION['mostrarDialog']);    
    } ?>