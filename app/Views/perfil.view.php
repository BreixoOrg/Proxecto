<section class="container">

      <div class="row mt-2 mb-5">
        <span class="fs-1 col-12 text-center">PERFIL</span>
      </div>


      <div class="row justify-content-center border rounded p-2 descripcionVerAnime">
        <!--USERNAME-->
        <div class="row col-10 mb-3">
          <label for="username" class="col-sm-2 col-form-label fw-bold">Username</label>
          <div class="col-sm-10">
              <input value="<?php echo $_SESSION['usuario']['username'] ?>" type="text" class="form-control" id="username" disabled>
          </div>
        </div>

        <!--EMAIL-->
        <div class="row col-10 mb-3">
          <label for="email" class="col-sm-2 col-form-label fw-bold">Email</label>
          <div class="col-sm-10">
            <input value="<?php echo $_SESSION['usuario']['email'] ?>" type="text" class="form-control" id="email" disabled>
          </div>
        </div>

        <!--Final de Subs y Pregunta Diaria-->
        <div class="row col-10 mb-3">
          <div class="col-12 col-sm-6">
            <label for="finalSubs" class="col-form-label fw-bold">Final de subscripción</label>
            <div class="col-sm-10">
              <input value="<?php echo $_SESSION['usuario']['finalSubs'] ?>" type="text" class="form-control" id="finalSubs" disabled>
            </div>
          </div>

          <div class="col-12 col-sm-6">
            <label for="pregDiaria" class="col-form-label fw-bold">Pregunta diaria</label>
            <div class="col-sm-10">
              <input value="<?php echo $_SESSION['usuario']['ultimaPregRespond'] ?>" type="text" class="form-control" id="pregDiaria" disabled>
            </div>
          </div>
          
        </div>

        <div class="row col-10 mb-3 d-flex justify-content-center justify-content-md-between">
            <form action='/renovarSub' class="row col-12 col-md-6 mb-3">
                <button type="submit" class="btn btn-primary input-type1 col-12">Ampliar subscripción</button>
            </form>

            <form action='/darseBaja' class="row col-12 col-md-6 mb-3">
                <button type="button" class="btn btn-danger col-12" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Darse de baja</button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog bg-oscuro2">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Está seguro que quiere darse de baja?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="col-12 col-md-5 btn btn-secondary input-type1" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="col-12 col-md-5 btn btn-danger">Si, quiero darme de baja</button>
                      </div>
                    </div>
                  </div>
                </div>

            </form>
        </div>
        
        
        
        
      </div>
      
    </section>
