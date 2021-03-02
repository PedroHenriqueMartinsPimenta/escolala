<?php
/**
 * @package unschool
 */

get_header(); 
?>
<div class="container" id="contentdiv">
     <div class="row">
         
        <div class="col-md-12 site-main">
        	 <div class="blog-post">
					<?php
                    if ( have_posts() ) :
                        
                        while ( have_posts() ) : the_post();
                        ?>   
						<div><h1><?php echo the_title(); ?></h1></div>
						<div><?php echo the_content();?></div>
						 <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
						<?php if ( comments_open() || get_comments_number() ) :
						comments_template();
						endif;?>
                        <?php endwhile;
                    endif;
                    ?>
                    </div><!--blog-post -->
             </div><!--col-md-8--> 
                          
        <div class="clearfix"></div>
    </div><!-- row -->
</div><!-- container -->
<?php get_footer(); ?>