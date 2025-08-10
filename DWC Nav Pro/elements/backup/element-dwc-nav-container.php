<?php
// elements/element-dwc-nav-container.php
if ( ! defined( 'ABSPATH' ) ) exit;

class DWC_Element_Nav_Container extends \Bricks\Element {
    
    // Element properties
    public $category = 'dwc-navigation';
    public $name = 'dwc-nav-container';
    public $icon = 'ti-menu';
    public $css_selector = '.dwc-nav-container';
    public $scripts = [];
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
        
        $this->control_groups['styles'] = [
            'title' => esc_html__( 'Styles', 'bricks' ),
            'tab' => 'style',
        ];
    }
    
    // Set element controls
    public function set_controls() {
        // Add repeater for managing nav items (@since 1.5)
        $this->controls['_children'] = [
            'type' => 'repeater',
            'titleProperty' => 'label',
            'items' => 'children',
        ];
        
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
        
        $this->controls['nav_wrap'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Allow Items to Wrap', 'bricks' ),
            'type' => 'checkbox',
            'default' => false,
            'css' => [
                [
                    'property' => 'flex-wrap',
                    'value' => 'wrap',
                    'selector' => '.dwc-nav-list',
                ],
            ],
        ];
        
        // Styles
        $this->controls['background'] = [
            'tab' => 'style',
            'group' => 'styles',
            'label' => esc_html__( 'Background', 'bricks' ),
            'type' => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['padding'] = [
            'tab' => 'style',
            'group' => 'styles',
            'label' => esc_html__( 'Padding', 'bricks' ),
            'type' => 'spacing',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['border'] = [
            'tab' => 'style',
            'group' => 'styles',
            'label' => esc_html__( 'Border', 'bricks' ),
            'type' => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '&',
                ],
            ],
        ];
    }
    
    // Define nestable children structure
    public function get_nestable_children() {
        return [
            [
                'name' => 'dwc-nav-item',
                'label' => esc_html__( 'DWC Nav Item', 'bricks' ),
                'settings' => [
                    'text' => esc_html__( 'Menu Item', 'bricks' ),
                    'link' => [
                        'type' => 'external',
                        'url' => '#',
                    ],
                ],
            ],
            [
                'name' => 'dwc-nav-item',
                'label' => esc_html__( 'DWC Nav Item', 'bricks' ),
                'settings' => [
                    'text' => esc_html__( 'Menu Item', 'bricks' ),
                    'link' => [
                        'type' => 'external',
                        'url' => '#',
                    ],
                ],
            ],
            [
                'name' => 'dwc-nav-dropdown',
                'label' => esc_html__( 'DWC Nav Dropdown', 'bricks' ),
                'settings' => [
                    'text' => esc_html__( 'Dropdown', 'bricks' ),
                ],
                'children' => [
                    [
                        'name' => 'dwc-nav-dropdown-content',
                        'label' => esc_html__( 'Dropdown Content', 'bricks' ),
                        'settings' => [],
                        'children' => [
                            [
                                'name' => 'dwc-nav-item',
                                'label' => esc_html__( 'Dropdown Item 1', 'bricks' ),
                                'settings' => [
                                    'text' => esc_html__( 'Dropdown Item 1', 'bricks' ),
                                    'link' => [
                                        'type' => 'external',
                                        'url' => '#',
                                    ],
                                ],
                            ],
                            [
                                'name' => 'dwc-nav-item',
                                'label' => esc_html__( 'Dropdown Item 2', 'bricks' ),
                                'settings' => [
                                    'text' => esc_html__( 'Dropdown Item 2', 'bricks' ),
                                    'link' => [
                                        'type' => 'external',
                        'url' => '#',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
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
        
        echo "<nav {$this->render_attributes( '_root' )}>";
        
        // Single responsive navigation
        echo '<ul class="dwc-nav-list">';
        
        // Render nested elements
        echo \Bricks\Frontend::render_children( $this );
        
        echo '</ul>';
        
        echo '</nav>';
    }
}