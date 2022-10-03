<?php
/**
 * Custom Controls
 * 
 * @package Bloginwp
 * @since 1.0.0
 */
if( class_exists( 'WP_Customize_Control' ) ) :
    // base control class
    class Bloginwp_WP_Base_Control extends \WP_Customize_Control {
        /**
         * List of controls for this theme.
         * 
         * @since 1.0.0
         */
        protected $type_array =  array(
            'toggle-button',
            'info-box',
            'multicheckbox',
            'checkbox',
            'range',
            'responsive-range',
            'simple-toggle-button',
            'tab-group',
            'box',
            'responsive-box',
            'color-group-picker',
            'border-box',
            'color-image-group',
            'color-picker',
            'advanced-color-group',
            'section-tab'
        );
        public $tab = 'general';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            if( $this->tab && $this->type != 'section-tab' ) {
                $this->json['tab'] = $this->tab;
            }
        }

        /**
         * Render the control's content.
         *
         */
        public function render_content() {
            if( ! in_array( $this->type, $this->type_array ) ) return;
    ?>
            <div class="customize-<?php echo esc_attr( $this->type ); ?>-control" data-setting="<?php echo esc_attr( $this->setting->id ); ?>"></div>
    <?php
        }
    }

    // multicheckbox control
    class Bloginwp_WP_Multicheckbox_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'multicheckbox';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

    // toggle control 
    class Bloginwp_WP_Toggle_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'toggle-button';
    }

    // checkbox control 
    class Bloginwp_WP_Checkbox_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'checkbox';
    }

    // range control
    class Bloginwp_WP_Range_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'range';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['input_attrs'] = $this->input_attrs;
        }
    }

    // responsive range control
    class Bloginwp_WP_Responsive_Range_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'responsive-range';
        
        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['input_attrs'] = $this->input_attrs;
        }
    }

    // tab group control
    class Bloginwp_WP_Tab_Group_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'tab-group';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

    // box control
    class Bloginwp_WP_Box_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'box';
    }

    // responsive box control
    class Bloginwp_WP_Responsive_Box_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'responsive-box';
    }

    // color group picker control - renders color and hover color control
    class Bloginwp_WP_Color_Group_Picker_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'color-group-picker';
    }

    // border box control - renders border property control
    class Bloginwp_WP_Border_Box_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'border-box';
    }

    // color gradient and image group control
    class Bloginwp_WP_Color_Image_Group_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'color-image-group';
    }

    // color picker control
    class Bloginwp_WP_Color_Picker_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'color-picker';
    }

    // advanced color group picker control
    class Bloginwp_WP_Advanced_Color_Group_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'advanced-color-group';
    }

    // info box control
    class Bloginwp_WP_Info_Box_Control extends Bloginwp_WP_Base_Control {
        // control type
        public $type = 'info-box';
        
        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

    // section tab control - renders section tab control
    class Bloginwp_WP_Section_Tab_Control extends Bloginwp_WP_Base_Control {
        /**
         * Control type
         * 
         */
        public $type = 'section-tab';
    }
endif;