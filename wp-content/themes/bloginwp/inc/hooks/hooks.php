<?php
/**
 * Contains theme hooks and functions
 * 
 * @package Bloginwp
 * @since 1.0.0
 */

if( !function_exists( 'bloginwp_scroll_to_top' ) ) :
    /**
     * Scroll to top fnc
     * 
     * @since 1.0.0
     */
    function bloginwp_scroll_to_top() {
        $scroll_to_top_option = get_theme_mod( 'scroll_to_top_option', true );
        if( ! $scroll_to_top_option ) return;
        $scroll_to_top_responsive_display = get_theme_mod( 'scroll_to_top_responsive_display', false );
        if( ! $scroll_to_top_responsive_display && wp_is_mobile() ) return;
        $scroll_to_top_align = get_theme_mod( 'scroll_to_top_align', 'align--right' );
    ?>
        <div id="bloginwp-scroll-to-top" class="<?php echo esc_attr( $scroll_to_top_align ); ?>">
            <span class="icon-holder"><i class="fas fa-chevron-up"></i></span>
        </div><!-- #bloginwp-scroll-to-top -->
    <?php
    }
    add_action( 'bloginwp_after_footer_hook', 'bloginwp_scroll_to_top' );
 endif;

 if( ! function_exists( 'bloginwp_single_author_box' ) ) :
    /**
     * Single author box
     * 
     */
    function bloginwp_single_author_box() {
        if( get_post_type() != 'post' ) return;

        if( get_theme_mod('single_post_author_box_option', true) ):
            ?>
            <div class="post-footer__author">
                <div class="author__avatar">
                    <?php echo wp_kses_post( get_avatar(get_the_author_meta('ID'), 125) ); ?>
                </div>
                <div class="author__info">
                    <h5 class="author-name"><?php echo esc_html( get_the_author() ); ?></h5>
                    <?php if( get_the_author_meta('description') ) { ?>
                        <p class="author-desc"><?php echo wp_kses_post( get_the_author_meta('description') ); ?></p>
                    <?php } ?>
                </div>
            </div>
            <?php
        endif;

    }
 endif;
 add_action( 'bloginwp_single_after_content', 'bloginwp_single_author_box' );

 if( ! function_exists( 'bloginwp_single_related_posts' ) ) :
    /**
     * Single related posts
     * 
     */
    function bloginwp_single_related_posts() {
        if( get_post_type() != 'post' ) return;
        if( is_single() ) :
            $single_post_related_posts_option = true;
            if( ! $single_post_related_posts_option ) return;
            $related_posts_title = get_theme_mod( 'single_post_related_posts_title', esc_html__( 'Related Posts', 'bloginwp' ) );
            $related_posts_filter_by = 'category';
            $post_count = get_theme_mod( 'single_post_related_posts_count', 2 );
        else :
            $archive_post_related_posts_responsive_display = true;
            if( ! $archive_post_related_posts_responsive_display && wp_is_mobile() ) return;
            $archive_post_related_posts_option = get_theme_mod( 'archive_post_related_posts_option', true );
            $archive_posts_layout = get_theme_mod( 'archive_posts_layout', 'grid-layout-twocol' );
            if( ! $archive_post_related_posts_option || $archive_posts_layout === 'grid-layout-twocol' ) return;
            $related_posts_title = get_theme_mod( 'archive_post_related_posts_title', esc_html__( 'Related Posts', 'bloginwp' ) );
            $related_posts_filter_by = 'category';
            $post_count = get_theme_mod( 'archive_post_related_posts_count', 2 );
        endif;
        $related_posts_args = array(
            'posts_per_page'   => absint( $post_count ),
            'post__not_in'  => array( get_the_ID() )
        );
        if( $related_posts_filter_by === 'category' ) :
            $current_post_categories = get_the_category(get_the_ID());
            if( $current_post_categories ) :
                foreach( $current_post_categories as $current_post_cat ) :
                    $query_cats[] =  $current_post_cat->term_id;
                endforeach;
                $related_posts_args['category__in'] = $query_cats;
            endif;
        else :
            $current_post_tags = get_the_tags(get_the_ID());
            if( $current_post_tags ) :
                foreach( $current_post_tags as $current_post_tag ) :
                    $query_tags[] =  $current_post_tag->term_id;
                endforeach;
                $related_posts_args['tag__in'] = $query_tags;
            endif;
        endif;
        $related_posts = new WP_Query( $related_posts_args );
        if( ! $related_posts->have_posts() ) return;

        $show_on_popup = true;
  ?>
            <div class="single-related-posts-section-wrap <?php if($show_on_popup) echo esc_attr('related_posts_popup'); ?>">
                <div class="single-related-posts-section">
                    <a href="javascript:void(0);" class="related_post_close">
                        <i class="fas fa-times-circle"></i>
                    </a>
                    <?php
                        if( $related_posts_title ) echo '<div class="center-line-title -large -mb-2"><h5>' .esc_html( $related_posts_title ). '</h5></div>';
                            echo '<div class="single-related-posts-wrap">';
                                while( $related_posts->have_posts() ) : $related_posts->the_post();
                            ?>
                                <article post-id="post-<?php the_ID(); ?>" class="bmm-post post-card <?php if( !has_post_thumbnail() ) echo esc_attr('no_feature_img'); ?>">
                                    
                                    <div class="post-thumb-wrap">
                                        <?php
                                        if( has_post_thumbnail() ) {
                                            ?>
                                            <div class="date_wrap">
                                                <?php bloginwp_posted_on(); ?>
                                            </div>
                                            
                                            <div class="bmm-post-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php 
                                                        the_post_thumbnail('bloginwp-category-feat');
                                                    ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="card__content">
                                        <?php
                                            $categories = get_the_category( get_the_ID() );
                                            if( $categories ) {
                                                echo '<div class="bmm-post-cats-wrap bmm-post-meta-item">';
                                                $count = 0;
                                                foreach( $categories as $category ) :
                                                    echo '<h5 class="card__content-category post-cat-'.absint( $category->term_id ).'"><a href="'.esc_url( get_term_link( $category->term_id ) ).'">'.esc_html( $category->name ).'</a></h5>';
                                                    if( $count > 0 ) break;
                                                    $count++;
                                                endforeach;
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="bmm-post-title">
                                            <a class="card__content-title" href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </div>
                                        
                                        <?php
                                            $related_post_content = false;
                                            if($related_post_content) {
                                            ?> 
                                            <div class="entry-content">
                                            <?php
                                                $archive_content_type = get_theme_mod( 'archive_content_type', 'excerpt' );
                                                switch( $archive_content_type ) {
                                                    case 'content' : the_content();
                                                                break;
                                                    default: the_excerpt();
                                                            break;
                                                }
                                            ?>
                                            </div><!-- .entry-content -->
                                        <?php } ?>

                                        <div class="bottom_article_info">
                                            <div class="read_time">
                                                <span><?php echo esc_html( 'Read Time: ', 'bloginwp'); ?></span>
                                                <?php echo absint(bloginwp_post_read_time(get_the_content())); ?>
                                                <span> <?php esc_html_e('Min', 'bloginwp'); ?></span>
                                            </div>
                                            <?php 
                                            
                                            $archive_post_comments_num_option = get_theme_mod( 'archive_post_comments_num_option', true );
                                            if($archive_post_comments_num_option){
                                                ?>
                                                <div class="card__content-info">
                                                    <div class="info__comment">
                                                        <i class="far fa-comment"></i>
                                                        <p><?php echo absint(get_comments_number()); ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            $archive_read_more_option = get_theme_mod( 'archive_read_more_option', false );
                                            if( $archive_read_more_option ) :
                                                $archive_read_more_text = get_theme_mod( 'archive_read_more_text', esc_html__( 'Read more', 'bloginwp' ) );
                                                echo '<div class="card__button"><a href="' .esc_url( get_the_permalink() ). '">' .esc_html( $archive_read_more_text ). '</a></div>';
                                            endif;
                                            ?>
                                        </div>


                                    </div>
                                </article>
                            <?php
                                endwhile;
                            echo '</div>';
                    ?>
                </div>
            </div>
    <?php
    }
 endif;
 add_action( 'bloginwp_single_post_footer_hook', 'bloginwp_single_related_posts' );
 $archive_posts_layout = get_theme_mod( 'archive_posts_layout', 'grid-layout-twocol' );


 if( $archive_posts_layout == 'grid-layout') {
    add_action( 'bloginwp_archive_post_footer_hook', 'bloginwp_single_related_posts' );
 }

if( ! function_exists( 'bloginwp_pagination_fnc' ) ) :
    /**
     * Renders pagination
     * 
     */
    function bloginwp_pagination_fnc() {
        if( is_null( paginate_links() ) ) {
            return;
        }
        $pagination_type = 'pagination';
        if( is_search() ) {
            $pagination_type = 'pagination';
        }

        echo '<div class="pagination">' .wp_kses_post( paginate_links( array( 'prev_text' => '<i class="fas fa-chevron-left"></i>', 'next_text' => '<i class="fas fa-chevron-right"></i>', 'type' => 'list' ) ) ). '</div>';
        
    }
    add_action( 'bloginwp_pagination_link_hook', 'bloginwp_pagination_fnc' );
 endif;