<?php
/**
 * Adds bloginwp_Category_Collection_Widget widget.
 */
class bloginwp_Category_Collection_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bloginwp_category_collection_widget',
            esc_html__( 'TSB : Category Collection', 'bloginwp' ),
            array( 'description' => __( 'A collection of post categories.', 'bloginwp' ) )
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        $posts_categories = isset( $instance['posts_categories'] ) ? $instance['posts_categories'] : '';
        $categories_title = isset( $instance['categories_title'] ) ? $instance['categories_title'] : true;
        $categories_count = isset( $instance['categories_count'] ) ? $instance['categories_count'] : true;

        echo wp_kses_post( $before_widget );
            if ( ! empty( $widget_title ) ) {
                echo wp_kses_post( $before_title ) . esc_html( $widget_title ) . wp_kses_post( $after_title );
            }
    ?>
            <div class="categories-wrap layout-two">
                <?php
                if( $posts_categories != '[]' ) {
                    $postCategories = get_categories( array( 'slug' => explode( ",", $posts_categories ) ) );
                } else {
                    $postCategories = get_categories();
                }
                    foreach( $postCategories as $cat ) :
                        $cat_name = $cat->name;
                        $cat_count = $cat->count;
                        $cat_slug = $cat->slug;
                        $cat_id = $cat->cat_ID;
                        $widget_post = new WP_Query( 
                            array( 
                                'category_name'    => esc_html( $cat_slug ),
                                'posts_per_page' => 1,
                                'meta_query' => array(
                                    array(
                                     'key' => '_thumbnail_id',
                                     'compare' => 'EXISTS'
                                    ),
                                )
                            )
                        );
                        if( $widget_post->have_posts() ) :
                            while( $widget_post->have_posts() ) : $widget_post->the_post();
                                $thumbnail_url = get_the_post_thumbnail_url();
                            endwhile;
                        endif;
                ?>
                        <div class="bmm-post-thumb category-item cat-<?php echo esc_attr( $cat_id ); ?>">
                            <?php if( $thumbnail_url ) : ?>
                                <img src="<?php echo esc_url( $thumbnail_url ); ?>" loading="<?php bloginwp_lazy_load_value(); ?>">
                            <?php endif; ?>
                            <a class="cat-meta-wrap" href="<?php echo esc_url( get_term_link( $cat_id ) ); ?>">
                                <div class="cat-meta bmm-post-title">
                                    <?php
                                        if( $categories_title ) {
                                            echo '<span class="category-name">'.esc_html( $cat_name ).'</span>';
                                        }

                                        if( $categories_count ) {
                                            echo '<span class="category-count">';
                                            echo absint( $cat_count );
                                                ?>
                                                <span class="article_text">
                                                    <?php echo esc_html( 'Articles', 'bloginwp'); ?>
                                                </span>
                                                <?php
                                            echo '</span>';
                                        }
                                    ?>
                                </div>
                            </a>
                        </div>
                <?php
                    endforeach;
                ?>
            </div>
    <?php
        echo wp_kses_post( $after_widget );
    }

    /**
     * Widgets fields
     * 
     */
    function widget_fields() {
        $postCategories = get_categories();
        foreach( $postCategories as $category ) :
            $categories_options[$category->slug] = $category->name. ' (' .$category->count. ') ';
        endforeach;
        return array(
                array(
                    'name'      => 'widget_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Widget Title', 'bloginwp' ),
                    'description'=> esc_html__( 'Add the widget title here', 'bloginwp' ),
                    'default'   => esc_html__( 'Category Collection', 'bloginwp' )
                ),
                array(
                    'name'      => 'posts_categories',
                    'type'      => 'multicheckbox',
                    'title'     => esc_html__( 'Post Categories', 'bloginwp' ),
                    'description'=> esc_html__( 'Choose the categories to display', 'bloginwp' ),
                    'options'   => $categories_options
                ),
                array(
                    'name'      => 'categories_title',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show categories title', 'bloginwp' ),
                    'default'   => true
                ),
                array(
                    'name'      => 'categories_count',
                    'type'      => 'checkbox',
                    'title'     => esc_html__( 'Show categories count', 'bloginwp' ),
                    'default'   => true
                )
            );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if ( isset( $instance[ $widget_field['name'] ] ) ) {
                $field_value = $instance[ $widget_field['name'] ];
            } else if( isset( $widget_field['default'] ) ) {
                $field_value = $widget_field['default'];
            } else {
                $field_value = '';
            }
            bloginwp_widget_fields( $this, $widget_field, $field_value );
        endforeach;
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) {
            return $instance;
        }
        foreach( $widget_fields as $widget_field ) :
            $instance[$widget_field['name']] = bloginwp_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;

        return $instance;
    }
 
} // class bloginwp_Category_Collection_Widget