<?php
// elements/element-dwc-nav-dropdown-content.php
if ( ! defined( 'ABSPATH' ) ) exit;

class DWC_Element_Nav_Dropdown_Content extends \Bricks\Element {
    
    // Element properties
    public $category = 'dwc-navigation';
    public $name = 'dwc-nav-dropdown-content';
    public $icon = 'ti-list';
    public $css_selector = '.dwc-dropdown-content';
    public $scripts = [];
    public $nestable = true; // Allow nav items as children
    
    // Return element label
    public function get_label() {
        return esc_html__( 'DWC Dropdown Content', 'bricks' );
    }
    
    // Return element keywords
    public function get_keywords() {
        return [ 'navigation', 'dropdown', 'content', 'list', 'dwc' ];
    }
    
    // Set control groups
    public function set_control_groups() {
        $this->control_groups['layout'] = [
            'title' => esc_html__( 'Layout', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['style'] = [
            'title' => esc_html__( 'Dropdown Style', 'bricks' ),
            'tab' => 'style',
        ];
    }
    
    // Set element controls
    public function set_controls() {
        // Layout Controls
        $this->controls['dropdown_width'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Dropdown Width', 'bricks' ),
            'type' => 'number',
            'units' => true,
            'default' => '200px',
            'css' => [
                [
                    'property' => 'min-width',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['dropdown_columns'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Columns', 'bricks' ),
            'type' => 'number',
            'min' => 1,
            'max' => 6,
            'default' => 1,
            'css' => [
                [
                    'property' => 'columns',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['dropdown_position'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Position', 'bricks' ),
            'type' => 'select',
            'options' => [
                'left' => esc_html__( 'Left Aligned', 'bricks' ),
                'right' => esc_html__( 'Right Aligned', 'bricks' ),
                'center' => esc_html__( 'Center Aligned', 'bricks' ),
                'full' => esc_html__( 'Full Width', 'bricks' ),
            ],
            'default' => 'left',
        ];
        
        // Style Controls
        $this->controls['dropdown_background'] = [
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
        
        $this->controls['dropdown_padding'] = [
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
        
        $this->controls['dropdown_border'] = [
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
        
        $this->controls['dropdown_shadow'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Box Shadow', 'bricks' ),
            'type' => 'box-shadow',
            'css' => [
                [
                    'property' => 'box-shadow',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['dropdown_gap'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Gap Between Items', 'bricks' ),
            'type' => 'number',
            'units' => true,
            'default' => '0px',
            'css' => [
                [
                    'property' => 'gap',
                    'selector' => '&',
                ],
            ],
        ];
    }
    
    // Render element
    public function render() {
        $settings = $this->settings;
        
        // Set dropdown content attributes
        $content_classes = [ 'dwc-dropdown-content' ];
        
        if ( ! empty( $settings['dropdown_position'] ) ) {
            $content_classes[] = 'dwc-dropdown-' . $settings['dropdown_position'];
        }
        
        $this->set_attribute( '_root', 'class', $content_classes );
        
        echo "<ul {$this->render_attributes( '_root' )}>";
        
        // Render nested nav items
        echo \Bricks\Frontend::render_children( $this );
        
        echo '</ul>';
    }
    
    // Define nestable children structure - only allow nav items
    public function get_nestable_children() {
        return [
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
        ];
    }
}