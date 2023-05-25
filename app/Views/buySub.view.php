<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>

  <!--CSS-->

    <!-- Normalize -->
    <link rel="stylesheet" href="assets/css/normalize.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- Login and Register -->
    <link rel="stylesheet" href="assets/css/buySub.css">


</head>
<body class="d-flex align-items-center">

  <div class="container">
    <div class="row justify-content-center align-middle">
      <div class="col-sm-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Elige tu plan de pago</h5>
          </div>
          <div class="card-body" id="card-body">
            <form action="/buySub" method="post">
  
              <!-- Titulo -->
              <h5 class="mb-4">Subscripciones disponibles </h5>

              <!--Plan de pago 1-->
              <div class="form-check">
                <input class="form-check-input" value="3" type="radio" name="radioPlanPago" id="checkoutForm1"/>
                <label class="form-check-label" for="checkoutForm1">
                  12 meses - 49,99 &euro;
                </label>
              </div>
  
              <!--Plan de pago 2-->
              <div class="form-check">
                <input class="form-check-input" value="2" type="radio" name="radioPlanPago" id="checkoutForm2" />
                <label class="form-check-label" for="checkoutForm2">
                  6 meses - 29,99 &euro;
                </label>
              </div>
  
              <!--Plan de pago 3-->
              <div class="form-check mb-4">
                <input class="form-check-input" value="1" type="radio" name="radioPlanPago" id="checkoutForm3" checked/>
                <label class="form-check-label" for="checkoutForm3">
                  3 meses - 15,99 &euro;
                </label>
              </div>
  
              <!--Parte introducir datos-->
              <div class="row mb-4"><!--Titular y Numero de targeta-->

                <!--Parte INPUT nombre titular-->
                <div class="col-sm-6">
                  <div class="form-outline">
                    <input type="text" value="<?php echo isset($input['nombreTitular']) ? $input['nombreTitular'] : '' ?>" id="formNameOnCard" name="nombreTitular" class="form-control <?php echo isset($errores['nombreTitular']) ? 'is-invalid' : '' ?>" />
                    <label class="form-label" for="formNameOnCard">Nombre del titular</label>
                  </div>
                </div>

                <!--Parte INPUT nº targeta credito-->
                <div class="col-sm-6">
                  <div class="form-outline">
                      <input type="text"  minlength="13" maxlength="18" value="<?php echo isset($input['numeroTargeta']) ? $input['numeroTargeta'] : '' ?>" id="formCardNumber" name="numeroTargeta" class="form-control <?php echo isset($errores['numeroTargeta']) ? 'is-invalid' : '' ?>" />
                    <label class="form-label" for="formCardNumber">Número de la targeta de crédito</label>
                  </div>
                </div>
              </div>
  
              <div class="row mb-4"><!--Fecha exp. y CVV-->

                <!--Parte INPUT fecha expiración-->
                <div class="col-sm-3">
                  <div class="form-outline">
                    <input type="text" minlength="5" maxlength="5" value="<?php echo isset($input['fechaExp']) ? $input['fechaExp'] : '' ?>" placeholder="MM/YY" id="formExpiration" name="fechaExp" class="form-control <?php echo isset($errores['fechaExp']) ? 'is-invalid' : '' ?>" />
                    <label class="form-label" for="formExpiration">Fecha de expiración</label>
                  </div>
                </div>

                <!--Parte INPUT CVV-->
                <div class="col-sm-3">
                  <div class="form-outline">
                    <input type="number" minlength="3" maxlength="4" value="<?php echo isset($input['cvv']) ? $input['cvv'] : '' ?>"  placeholder="111" id="formCVV" name="cvv" class="form-control <?php echo isset($errores['cvv']) ? 'is-invalid' : '' ?>" />
                    <label class="form-label" for="formCVV">CVV</label>
                  </div>
                </div>
              </div>
  
              <button name="buySubmit" class="btn btn-primary btn-lg btn-block float-end" type="submit">
                Pagar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>

    const btCheck1 = document.getElementById("checkoutForm1");
    const btCheck2 = document.getElementById("checkoutForm2");
    const btCheck3 = document.getElementById("checkoutForm3");
    const cardBody = document.getElementById("card-body");
    const fechaInput = document.getElementById("formExpiration");

    btCheck1.addEventListener('click', () => {
      cardBody.style.backgroundImage = 'url("../assets/img/sub12Meses.jpg")' ;
    });

    btCheck2.addEventListener('click', () => {
      cardBody.style.backgroundImage = 'url("../assets/img/sub6Meses.jpg")' ;
    });

    btCheck3.addEventListener('click', () => {
      cardBody.style.backgroundImage = 'url("../assets/img/sub3Meses.jpg")' ;
    });

    fechaInput.addEventListener('keyup', () => {
      console.log(fechaInput.value.length);
      if(fechaInput.value.length == 2){
        fechaInput.value += "/";
      }
    });
    
  </script>

</body>
</html>