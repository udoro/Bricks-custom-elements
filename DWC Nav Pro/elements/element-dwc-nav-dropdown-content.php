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
        $this->control_groups['html'] = [
            'title' => esc_html__( 'HTML Tag', 'bricks' ),
            'tab' => 'content',
        ];
        
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
        // HTML Tag Control
        $this->controls['html_tag'] = [
            'tab' => 'content',
            'group' => 'html',
            'label' => esc_html__( 'HTML Tag', 'bricks' ),
            'type' => 'text',
            'default' => 'ul',
            'placeholder' => 'ul',
            'description' => esc_html__( 'Enter the HTML tag for this element (e.g., ul, div, nav, section)', 'bricks' ),
        ];
        
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
        
        $this->controls['dropdown_display'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Display', 'bricks' ),
            'type' => 'select',
            'options' => [
                'flex' => esc_html__( 'Flex', 'bricks' ),
                'block' => esc_html__( 'Block', 'bricks' ),
                'grid' => esc_html__( 'Grid', 'bricks' ),
                'inline-flex' => esc_html__( 'Inline Flex', 'bricks' ),
            ],
            'default' => 'flex',
            'css' => [
                [
                    'property' => 'display',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['dropdown_direction'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Direction', 'bricks' ),
            'type' => 'select',
            'options' => [
                'column' => esc_html__( 'Column', 'bricks' ),
                'row' => esc_html__( 'Row', 'bricks' ),
                'column-reverse' => esc_html__( 'Column Reverse', 'bricks' ),
                'row-reverse' => esc_html__( 'Row Reverse', 'bricks' ),
            ],
            'default' => 'column',
            'required' => [ 'dropdown_display', '=', [ 'flex', 'inline-flex' ] ],
            'css' => [
                [
                    'property' => 'flex-direction',
                    'selector' => '&',
                ],
            ],
        ];
        
        $this->controls['dropdown_wrap'] = [
            'tab' => 'content',
            'group' => 'layout',
            'label' => esc_html__( 'Flex Wrap', 'bricks' ),
            'type' => 'select',
            'options' => [
                'nowrap' => esc_html__( 'No Wrap', 'bricks' ),
                'wrap' => esc_html__( 'Wrap', 'bricks' ),
                'wrap-reverse' => esc_html__( 'Wrap Reverse', 'bricks' ),
            ],
            'default' => 'nowrap',
            'required' => [ 'dropdown_display', '=', [ 'flex', 'inline-flex' ] ],
            'css' => [
                [
                    'property' => 'flex-wrap',
                    'selector' => '&',
                ],
            ],
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
    
    // Validate HTML tag
    private function validate_html_tag( $tag ) {
        // List of allowed HTML tags for security
        $allowed_tags = [
            'ul', 'ol', 'div', 'nav', 'section', 'aside', 'article', 'header', 'footer', 
            'main', 'menu', 'menuitem', 'details', 'summary', 'figure', 'figcaption',
            'dl', 'dt', 'dd', 'table', 'tbody', 'thead', 'tfoot', 'tr', 'td', 'th'
        ];
        
        // Clean the tag input
        $tag = strtolower( trim( $tag ) );
        $tag = preg_replace( '/[^a-z0-9]/', '', $tag ); // Remove non-alphanumeric characters
        
        // Return valid tag or default to 'ul'
        return in_array( $tag, $allowed_tags ) ? $tag : 'ul';
    }
    
    // Render element
    public function render() {
        $settings = $this->settings;
        
        // Get and validate HTML tag
        $html_tag = $this->validate_html_tag( $settings['html_tag'] ?? 'ul' );
        
        // Set dropdown content attributes
        $content_classes = [ 'dwc-dropdown-content' ];
        
        if ( ! empty( $settings['dropdown_position'] ) ) {
            $content_classes[] = 'dwc-dropdown-' . $settings['dropdown_position'];
        }
        
        $this->set_attribute( '_root', 'class', $content_classes );
        
        // Add role for accessibility based on tag
        if ( $html_tag === 'ul' || $html_tag === 'ol' ) {
            $this->set_attribute( '_root', 'role', 'menu' );
        } else if ( $html_tag === 'nav' ) {
            $this->set_attribute( '_root', 'role', 'navigation' );
        }
        
        echo "<{$html_tag} {$this->render_attributes( '_root' )}>";
        
        // Render nested nav items
        echo \Bricks\Frontend::render_children( $this );
        
        echo "</{$html_tag}>";
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
