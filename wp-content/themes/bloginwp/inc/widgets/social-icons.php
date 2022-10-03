<?php
 
/**
 * Adds bloginwp_Social_Icons_Widget widget.
 */
class bloginwp_Social_Icons_Widget extends WP_Widget {
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bloginwp_social_icons_widget',
            esc_html__( 'TSB : Social Icons', 'bloginwp' ),
            array( 'description' => __( 'The list of social icons.', 'bloginwp' ) )
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

        echo wp_kses_post( $before_widget );
            if ( ! empty( $widget_title ) ) {
                echo wp_kses_post( $before_title ) . esc_html( $widget_title ) . wp_kses_post( $after_title );
            }
    ?>
            <div class="social-block">
            <?php
                $social_icons_target = get_theme_mod( 'social_icons_target', '_blank' );
                $site_social_icons =  get_theme_mod( 'social_icons', json_encode( array(
                        array(
                            'icon_class'    => esc_attr( 'fab fa-linkedin-in' ),
                            'icon_url'  => '',
                            'item_option'   => 'show'
                        ),
                        array(
                            'icon_class'    => esc_attr( 'fab fa-twitter' ),
                            'icon_url'  => '',
                            'item_option'   => 'show'
                        ),
                        array(
                            'icon_class'    => esc_attr( 'fab fa-vimeo-v' ),
                            'icon_url'  => '',
                            'item_option'   => 'show'
                        ),
                        array(
                            'icon_class'    => esc_attr( 'fab fa-instagram' ),
                            'icon_url'  => '',
                            'item_option'   => 'show'
                        )
                    ))
                );
                $site_social_icons_decoded = json_decode( $site_social_icons );
                if( $site_social_icons_decoded ) {
                    foreach( $site_social_icons_decoded as $social_icon ) {
                        $icon_class = $social_icon->icon_class;
                        $icon_link = $social_icon->icon_url;
                        if( $social_icon->item_option === 'show' ) echo '<a href="'.esc_url( $icon_link ).'" target="' .esc_attr( $social_icons_target ). '"><i class="' .esc_attr( $icon_class ). '"></i></a>';
                    }
                }
            ?>
            </div>
    <?php
        echo wp_kses_post ($after_widget);
    }

    /**
     * Widgets fields
     * 
     */
    function widget_fields() {
        return array(
                array(
                    'name'      => 'widget_title',
                    'type'      => 'text',
                    'title'     => esc_html__( 'Widget Title', 'bloginwp' ),
                    'description'=> esc_html__( 'Add the widget title here', 'bloginwp' ),
                    'default'   => esc_html__( 'Find Me On', 'bloginwp' )
                ),
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
    ?>
            <div class="refer-note">
                <p>
                    <?php esc_html_e( 'Manage social icons from customizer ', 'bloginwp' ); ?>
                    <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[control]=social_icons' ) ); ?>" target="_blank"><?php esc_html_e( 'go to manage social icons', 'bloginwp' ); ?></a>
                </p>
            </div>
    <?php
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
} // class bloginwp_Social_Icons_Widget