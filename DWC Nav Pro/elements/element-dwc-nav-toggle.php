<?php
// elements/element-dwc-nav-toggle.php
if ( ! defined( 'ABSPATH' ) ) exit;

class DWC_Element_Nav_Toggle extends \Bricks\Element {
    
    // Element properties
    public $category = 'dwc-navigation';
    public $name = 'dwc-nav-toggle';
    public $icon = 'ti-menu-alt';
    public $css_selector = '.dwc-mobile-toggle';
    public $scripts = [];
    
    // Return element label
    public function get_label() {
        return esc_html__( 'DWC Mobile Toggle', 'bricks' );
    }
    
    // Return element keywords
    public function get_keywords() {
        return [ 'mobile', 'toggle', 'hamburger', 'menu', 'button', 'dwc' ];
    }
    
    // Set control groups
    public function set_control_groups() {
        $this->control_groups['content'] = [
            'title' => esc_html__( 'Content', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['style'] = [
            'title' => esc_html__( 'Toggle Style', 'bricks' ),
            'tab' => 'style',
        ];
        
        $this->control_groups['lines'] = [
            'title' => esc_html__( 'Hamburger Lines', 'bricks' ),
            'tab' => 'style',
        ];
        
        $this->control_groups['animation'] = [
            'title' => esc_html__( 'Animation', 'bricks' ),
            'tab' => 'style',
        ];
    }
    
    // Set element controls
    public function set_controls() {
        // Content Controls
        $this->controls['toggle_type'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Toggle Type', 'bricks' ),
            'type' => 'select',
            'options' => [
                'hamburger' => esc_html__( 'Hamburger Lines', 'bricks' ),
                'icon' => esc_html__( 'Custom Icon', 'bricks' ),
                'text' => esc_html__( 'Text Button', 'bricks' ),
                'both' => esc_html__( 'Icon + Text', 'bricks' ),
            ],
            'default' => 'hamburger',
        ];
        
        $this->controls['toggle_icon'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Toggle Icon', 'bricks' ),
            'type' => 'icon',
            'required' => [ 'toggle_type', 'in', [ 'icon', 'both' ] ],
        ];
        
        $this->controls['toggle_icon_close'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Close Icon', 'bricks' ),
            'type' => 'icon',
            'description' => esc_html__( 'Icon to show when menu is open', 'bricks' ),
            'required' => [ 'toggle_type', 'in', [ 'icon', 'both' ] ],
        ];
        
        $this->controls['toggle_text'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Toggle Text', 'bricks' ),
            'type' => 'text',
            'default' => esc_html__( 'Menu', 'bricks' ),
            'required' => [ 'toggle_type', 'in', [ 'text', 'both' ] ],
        ];
        
        $this->controls['toggle_text_close'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Close Text', 'bricks' ),
            'type' => 'text',
            'default' => esc_html__( 'Close', 'bricks' ),
            'description' => esc_html__( 'Text to show when menu is open', 'bricks' ),
            'required' => [ 'toggle_type', 'in', [ 'text', 'both' ] ],
        ];
        
        // Style Controls
        $this->controls['toggle_size'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Size', 'bricks' ),
            'type' => 'number',
            'units' => true,
            'default' => '24px',
            'css' => [
                [
                    'property' => 'width',
                    'selector' => '&',
                ],
                [
                    'property' => 'height',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['toggle_background'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Background', 'bricks' ),
            'type' => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['toggle_padding'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Padding', 'bricks' ),
            'type' => 'spacing',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['toggle_border'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Border', 'bricks' ),
            'type' => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '&',
                ],
            ],
        ];
        
        // Hamburger Lines Style
        $this->controls['line_color'] = [
            'tab' => 'style',
            'group' => 'lines',
            'label' => esc_html__( 'Line Color', 'bricks' ),
            'type' => 'color',
            'default' => '#333333',
            'required' => [ 'toggle_type', '=', 'hamburger' ],
            'css' => [
                [
                    'property' => 'background-color',
                    'selector' => '.dwc-toggle-line',
                ],
            ],
        ];
        
        $this->controls['line_width'] = [
            'tab' => 'style',
            'group' => 'lines',
            'label' => esc_html__( 'Line Width', 'bricks' ),
            'type' => 'number',
            'units' => true,
            'default' => '20px',
            'required' => [ 'toggle_type', '=', 'hamburger' ],
            'css' => [
                [
                    'property' => 'width',
                    'selector' => '.dwc-toggle-line',
                ],
            ],
        ];
        
        $this->controls['line_height'] = [
            'tab' => 'style',
            'group' => 'lines',
            'label' => esc_html__( 'Line Height', 'bricks' ),
            'type' => 'number',
            'units' => true,
            'default' => '2px',
            'required' => [ 'toggle_type', '=', 'hamburger' ],
            'css' => [
                [
                    'property' => 'height',
                    'selector' => '.dwc-toggle-line',
                ],
            ],
        ];
        
        $this->controls['line_gap'] = [
            'tab' => 'style',
            'group' => 'lines',
            'label' => esc_html__( 'Gap Between Lines', 'bricks' ),
            'type' => 'number',
            'units' => true,
            'default' => '4px',
            'required' => [ 'toggle_type', '=', 'hamburger' ],
            'css' => [
                [
                    'property' => 'gap',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['line_border_radius'] = [
            'tab' => 'style',
            'group' => 'lines',
            'label' => esc_html__( 'Line Border Radius', 'bricks' ),
            'type' => 'border',
            'exclude' => [ 'width', 'style', 'color' ],
            'required' => [ 'toggle_type', '=', 'hamburger' ],
            'css' => [
                [
                    'property' => 'border-radius',
                    'selector' => '.dwc-toggle-line',
                ],
            ],
        ];
        
        // Animation Controls
        $this->controls['animation_type'] = [
            'tab' => 'style',
            'group' => 'animation',
            'label' => esc_html__( 'Animation Type', 'bricks' ),
            'type' => 'select',
            'options' => [
                'none' => esc_html__( 'None', 'bricks' ),
                'cross' => esc_html__( 'Cross (X)', 'bricks' ),
                'arrow' => esc_html__( 'Arrow', 'bricks' ),
                'spin' => esc_html__( 'Spin', 'bricks' ),
            ],
            'default' => 'cross',
            'required' => [ 'toggle_type', '=', 'hamburger' ],
        ];
        
        $this->controls['animation_speed'] = [
            'tab' => 'style',
            'group' => 'animation',
            'label' => esc_html__( 'Animation Speed (ms)', 'bricks' ),
            'type' => 'number',
            'default' => 300,
            'min' => 100,
            'max' => 1000,
            'step' => 50,
        ];
    }
    
    // Render element
    public function render() {
        $settings = $this->settings;
        $toggle_type = $settings['toggle_type'] ?? 'hamburger';
        
        // Set toggle attributes
        $toggle_classes = [ 'dwc-mobile-toggle' ];
        $toggle_classes[] = 'dwc-toggle-' . $toggle_type;
        
        if ( $toggle_type === 'hamburger' && ! empty( $settings['animation_type'] ) ) {
            $toggle_classes[] = 'dwc-anim-' . $settings['animation_type'];
        }
        
        $this->set_attribute( '_root', 'class', $toggle_classes );
        $this->set_attribute( '_root', 'type', 'button' );
        $this->set_attribute( '_root', 'aria-label', esc_attr__( 'Toggle mobile menu', 'bricks' ) );
        $this->set_attribute( '_root', 'data-animation-speed', $settings['animation_speed'] ?? 300 );
        
        echo "<button {$this->render_attributes( '_root' )}>";
        
        // Render based on toggle type
        switch ( $toggle_type ) {
            case 'hamburger':
                echo '<span class="dwc-toggle-line"></span>';
                echo '<span class="dwc-toggle-line"></span>';
                echo '<span class="dwc-toggle-line"></span>';
                break;
                
            case 'icon':
                if ( ! empty( $settings['toggle_icon'] ) ) {
                    echo '<i class="dwc-toggle-icon dwc-toggle-open ' . esc_attr( $settings['toggle_icon']['icon'] ?? $settings['toggle_icon'] ) . '"></i>';
                }
                if ( ! empty( $settings['toggle_icon_close'] ) ) {
                    echo '<i class="dwc-toggle-icon dwc-toggle-close ' . esc_attr( $settings['toggle_icon_close']['icon'] ?? $settings['toggle_icon_close'] ) . '"></i>';
                }
                break;
                
            case 'text':
                echo '<span class="dwc-toggle-text dwc-toggle-open">' . esc_html( $settings['toggle_text'] ?? 'Menu' ) . '</span>';
                if ( ! empty( $settings['toggle_text_close'] ) ) {
                    echo '<span class="dwc-toggle-text dwc-toggle-close">' . esc_html( $settings['toggle_text_close'] ) . '</span>';
                }
                break;
                
            case 'both':
                echo '<span class="dwc-toggle-content dwc-toggle-open">';
                if ( ! empty( $settings['toggle_icon'] ) ) {
                    echo '<i class="dwc-toggle-icon ' . esc_attr( $settings['toggle_icon']['icon'] ?? $settings['toggle_icon'] ) . '"></i>';
                }
                echo '<span class="dwc-toggle-text">' . esc_html( $settings['toggle_text'] ?? 'Menu' ) . '</span>';
                echo '</span>';
                
                echo '<span class="dwc-toggle-content dwc-toggle-close">';
                if ( ! empty( $settings['toggle_icon_close'] ) ) {
                    echo '<i class="dwc-toggle-icon ' . esc_attr( $settings['toggle_icon_close']['icon'] ?? $settings['toggle_icon_close'] ) . '"></i>';
                }
                if ( ! empty( $settings['toggle_text_close'] ) ) {
                    echo '<span class="dwc-toggle-text">' . esc_html( $settings['toggle_text_close'] ) . '</span>';
                }
                echo '</span>';
                break;
        }
        
        echo '</button>';
    }
}