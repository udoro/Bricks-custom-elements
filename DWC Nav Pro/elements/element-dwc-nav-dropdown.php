<?php
// elements/element-dwc-nav-dropdown.php
if ( ! defined( 'ABSPATH' ) ) exit;

class DWC_Element_Nav_Dropdown extends \Bricks\Element {
    
    // Element properties
    public $category = 'dwc-navigation';
    public $name = 'dwc-nav-dropdown';
    public $icon = 'ti-layout-list-post';
    public $css_selector = '.dwc-nav-dropdown';
    public $scripts = [];
    public $nestable = true; // Allow dropdown content as children
    
    // Return element label
    public function get_label() {
        return esc_html__( 'DWC Nav Dropdown', 'bricks' );
    }
    
    // Return element keywords
    public function get_keywords() {
        return [ 'navigation', 'dropdown', 'submenu', 'dwc' ];
    }
    
    // Set control groups
    public function set_control_groups() {
        $this->control_groups['content'] = [
            'title' => esc_html__( 'Content', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['animation'] = [
            'title' => esc_html__( 'Animation', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['toggle_style'] = [
            'title' => esc_html__( 'Toggle Style', 'bricks' ),
            'tab' => 'style',
        ];
    }
    
    // Set element controls
    public function set_controls() {
        // Content Controls
        $this->controls['text'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Dropdown Text', 'bricks' ),
            'type' => 'text',
            'default' => esc_html__( 'Dropdown', 'bricks' ),
        ];
        
        $this->controls['icon'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Icon', 'bricks' ),
            'type' => 'icon',
        ];
        
        // Animation Controls
        $this->controls['animation_type'] = [
            'tab' => 'content',
            'group' => 'animation',
            'label' => esc_html__( 'Animation Type', 'bricks' ),
            'type' => 'select',
            'options' => [
                'fade' => esc_html__( 'Fade', 'bricks' ),
                'slide-down' => esc_html__( 'Slide Down', 'bricks' ),
                'slide-up' => esc_html__( 'Slide Up', 'bricks' ),
                'scale' => esc_html__( 'Scale', 'bricks' ),
                'none' => esc_html__( 'None', 'bricks' ),
            ],
            'default' => 'fade',
        ];
        
        $this->controls['animation_duration'] = [
            'tab' => 'content',
            'group' => 'animation',
            'label' => esc_html__( 'Animation Duration (ms)', 'bricks' ),
            'type' => 'number',
            'default' => 300,
            'min' => 0,
            'max' => 2000,
            'step' => 50,
        ];
        
        $this->controls['hover_delay'] = [
            'tab' => 'content',
            'group' => 'animation',
            'label' => esc_html__( 'Hover Delay (ms)', 'bricks' ),
            'type' => 'number',
            'default' => 0,
            'min' => 0,
            'max' => 1000,
            'step' => 50,
            'description' => esc_html__( 'Delay before showing dropdown on hover', 'bricks' ),
        ];
        
        // Toggle Style Controls
        $this->controls['toggle_typography'] = [
            'tab' => 'style',
            'group' => 'toggle_style',
            'label' => esc_html__( 'Typography', 'bricks' ),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'font',
                    'selector' => '.dwc-nav-text',
                ],
            ],
        ];
        
        $this->controls['toggle_color'] = [
            'tab' => 'style',
            'group' => 'toggle_style',
            'label' => esc_html__( 'Text Color', 'bricks' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '.dwc-nav-text',
                ],
            ],
        ];
        
        $this->controls['toggle_background'] = [
            'tab' => 'style',
            'group' => 'toggle_style',
            'label' => esc_html__( 'Background', 'bricks' ),
            'type' => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '.dwc-submenu-toggle',
                ],
            ],
        ];
        
        $this->controls['toggle_padding'] = [
            'tab' => 'style',
            'group' => 'toggle_style',
            'label' => esc_html__( 'Padding', 'bricks' ),
            'type' => 'spacing',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '.dwc-submenu-toggle',
                ],
            ],
        ];
        
        $this->controls['toggle_border'] = [
            'tab' => 'style',
            'group' => 'toggle_style',
            'label' => esc_html__( 'Border', 'bricks' ),
            'type' => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '.dwc-submenu-toggle',
                ],
            ],
        ];
    }
    
    // Render element
    public function render() {
        $settings = $this->settings;
        
        // Set dropdown attributes
        $dropdown_classes = [ 'dwc-nav-dropdown' ];
        
        if ( ! empty( $settings['animation_type'] ) ) {
            $dropdown_classes[] = 'dwc-anim-' . $settings['animation_type'];
        }
        
        $this->set_attribute( '_root', 'class', $dropdown_classes );
        $this->set_attribute( '_root', 'data-animation-duration', $settings['animation_duration'] ?? 300 );
        $this->set_attribute( '_root', 'data-hover-delay', $settings['hover_delay'] ?? 0 );
        
        echo "<li {$this->render_attributes( '_root' )}>";
        
        // Toggle wrapper
        echo '<div class="dwc-submenu-toggle">';
        
        // Text span with optional icon
        echo '<span class="dwc-nav-text">';
        if ( ! empty( $settings['icon'] ) ) {
            echo '<i class="' . esc_attr( $settings['icon']['icon'] ?? $settings['icon'] ) . '"></i>';
        }
        echo esc_html( $settings['text'] ?? 'Dropdown' );
        echo '</span>';
        
        // Toggle button
        echo '<button class="dwc-dropdown-toggle" aria-expanded="false" aria-label="Toggle dropdown">';
        echo '<span class="dwc-dropdown-indicator">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12" fill="none">';
        echo '<path d="M1.50002 4L6.00002 8L10.5 4" stroke-width="1.5" stroke="currentcolor"></path>';
        echo '</svg>';
        echo '</span>';
        echo '</button>';
        
        echo '</div>'; // End .dwc-submenu-toggle
        
        // Render dropdown content children (dwc-nav-dropdown-content element)
        echo \Bricks\Frontend::render_children( $this );
        
        echo '</li>'; // End dropdown item
    }
    
    // Define nestable children structure - only allow dropdown content
    public function get_nestable_children() {
        return [
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
        ];
    }
}