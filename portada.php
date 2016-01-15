
<?php function portada($categoria){?>
    <?php if(!empty($categoria)){ ?>
        <?php $portadas =  query_posts(array("post_type"=>"portada","categoria-portada"=>$categoria, "posts_per_page"=>5));
        $items = count($portadas);
        ?>

        <?php if(!empty($portadas)){?>
            <section class="slider">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <?php if($items>1) { ?>
          <ol class="carousel-indicators">
              <?php for($i=1; $i<=$items; $i++){?>
                <li data-target="#myCarousel" data-slide-to="<?php echo $i;?>" class="<?php if($i==0){?>active <?php } ?>"></li>
            <?php }?>
          </ol>
          <?php } ?>
          <div class="carousel-inner" role="listbox">
              <?php $i=0;?>
              <?php while(have_posts()){ the_post();?>
                <div class="item <?php if($i==1) { ?>active <?php }?>">
                     <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                    <img src="<?php echo $feat_image;?>" class="img-responsive" alt="">
                </div>
            <?php $i++; } ?>
          </div>
    </div>
            </section>
            <?php } ?>
    <?php }?>
<?php } ?>