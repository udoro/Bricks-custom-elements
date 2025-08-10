<?php
// elements/element-dwc-nav-item.php
if ( ! defined( 'ABSPATH' ) ) exit;

class DWC_Element_Nav_Item extends \Bricks\Element {
    
    // Element properties
    public $category = 'dwc-navigation';
    public $name = 'dwc-nav-item';
    public $icon = 'ti-link';
    public $css_selector = '.dwc-nav-item';
    public $scripts = [];
    public $nestable = false; // Not nestable - no children allowed
    
    // Return element label
    public function get_label() {
        return esc_html__( 'DWC Nav Item', 'bricks' );
    }
    
    // Return element keywords
    public function get_keywords() {
        return [ 'navigation', 'nav', 'menu', 'item', 'link', 'dwc' ];
    }
    
    // Set control groups
    public function set_control_groups() {
        $this->control_groups['content'] = [
            'title' => esc_html__( 'Content', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['link'] = [
            'title' => esc_html__( 'Link Settings', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['icon'] = [
            'title' => esc_html__( 'Icon', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['style'] = [
            'title' => esc_html__( 'Style', 'bricks' ),
            'tab' => 'style',
        ];
        
        $this->control_groups['hover'] = [
            'title' => esc_html__( 'Hover Effects', 'bricks' ),
            'tab' => 'style',
        ];
    }
    
    // Set element controls
    public function set_controls() {
        // Content Controls
        $this->controls['text'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Text', 'bricks' ),
            'type' => 'text',
            'default' => esc_html__( 'Menu Item', 'bricks' ),
        ];
        
        $this->controls['description'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Description', 'bricks' ),
            'type' => 'text',
            'placeholder' => esc_html__( 'Optional description', 'bricks' ),
        ];
        
        // Link Controls
        $this->controls['link'] = [
            'tab' => 'content',
            'group' => 'link',
            'label' => esc_html__( 'Link', 'bricks' ),
            'type' => 'link',
            'pasteStyles' => false,
        ];
        
        $this->controls['active_item'] = [
            'tab' => 'content',
            'group' => 'link',
            'label' => esc_html__( 'Mark as Active', 'bricks' ),
            'type' => 'checkbox',
            'description' => esc_html__( 'Mark this item as the current/active page', 'bricks' ),
        ];
        
        // Icon Controls
        $this->controls['icon'] = [
            'tab' => 'content',
            'group' => 'icon',
            'label' => esc_html__( 'Icon', 'bricks' ),
            'type' => 'icon',
        ];
        
        $this->controls['icon_position'] = [
            'tab' => 'content',
            'group' => 'icon',
            'label' => esc_html__( 'Icon Position', 'bricks' ),
            'type' => 'select',
            'options' => [
                'left' => esc_html__( 'Left', 'bricks' ),
                'right' => esc_html__( 'Right', 'bricks' ),
                'top' => esc_html__( 'Top', 'bricks' ),
                'bottom' => esc_html__( 'Bottom', 'bricks' ),
            ],
            'default' => 'left',
            'required' => [ 'icon', '!=', '' ],
        ];
        
        $this->controls['icon_gap'] = [
            'tab' => 'content',
            'group' => 'icon',
            'label' => esc_html__( 'Icon Gap', 'bricks' ),
            'type' => 'number',
            'units' => true,
            'default' => '8px',
            'required' => [ 'icon', '!=', '' ],
            'css' => [
                [
                    'property' => 'gap',
                    'selector' => '.dwc-nav-link',
                ],
            ],
        ];
        
        // Style Controls
        $this->controls['typography'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Typography', 'bricks' ),
            'type' => 'typography',
            'css' => [
                [
                    'property' => 'font',
                    'selector' => '.dwc-nav-link',
                ],
            ],
        ];
        
        $this->controls['text_color'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Text Color', 'bricks' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '.dwc-nav-link',
                ],
            ],
        ];
        
        $this->controls['background'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Background', 'bricks' ),
            'type' => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '.dwc-nav-link',
                ],
            ],
        ];
        
        $this->controls['padding'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Padding', 'bricks' ),
            'type' => 'spacing',
            'css' => [
                [
                    'property' => 'padding',
                    'selector' => '.dwc-nav-link',
                ],
            ],
        ];
        
        $this->controls['border'] = [
            'tab' => 'style',
            'group' => 'style',
            'label' => esc_html__( 'Border', 'bricks' ),
            'type' => 'border',
            'css' => [
                [
                    'property' => 'border',
                    'selector' => '.dwc-nav-link',
                ],
            ],
        ];
        
        // Hover Effects
        $this->controls['hover_color'] = [
            'tab' => 'style',
            'group' => 'hover',
            'label' => esc_html__( 'Hover Text Color', 'bricks' ),
            'type' => 'color',
            'css' => [
                [
                    'property' => 'color',
                    'selector' => '.dwc-nav-link:hover',
                ],
            ],
        ];
        
        $this->controls['hover_background'] = [
            'tab' => 'style',
            'group' => 'hover',
            'label' => esc_html__( 'Hover Background', 'bricks' ),
            'type' => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '.dwc-nav-link:hover',
                ],
            ],
        ];
        
        $this->controls['hover_transform'] = [
            'tab' => 'style',
            'group' => 'hover',
            'label' => esc_html__( 'Hover Transform', 'bricks' ),
            'type' => 'transform',
            'css' => [
                [
                    'property' => 'transform',
                    'selector' => '.dwc-nav-link:hover',
                ],
            ],
        ];
        
        $this->controls['active_styles'] = [
            'tab' => 'style',
            'group' => 'hover',
            'label' => esc_html__( 'Active Item Styles', 'bricks' ),
            'type' => 'background',
            'css' => [
                [
                    'property' => 'background',
                    'selector' => '&.dwc-nav-active .dwc-nav-link',
                ],
            ],
        ];
    }
    
    // Render element
    public function render() {
        $settings = $this->settings;
        
        // Set item attributes
        $item_classes = [ 'dwc-nav-item' ];
        
        if ( ! empty( $settings['active_item'] ) ) {
            $item_classes[] = 'dwc-nav-active';
        }
        
        $this->set_attribute( '_root', 'class', $item_classes );
        
        echo "<li {$this->render_attributes( '_root' )}>";
        
        // Regular nav item structure: single link only
        $link_classes = [ 'dwc-nav-link' ];
        
        if ( ! empty( $settings['icon_position'] ) ) {
            $link_classes[] = 'dwc-icon-' . $settings['icon_position'];
        }
        
        $this->set_attribute( 'link', 'class', $link_classes );
        
        // Set link URL and attributes
        if ( ! empty( $settings['link'] ) ) {
            $this->set_link_attributes( 'link', $settings['link'] );
        } else {
            $this->set_attribute( 'link', 'href', '#' );
        }
        
        echo "<a {$this->render_attributes( 'link' )}>";
        
        // Render icon
        if ( ! empty( $settings['icon'] ) ) {
            echo '<i class="' . esc_attr( $settings['icon']['icon'] ?? $settings['icon'] ) . '"></i>';
        }
        
        // Render text content
        echo '<span class="dwc-nav-text">';
        if ( ! empty( $settings['text'] ) ) {
            echo esc_html( $settings['text'] );
        }
        
        if ( ! empty( $settings['description'] ) ) {
            echo '<span class="dwc-nav-description">' . esc_html( $settings['description'] ) . '</span>';
        }
        echo '</span>';
        
        echo '</a>';
        echo '</li>';
    }
}