<!--VIDEO-->
<section class="container">

<div class="row">
    <p class="text-center fs-2"><?php echo isset($capMostrar['nombre']) && isset($capMostrar['capitulo']) ? ucwords($capMostrar['nombre']) . " Capítulo " . $capMostrar['capitulo'] : "Nombre no encontrado" ?></p>
</div>

<div class="row containerVideo">
  <video poster="<?php echo isset($capMostrar['rutaPortada']) ? $capMostrar['rutaPortada'] : "./nublado-cumulo-paisaje-neblina.jpg" ?>" controls autoplay preload="none">
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

  <div class="col-8 rounded overflow-hidden mb-2 p-2">
    <div class="rounded overflow-hidden descripcionVerAnime p-2">
      <p class="fs-2 text-start">usuario</p> 
      <p class="txtImprenta">1Holaaaaaaaaa aaaaaaaaaaaaaaaaaa aaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaa aaaaaa aaaaaaaa aaaaaaaa aaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaa aaaaaaaa aaaaaaa aaaaaaa aaaaaaaa aaaa aaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa</p>
    </div> 
  </div>

  <div class="col-8 rounded overflow-hidden mb-2 p-2">
    <div class="rounded overflow-hidden descripcionVerAnime p-2">
      <p class="fs-2 text-start">usuario</p> 
      <p class="txtImprenta">2Holaaaaaaaaa aaaaaaaaaaaaaaaaaa aaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaa aaaaaa aaaaaaaa aaaaaaaa aaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaa aaaaaaaa aaaaaaa aaaaaaa aaaaaaaa aaaa aaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa</p>
    </div> 
  </div>

  <div class="col-8 rounded justify-content-end overflow-hidden mb-2 p-2">
    <div class="rounded overflow-hidden descripcionVerAnime2 p-2">
      <p class="fs-2 text-end">Yo</p> 
      <p class="txtImprenta">3Holaaaaaaaaa aaaaaaaaaaaaaaaaaa aaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaa aaaaaa aaaaaaaa aaaaaaaa aaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaa aaaaaaaa aaaaaaa aaaaaaa aaaaaaaa aaaa aaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa</p>
    </div> 
  </div>

  <div class="col-8 rounded overflow-hidden mb-2 p-2">
    <div class="rounded overflow-hidden descripcionVerAnime p-2">
      <p class="fs-2 text-start">usuario</p> 
      <p class="txtImprenta">4Holaaaaaaaaa aaaaaaaaaaaaaaaaaa aaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaa aaaaaa aaaaaaaa aaaaaaaa aaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaa aaaaaaaa aaaaaaa aaaaaaa aaaaaaaa aaaa aaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa</p>
    </div> 
  </div>

  <div class="col-8 rounded overflow-hidden mb-2 p-2">
    <div class="rounded overflow-hidden descripcionVerAnime p-2">
      <p class="fs-2 text-start">usuario</p> 
      <p class="txtImprenta">5Holaaaaaaaaa aaaaaaaaaaaaaaaaaa aaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaa aaaaaa aaaaaaaa aaaaaaaa aaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaa aaaaaaaa aaaaaaa aaaaaaa aaaaaaaa aaaa aaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa</p>
    </div> 
  </div>

  <div class="col-8 rounded overflow-hidden mb-2 p-2">
    <div class="rounded overflow-hidden descripcionVerAnime p-2">
      <p class="fs-2 text-start">usuario</p> 
      <p class="txtImprenta">6Holaaaaaaaaa aaaaaaaaaaaaaaaaaa aaaaaaaaaaa aaaaaaaaaaaaaa aaaaaaaaaaaa aaaaaaaaa aaaaaaaaaaaa aaaaaaaaaaaa aaa aaaaaa aaaaaaaa aaaaaaaa aaa aaaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaa aaaaaaaa aaaaaaa aaaaaaa aaaaaaaa aaaa aaaaaaaaa aaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaa</p>
    </div> 
  </div>

  <div class="row justify-content-center">
    <button class="btnComents col-8" type="button" id="btCargarComents">Cargar más comentarios</button>
  </div>
   
</div>

</section>