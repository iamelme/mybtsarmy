




<?php 


$user_liked =	get_post_meta( $post->ID, '_post_like_count', true);  


// echo $user_liked;

?>


    
<div class="fans__thumb" id="<?php echo get_post_meta( $post->ID, 'meta_desc', true); ?>">
    <div class="fans__thumb--inner imgTarget" style="background: url(<?php echo get_post_meta( $post->ID, '_thumb_f', true); ?>) no-repeat <?php echo get_post_meta( $post->ID, 'hor', true) ? get_post_meta( $post->ID, 'hor', true) : 'center' ?> <?php echo get_post_meta( $post->ID, 'ver', true) ? get_post_meta( $post->ID, 'ver', true) : 'center' ?> / cover">
        <div class="overlay">
            <div><?php the_title(); ?></div>
            <svg class="icon icon-eye"><use xlink:href="#icon-eye"></use></svg>
            <span class="view-count"><?php echo getPostViews(get_the_ID()); ?>	views</span>
            <?php echo get_simple_likes_button( get_the_ID() ); ?>
        </div>
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="fans__thumb--link"></a>
    </div>
</div>












