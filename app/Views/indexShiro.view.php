
    <div class="col-12 d-flex justify-content-center bgDarky text-white rounded">
        <p class="txtPortait m-auto">ANIMES</p>
    </div>
    <section class="col-12">
        
        <?php if(count($animesMostrar) === 0){ ?>
        <p class="text-center mt-2 fs-3">ANIME NO ENCONTRADO</p>
        <?php } ?>
        
        <?php for($i = 0; $i < (count($animesMostrar)); $i += 3 ){  ?>

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
            
            <?php if(isset($animesMostrar[$i])){ ?>
            <div class="col">
                <div class="card h-100">
                    
                    <a href="/shironime/animecompleto?id=<?php echo $animesMostrar[$i]['id_serie'] ?>"><img src="<?php echo $animesMostrar[$i]['rutaPortada'] ?>" class="card-img-top" alt="Imagen portada del anime <?php echo $animesMostrar[$i]['nombre'] ?>"></a>
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
                    <a href="/shironime/animecompleto?id=<?php echo $animesMostrar[$i]['id_serie'] ?>"><img src="<?php echo $animesMostrar[$i + 1]['rutaPortada'] ?>" class="card-img-top" alt="Imagen portada del anime <?php echo $animesMostrar[$i + 1]['nombre'] ?>"></a>
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
                    <a href="/shironime/animecompleto?id=<?php echo $animesMostrar[$i]['id_serie'] ?>"><img src="<?php echo $animesMostrar[$i + 2]['rutaPortada'] ?>" class="card-img-top" alt="Imagen portada del anime <?php echo $animesMostrar[$i + 2]['nombre'] ?>"></a>
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
        
        <?php if(count($animesMostrar) !== 0){ ?>
        
            <?php if(isset($ocultarNavAnimes) && $ocultarNavAnimes){ ?>

            <!-- BARRA DE NAVEGACION DE ANIMES -->
            <div class="mt-3 d-flex justify-content-center" role="navigation" aria-label="Page navigation example">
                <ul class="pagination">

                    <?php if(isset($page) && $page > 1){ ?>
                    <li class="page-item">
                        <a class="page-link" href="/shironime?page=<?php echo $page - 1 ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php if(isset($page) && $page < $paginas){ ?>
                    <li class="page-item">
                        <a class="page-link" href="/shironime?page=<?php echo $page + 1 ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>

            <?php } ?>
        
        
        <?php } ?>

    </section>

