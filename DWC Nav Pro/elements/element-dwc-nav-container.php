<?php
// elements/element-dwc-nav-container.php
if ( ! defined( 'ABSPATH' ) ) exit;

class DWC_Element_Nav_Container extends \Bricks\Element {
    
    // Element properties
    public $category = 'dwc-navigation';
    public $name = 'dwc-nav-container';
    public $icon = 'ti-menu';
    public $css_selector = '.dwc-nav-container';
    public $scripts = ['dwcNavContainer'];
    public $nestable = true; // Allow nesting other elements
    
    // Return element label
    public function get_label() {
        return esc_html__( 'DWC Nav Container', 'bricks' );
    }
    
    // Return element keywords for search
    public function get_keywords() {
        return [ 'navigation', 'nav', 'menu', 'responsive', 'dwc' ];
    }
    
    // Set control groups
    public function set_control_groups() {
        $this->control_groups['layout'] = [
            'title' => esc_html__( 'Layout', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['responsive'] = [
            'title' => esc_html__( 'Responsive', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['mobile_menu'] = [
            'title' => esc_html__( 'Mobile Menu', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['desktop_styles'] = [
            'title' => esc_html__( 'Desktop Styles', 'bricks' ),
            'tab' => 'style',
        ];
        
        $this->control_groups['mobile_styles'] = [
            'title' => esc_html__( 'Mobile Styles', 'bricks' ),
            'tab' => 'style',
        ];
    }
    
    // Set element controls
    public function set_controls() {
        // Layout Controls
        $this->controls['nav_direction'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Navigation Direction', 'bricks' ),
            'type' => 'select',
            'options' => [
                'horizontal' => esc_html__( 'Horizontal', 'bricks' ),
                'vertical' => esc_html__( 'Vertical', 'bricks' ),
            ],
            'default' => 'horizontal',
            'css' => [
                [
                    'property' => 'flex-direction',
                    'selector' => '.dwc-nav-list',
                ],
            ],
        ];
        
        $this->controls['nav_alignment'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Navigation Alignment', 'bricks' ),
            'type' => 'justify-content',
            'css' => [
                [
                    'property' => 'justify-content',
                    'selector' => '.dwc-nav-list',
                ],
            ],
        ];
        
        $this->controls['nav_gap'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Gap Between Items', 'bricks' ),
            'type' => 'number',
            'units' => true,
            'default' => '20px',
            'css' => [
                [
                    'property' => 'gap',
                    'selector' => '.dwc-nav-list',
                ],
            ],
        ];
        
        // Responsive Controls
        $this->controls['mobile_breakpoint'] = [
            'tab' => 'content',
            'group' => 'responsive',
            'label' => esc_html__( 'Mobile Breakpoint', 'bricks' ),
            'type' => 'select',
            'options' => [
                '480px' => '480px',
                '768px' => '768px',
                '991px' => '991px',
                '1024px' => '1024px',
            ],
            'default' => '768px',
        ];
        
        // Mobile Menu Controls
        $this->controls['mobile_menu_type'] = [
            'tab' => 'content',
            'group' => 'mobile_menu',
            'label' => esc_html__( 'Mobile Menu Type', 'bricks' ),
            'type' => 'select',
            'options' => [
                'overlay' => esc_html__( 'Overlay', 'bricks' ),
                'slide' => esc_html__( 'Slide from Side', 'bricks' ),
                'dropdown' => esc_html__( 'Dropdown', 'bricks' ),
            ],
            'default' => 'overlay',
        ];
        
        $this->controls['mobile_slide_direction'] = [
            'tab' => 'content',
            'group' => 'mobile_menu',
            'label' => esc_html__( 'Slide Direction', 'bricks' ),
            'type' => 'select',
            'options' => [
                'left' => esc_html__( 'From Left', 'bricks' ),
                'right' => esc_html__( 'From Right', 'bricks' ),
                'top' => esc_html__( 'From Top', 'bricks' ),
                'bottom' => esc_html__( 'From Bottom', 'bricks' ),
            ],
            'default' => 'left',
            'required' => [ 'mobile_menu_type', '=', 'slide' ],
        ];
        
        // Desktop Styles
        $this->controls['desktop_background'] = [
            'tab' => 'style',
            'group' => 'desktop_styles',
            'label' => esc_html__( 'Background', 'bricks' ),
            'type' => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['desktop_padding'] = [
            'tab' => 'style',
            'group' => 'desktop_styles',
            'label' => esc_html__( 'Padding', 'bricks' ),
            'type' => 'spacing',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['desktop_border'] = [
            'tab' => 'style',
            'group' => 'desktop_styles',
            'label' => esc_html__( 'Border', 'bricks' ),
            'type' => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '&',
                ],
            ],
        ];
        
        // Mobile Styles
        $this->controls['mobile_background'] = [
            'tab' => 'style',
            'group' => 'mobile_styles',
            'label' => esc_html__( 'Mobile Background', 'bricks' ),
            'type' => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '.dwc-mobile-menu',
                ],
            ],
        ];
        
        $this->controls['mobile_padding'] = [
            'tab' => 'style',
            'group' => 'mobile_styles',
            'label' => esc_html__( 'Mobile Padding', 'bricks' ),
            'type' => 'spacing',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '.dwc-mobile-menu',
                ],
            ],
        ];
    }
    
    // Enqueue scripts
    public function enqueue_scripts() {
        wp_enqueue_script( 'dwc-nav-frontend' );
    }
    
    // Render element
    public function render() {
        $settings = $this->settings;
        
        // Set root attributes
        $root_classes = [
            'dwc-nav-container',
            'dwc-nav-' . ( $settings['nav_direction'] ?? 'horizontal' )
        ];
        
        $this->set_attribute( '_root', 'class', $root_classes );
        $this->set_attribute( '_root', 'data-mobile-breakpoint', $settings['mobile_breakpoint'] ?? '768px' );
        $this->set_attribute( '_root', 'data-mobile-type', $settings['mobile_menu_type'] ?? 'overlay' );
        $this->set_attribute( '_root', 'data-slide-direction', $settings['mobile_slide_direction'] ?? 'left' );
        
        echo "<nav {$this->render_attributes( '_root' )}>";
        
        // Desktop navigation
        echo '<div class="dwc-desktop-nav">';
        echo '<ul class="dwc-nav-list">';
        
        // Render nested elements
        if ( ! empty( $this->children ) ) {
            foreach ( $this->children as $child ) {
                echo \Bricks\Frontend::render_element( $child );
            }
        } else {
            // Default placeholder content for builder
            if ( bricks_is_builder() ) {
                echo '<li><a href="#" class="dwc-nav-link">Home</a></li>';
                echo '<li><a href="#" class="dwc-nav-link">About</a></li>';
                echo '<li><a href="#" class="dwc-nav-link">Services</a></li>';
                echo '<li><a href="#" class="dwc-nav-link">Contact</a></li>';
            }
        }
        
        echo '</ul>';
        echo '</div>';
        
        // Mobile menu toggle (will be auto-generated if not manually added)
        if ( ! $this->has_mobile_toggle() ) {
            echo '<button class="dwc-mobile-toggle" aria-label="Toggle mobile menu">';
            echo '<span class="dwc-toggle-line"></span>';
            echo '<span class="dwc-toggle-line"></span>';
            echo '<span class="dwc-toggle-line"></span>';
            echo '</button>';
        }
        
        // Mobile menu container
        echo '<div class="dwc-mobile-menu">';
        echo '<div class="dwc-mobile-menu-content">';
        echo '<ul class="dwc-mobile-nav-list">';
        
        // Render mobile version of nested elements
        if ( ! empty( $this->children ) ) {
            foreach ( $this->children as $child ) {
                echo \Bricks\Frontend::render_element( $child, [ 'mobile_context' => true ] );
            }
        }
        
        echo '</ul>';
        echo '</div>';
        echo '</div>';
        
        echo '</nav>';
    }
    
    // Helper method to check if mobile toggle exists in children
    private function has_mobile_toggle() {
        if ( empty( $this->children ) ) {
            return false;
        }
        
        foreach ( $this->children as $child ) {
            if ( $child['name'] === 'dwc-nav-toggle' ) {
                return true;
            }
        }
        
        return false;
    }
}