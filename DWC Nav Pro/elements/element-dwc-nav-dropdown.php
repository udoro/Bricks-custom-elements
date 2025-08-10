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
    public $loopable = true; // Enable query loop support
    
    // Return element label
    public function get_label() {
        return esc_html__( 'DWC Nav Dropdown', 'bricks' );
    }
    
    // Return element keywords
    public function get_keywords() {
        return [ 'navigation', 'dropdown', 'submenu', 'loop', 'query', 'dwc' ];
    }
    
    // Set control groups
    public function set_control_groups() {
        $this->control_groups['content'] = [
            'title' => esc_html__( 'Content', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['query'] = [
            'title' => esc_html__( 'Query', 'bricks' ),
            'tab' => 'content',
        ];
        
        $this->control_groups['loop_content'] = [
            'title' => esc_html__( 'Loop Content', 'bricks' ),
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
        // Query Controls
        $this->controls['hasLoop'] = [
            'tab' => 'content',
            'group' => 'query',
            'label' => esc_html__( 'Use query loop', 'bricks' ),
            'type' => 'checkbox',
            'rerender' => true,
        ];

        $this->controls['query'] = [
            'tab' => 'content',
            'group' => 'query',
            'placeholder' => esc_html__( 'Query', 'bricks' ),
            'type' => 'query',
            'required' => [ 'hasLoop', '!=', '' ],
        ];
        
        // Loop Content Controls
        $this->controls['loop_text_source'] = [
            'tab' => 'content',
            'group' => 'loop_content',
            'label' => esc_html__( 'Dropdown Text Source', 'bricks' ),
            'type' => 'select',
            'options' => [
                'title' => esc_html__( 'Post Title', 'bricks' ),
                'custom_field' => esc_html__( 'Custom Field', 'bricks' ),
                'taxonomy' => esc_html__( 'Taxonomy Term', 'bricks' ),
                'static' => esc_html__( 'Static Text', 'bricks' ),
            ],
            'default' => 'title',
            'required' => [ 'hasLoop', '!=', '' ],
        ];
        
        $this->controls['loop_custom_field'] = [
            'tab' => 'content',
            'group' => 'loop_content',
            'label' => esc_html__( 'Custom Field Key', 'bricks' ),
            'type' => 'text',
            'required' => [ 
                [ 'hasLoop', '!=', '' ],
                [ 'loop_text_source', '=', 'custom_field' ],
            ],
        ];
        
        $this->controls['loop_taxonomy'] = [
            'tab' => 'content',
            'group' => 'loop_content',
            'label' => esc_html__( 'Taxonomy', 'bricks' ),
            'type' => 'select',
            'options' => $this->get_taxonomies_options(),
            'required' => [ 
                [ 'hasLoop', '!=', '' ],
                [ 'loop_text_source', '=', 'taxonomy' ],
            ],
        ];
        
        $this->controls['loop_static_text'] = [
            'tab' => 'content',
            'group' => 'loop_content',
            'label' => esc_html__( 'Static Text', 'bricks' ),
            'type' => 'text',
            'default' => esc_html__( 'Dropdown', 'bricks' ),
            'required' => [ 
                [ 'hasLoop', '!=', '' ],
                [ 'loop_text_source', '=', 'static' ],
            ],
        ];
        
        $this->controls['loop_children_query'] = [
            'tab' => 'content',
            'group' => 'loop_content',
            'label' => esc_html__( 'Dropdown Items Query', 'bricks' ),
            'description' => esc_html__( 'Query for dropdown content items (e.g., child pages, related posts)', 'bricks' ),
            'type' => 'query',
            'required' => [ 'hasLoop', '!=', '' ],
        ];
        
        // Content Controls (for non-loop mode)
        $this->controls['text'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Dropdown Text', 'bricks' ),
            'type' => 'text',
            'default' => esc_html__( 'Dropdown', 'bricks' ),
            'required' => [ 'hasLoop', '=', '' ],
        ];
        
        $this->controls['icon'] = [
            'tab' => 'content',
            'group' => 'content',
            'label' => esc_html__( 'Icon', 'bricks' ),
            'type' => 'icon',
            'required' => [ 'hasLoop', '=', '' ],
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
    
    // Get taxonomies options for select control
    private function get_taxonomies_options() {
        $taxonomies = get_taxonomies( [ 'public' => true ], 'objects' );
        $options = [];
        
        foreach ( $taxonomies as $taxonomy ) {
            $options[ $taxonomy->name ] = $taxonomy->label;
        }
        
        return $options;
    }
    
    // Render element
    public function render() {
        $element  = $this->element;
        $settings = $this->settings ?? [];
        $output   = '';
        
        // Bricks Query Loop (following exact Bricks Container pattern)
        if ( isset( $settings['hasLoop'] ) ) {
            $query = new \Bricks\Query( $element );
            
            // Render loop with custom template
            $loop_output = $query->render( [ $this, 'render_loop_item' ], compact( 'element' ) );
            
            echo $loop_output;
            
            // Destroy Query
            $query->destroy();
            unset( $query );
            
            return;
        }
        
        // Default: Single dropdown (non-loop mode)
        $this->render_single_dropdown( $settings );
    }
    
    // Render single dropdown item (called by Bricks Query for each loop item)
    public function render_loop_item() {
        $settings = $this->settings ?? [];
        
        // Get dropdown text based on source setting
        $dropdown_text = $this->get_loop_dropdown_text( $settings );
        
        // Render single dropdown with dynamic content
        $this->render_single_dropdown( $settings, $dropdown_text );
    }
    
   // Get dropdown text for loop item based on settings
private function get_loop_dropdown_text( $settings ) {
    $text_source = $settings['loop_text_source'] ?? 'title';
    
    switch ( $text_source ) {
        case 'title':
            return get_the_title();
            
        case 'custom_field':
            $field_key = $settings['loop_custom_field'] ?? '';
            
            // Handle dynamic data tags like {post_title}
            if ( strpos( $field_key, '{' ) !== false ) {
                return bricks_render_dynamic_data( $field_key, get_the_ID() );
            }
            
            // Handle regular custom field keys
            return $field_key ? get_field( $field_key ) : get_the_title();
            
        case 'taxonomy':
            $taxonomy = $settings['loop_taxonomy'] ?? 'category';
            $terms = get_the_terms( get_the_ID(), $taxonomy );
            return $terms && ! is_wp_error( $terms ) ? $terms[0]->name : get_the_title();
            
        case 'static':
            $static_text = $settings['loop_static_text'] ?? 'Dropdown';
            
            // Handle dynamic data tags in static text too
            if ( strpos( $static_text, '{' ) !== false ) {
                return bricks_render_dynamic_data( $static_text, get_the_ID() );
            }
            
            return $static_text;
            
        default:
            return get_the_title();
    }
}
    
    // Render single dropdown structure
    private function render_single_dropdown( $settings, $dropdown_text = null ) {
        // Use provided text or fallback to settings
        $text = $dropdown_text ?? ( $settings['text'] ?? 'Dropdown' );
        
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
        echo esc_html( $text );
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
        
        // Render dropdown content
        if ( isset( $settings['hasLoop'] ) && ! empty( $settings['loop_children_query'] ) ) {
            // Render loop-based dropdown content
            $this->render_loop_dropdown_content( $settings );
        } else {
            // Render nested children (manual dropdown content)
            echo \Bricks\Frontend::render_children( $this );
        }
        
        echo '</li>'; // End dropdown item
    }
    
    // Render dropdown content with loop-based items
    private function render_loop_dropdown_content( $settings ) {
        // Create a new query for dropdown content items
        $content_query_settings = $settings['loop_children_query'] ?? [];
        
        if ( empty( $content_query_settings ) ) {
            return;
        }
        
        // Create temporary element for content query
        $content_element = [
            'id' => $this->element['id'] . '-content',
            'name' => 'dwc-nav-dropdown-content',
            'settings' => [
                'hasLoop' => true,
                'query' => $content_query_settings,
            ]
        ];
        
        $content_query = new \Bricks\Query( $content_element );
        
        echo '<ul class="dwc-dropdown-content">';
        
        $content_output = $content_query->render( [ $this, 'render_content_loop_item' ], compact( 'content_element' ) );
        echo $content_output;
        
        echo '</ul>';
        
        $content_query->destroy();
        unset( $content_query );
    }
    
    // Render single dropdown content item
    public function render_content_loop_item() {
        $post_title = get_the_title();
        $post_url = get_permalink();
        $post_id = get_the_ID();
        
        // Allow filtering
        $loop_item_data = apply_filters( 'dwc_dropdown_content_loop_item_data', [
            'title' => $post_title,
            'url' => $post_url,
            'id' => $post_id,
        ], $post_id );
        
        echo '<li class="dwc-nav-item dwc-loop-item" data-post-id="' . esc_attr( $post_id ) . '">';
        echo '<a class="dwc-nav-link" href="' . esc_url( $loop_item_data['url'] ) . '">';
        echo '<span class="dwc-nav-text">' . esc_html( $loop_item_data['title'] ) . '</span>';
        echo '</a>';
        echo '</li>';
    }
    
    // Define nestable children structure - only allow dropdown content when not using loop
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
