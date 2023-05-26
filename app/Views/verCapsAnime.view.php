
        <section class="p-2 container">

          <div class="row row-cols-2 d-flex">

            <!--Div de la descripción-->
            <div class="col-12 col-lg-8 rounded overflow-hidden p-2 order-lg-1 order-2">
              <div class="rounded descripcionVerAnime p-2">
                <p class="fs-2 text-center"><?php echo isset($animesMostrar[0]['nombre']) ? ucwords($animesMostrar[0]['nombre']) : 'Nombre no encontrada' ?></p>
                <p class="txtImprenta"><?php echo isset($animesMostrar[0]['descripcion']) ? $animesMostrar[0]['descripcion'] : 'Descripción no encontrada' ?></p>  
              </div>
            </div>

            <!--Div de la imagen-->
            <div class="col-12 col-lg-4 p-2 order-lg-2 order-1">
                <img src="<?php echo isset($animesMostrar[0]['rutaPortada']) ? $animesMostrar[0]['rutaPortada'] : '' ?>" class="imgVerAnime card-img-top rounded mx-auto d-block" alt="Imagen de portada de la serie GGGGGGGGG">
            </div>

          </div>

          <!--Div con los capítulos de un anime ACORDEON-->
          <div class="accordion accordion-flush border border-1 mt-5" id="acorrdeonCapitulosAnime">
              
              <?php
              $numAcordeon = 0;
              for($i = 0; $i < count($animesMostrar) ; $i += 10) {
              ?>
              
                <div class="accordion-item">
                    <h2 class="accordion-header" id="capitulosCabecera<?php echo $numAcordeon ?>">
                      <button class="accordion-button collapsed fs-4" type="button" data-bs-toggle="collapse" data-bs-target="#capitulos<?php echo $numAcordeon ?>" aria-expanded="false" aria-controls="capitulos<?php echo $numAcordeon ?>">
                        Capítulos del <?php echo $i + 1 ?> al <?php echo $i + 10 ?>
                      </button>
                    </h2>
                    <div id="capitulos<?php echo $numAcordeon ?>" class="accordion-collapse collapse" aria-labelledby="capitulosCabecera<?php echo $numAcordeon ?>" data-bs-parent="#acorrdeonCapitulosAnime">

                      <!--Contenido del acordeon-->
                      <div class="accordion-body container">
                        <?php if(isset($animesMostrar[$i])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 1])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 1]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 1]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 1]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 2])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 2]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 2]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 2]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 3])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 3]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 3]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 3]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 4])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 4]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 4]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 4]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 5])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 5]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 5]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 5]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 6])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 6]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 6]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 6]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 7])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 7]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 7]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 7]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 8])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 8]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 8]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 8]['capitulo'] ?></p></a><?php } ?>
                        <?php if(isset($animesMostrar[$i + 9])){ ?><a href="/shironime/verCap?idSerie=<?php echo $animesMostrar[$i + 9]['id_serie'] ?>&capitulo=<?php echo $animesMostrar[$i + 9]['capitulo'] ?>" class="row capLink"><p>Capítulo <?php echo $animesMostrar[$i + 9]['capitulo'] ?></p></a><?php } ?>
                      </div>
                    </div>
                </div>
                
              <?php 
              $numAcordeon++;
              } ?>

          </div>
          
        </section>