<!--VIDEO-->
<section class="container">

<div class="row">
    <p class="text-center fs-2"><?php echo isset($capMostrar['nombre']) && isset($capMostrar['capitulo']) ? ucwords($capMostrar['nombre']) . " Capítulo " . $capMostrar['capitulo'] : "Nombre no encontrado" ?></p>
</div>

<div class="row containerVideo">
  <video poster="<?php echo isset($capMostrar['rutaPortada']) ? $capMostrar['rutaPortada'] : "./nublado-cumulo-paisaje-neblina.jpg" ?>" controls preload="none">
    <source src="<?php echo isset($capMostrar['rutaAlmacenamiento']) ? $capMostrar['rutaAlmacenamiento'] : "error" ?><?php echo isset($capMostrar['nombreArch']) ? $capMostrar['nombreArch'] : "error" ?>.mp4" type="video/mp4">
    <source src="<?php echo isset($capMostrar['rutaAlmacenamiento']) ? $capMostrar['rutaAlmacenamiento'] : "error" ?><?php echo isset($capMostrar['nombreArch']) ? ucwords($capMostrar['nombreArch']) : "error" ?>.webm" type="video/webm">
    <source src="<?php echo isset($capMostrar['rutaAlmacenamiento']) ? $capMostrar['rutaAlmacenamiento'] : "error" ?><?php echo isset($capMostrar['nombreArch']) ? ucwords($capMostrar['nombreArch']) : "error" ?>.webm" type="video/webm">
  </video>
</div>
<!--<video src="./c1.mp4" controls autoplay width="640" height="480"></video>-->

<div class="row">
  <div class="col-12">
      
      <?php if(isset($capMostrar['capitulo']) && $capMostrar['capitulo'] > 1){ ?>
      <span class="badge rounded-pill btCaps"><a href="/shironime/verCap?idSerie=<?php echo $capMostrar['id_serie']?>&capitulo=<?php echo $capMostrar['capitulo'] - 1 ?>">Capítulo Anterior</a></span>
      <?php } ?>
      
      <span class="badge rounded-pill btCaps"><a href="/shironime/animecompleto?idAnime=<?php echo $capMostrar['id_serie']?>">Lista de capítulos</a></span>
            
      <?php if(isset($capsTotales) && isset($capMostrar['capitulo']) && $capsTotales > $capMostrar['capitulo'] ){ ?>
      <span class="badge rounded-pill btCaps"><a href="/shironime/verCap?idSerie=<?php echo $capMostrar['id_serie']?>&capitulo=<?php echo $capMostrar['capitulo'] + 1 ?>">Sigueinte Capítulo</a></span>
      <?php } ?>
      
  </div>
</div>
</section>

<!--Comentario-->
<section class="container mt-5">

<div class="row">
  <p class="text-center fs-3">COMENTARIOS</p>
</div>

<!--Chat-->
<div class="row d-flex justify-content-center">
    
    <?php if(isset($coments) && count($coments) > 0) { 
            for($i = 0; $i < count($coments); $i++){
    ?>
        
                <div class="col-8 rounded overflow-hidden mb-2 p-2">
                    <div class="rounded overflow-hidden descripcionVerAnime<?php echo $coments[$i]['username'] == $_SESSION['usuario']['username'] ? '2' : '' ?> p-2">
                      <p class="fs-2 <?php echo $coments[$i]['username'] == $_SESSION['usuario']['username'] ? 'text-end' : 'text-start' ?> "><?php echo $coments[$i]['username'] ?></p> 
                      <p class="txtImprenta"><?php echo $coments[$i]['txt'] ?></p>
                    </div> 
                </div>
    
    <?php   } 
    
        }
        else{ ?>
    
        <div class="col-8 rounded overflow-hidden mb-2 p-2">
            <div class="rounded overflow-hidden descripcionVerAnime p-2">
                <p class="fs-2 text-center ">NO EXISTE NINGUN COMENTARIO</p> 
                <p class="txtImprenta">SE EL PRIMERO EN ESCRIBIR UN COMENTARIO</p>
            </div> 
        </div>
    
    <?php
        }
    ?>
    
    <div class="col-8 justify-content-center mt-5">
        
        <form action="/shironime/comentario" name="formComent" method="post">
            <textarea class="col-12" id="comentarioEscrito" placeholder="Comentario..." name="comentarioEscrito" rows="3"></textarea>
            <input style="display:none" value="<?php echo $capMostrar['capitulo'] ?>" type="text" id="capituloC" name="capituloC" />
            <input style="display:none" value="<?php echo $capMostrar['id_serie'] ?>" type="text" id="idSerieC" name="idSerieC" />
    
            <button class="btnComents col-12" type="submit" name='btEnviarComent' id="btEnviarComent">Enviar comentario</button>
        </form>
        
    </div>
    
   
</div>

</section>