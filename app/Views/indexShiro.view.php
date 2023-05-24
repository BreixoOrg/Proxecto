<main class=" mt-2 mb-2 rounded container bg-white p-3">
    <div class="col-12 d-flex justify-content-center bgDarky text-white rounded">
        <p class="txtPortait m-auto">ANIMES</p>
    </div>
    <section class="col-12">
        
        <?php for($i = 0; $i < (count($animesMostrar)); $i += 3 ){  ?>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
            
            <?php if(isset($animesMostrar[$i])){ ?>
            <div class="col">
                <div class="card h-100">
                    
                    <a href="#"><img src="<?php echo $animesMostrar[$i]['rutaPortada'] ?>" class="card-img-top" alt="Imagen portada del anime <?php echo $animesMostrar[$i]['nombre'] ?>"></a>
                    <div class="card-body overflow-hidden">
                        <h5 class="card-title"><?php echo ucwords($animesMostrar[$i]['nombre']) ?></h5>
                        <p class="card-text"><?php echo $animesMostrar[$i]['descripcion']?></p>
                    </div>
                </div>
            </div>
            
            <?php
            } ?>
            
            <?php if(isset($animesMostrar[$i + 1])){ ?>
            <div class="col">
                <div class="card h-100">
                    <a href="#"><img src="<?php echo $animesMostrar[$i + 1]['rutaPortada'] ?>" class="card-img-top" alt="Imagen portada del anime <?php echo $animesMostrar[$i + 1]['nombre'] ?>"></a>
                    <div class="card-body overflow-hidden">
                        <h5 class="card-title"><?php echo ucwords($animesMostrar[$i + 1]['nombre']) ?></h5>
                        <p class="card-text"><?php echo $animesMostrar[$i + 1]['descripcion']?></p>
                    </div>
                </div>
            </div>
            
            <?php
            } ?>
            
            
            <?php if(isset($animesMostrar[$i + 2])){ ?>
            <div class="col">
                <div class="card h-100">
                    <a href="#"><img src="<?php echo $animesMostrar[$i + 2]['rutaPortada'] ?>" class="card-img-top" alt="Imagen portada del anime <?php echo $animesMostrar[$i + 2]['nombre'] ?>"></a>
                    <div class="card-body overflow-hidden">
                        <h5 class="card-title"><?php echo ucwords($animesMostrar[$i + 2]['nombre']) ?></h5>
                        <p class="card-text"><?php echo $animesMostrar[$i + 2]['descripcion']?></p>
                    </div>
                </div>
            </div>
            
            <?php
            } ?>
        
        </div>
        
        <?php } ?>
        
        <!-- BARRA DE NAVEGACION -->
        <div class="mt-3 d-flex justify-content-center" role="navigation" aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>

    </section>

</main>