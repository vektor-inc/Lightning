<?php
if ( apply_filters( 'lightning_is_extend_single', false ) ) :
	do_action( 'lightning_extend_single' );
else :
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			$template = 'template-parts/entry-' . esc_attr( $post->post_name ).'.php';
			$return = locate_template( $template );
			if ( $return && $post->post_name != get_post_type() ){
				locate_template( $template, true );
			} else {
				lightning_get_template_part( 'template-parts/entry', get_post_type() );
			}

			do_action( 'lightning_comment_before' );
			comments_template( '', true );
			do_action( 'lightning_comment_after' );

			if ( apply_filters( 'lightning_is_next_prev', true, 'next_prev' ) ) {
				lightning_get_template_part( 'template-parts/next-prev', get_post_type() );
			}
		endwhile;
	endif; // if ( have_posts() ) :
endif; // if ( apply_filters( 'lightning_is_extend_single', false ) ) :
?>