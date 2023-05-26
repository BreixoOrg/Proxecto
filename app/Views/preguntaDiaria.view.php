

        <section class="p-2 d-flex align-items-center">
            
            <?php if(isset($error)){ ?>
                <div class="row col-12 mb-3 fs-3 descripcionVerAnime">
                    <p class="text-center m-auto"><?php echo $error ?></p>
                </div>
            <?php 
                }
                else{
            ?>

          <form action="/shironime/preguntaDiaria" method="post" class="container-fluid rounded descripcionVerAnime">

            <div class="col-12 container">
                
                

              <!--CONTENEDOR PREGUNTA-->
              <div class="row col-12 mb-3 fs-3">
                <p class="text-center"><?php echo isset($pregunta) ? $pregunta : 'Error: no se pudo cargar la pregunta' ?></p>
              </div>
  
              <!--CONTENEDOR RESPUESTAS-->
              <div class="row col-12 mb-3">
                  
                  <?php for($i=0;$i < count($respuestasPosibles) ;$i++){ ?>
                  
                    <div class="col-12 col-md-6 mb-5">
                        <input type="radio" class="inputPerso" value="<?php echo isset($respuestasPosibles[$i]) ? $respuestasPosibles[$i] : '0' ?>" id="check<?php echo $i ?>" name="respuestaDiaria">
                        <label class="form-check-label" for="check<?php echo $i ?>"><?php echo isset($respuestasPosibles[$i]) ? $respuestasPosibles[$i] : 'Error al cargar la pregunta' ?></label>
                    </div>
                  
                  <?php } ?>
  
              </div>
              
              

            </div>

            <button type="submit" class="btn btn-primary col-12 mb-3">ENVIAR</button>

          </form>
            
          <?php } ?>
          
        </section>
