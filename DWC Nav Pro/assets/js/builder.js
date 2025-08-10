/**
 * DWC Basic Nav - Builder JavaScript
 * Enhanced functionality for Bricks Builder editor
 */

(function($) {
    'use strict';

    // Builder-specific enhancements
    const DWCNavBuilder = {
        
        init: function() {
            this.setupBuilderPreview();
            this.setupElementControls();
            this.setupLivePreview();
            this.bindEvents();
        },

        setupBuilderPreview: function() {
            // Make mobile menu always visible in builder for editing
            $(document).on('bricks/setup/init', function() {
                $('.dwc-nav-container').each(function() {
                    const $container = $(this);
                    const $mobileMenu = $container.find('.dwc-mobile-menu');
                    
                    if ($mobileMenu.length) {
                        $mobileMenu.addClass('dwc-builder-preview');
                    }
                });
            });
        },

        setupElementControls: function() {
            // Custom control behaviors
            this.setupBreakpointPreview();
            this.setupMobileTypePreview();
            this.setupAnimationPreview();
        },

        setupBreakpointPreview: function() {
            // Preview breakpoint changes in real-time
            $(document).on('input change', '[data-control="mobile_breakpoint"]', function() {
                const breakpoint = $(this).val();
                const $container = $(this).closest('.bricks-panel').find('.dwc-nav-container');
                
                if ($container.length) {
                    $container.attr('data-mobile-breakpoint', breakpoint);
                    DWCNavBuilder.updateBreakpointDisplay($container, breakpoint);
                }
            });
        },

        setupMobileTypePreview: function() {
            // Preview mobile menu type changes
            $(document).on('change', '[data-control="mobile_menu_type"]', function() {
                const type = $(this).val();
                const $container = $(this).closest('.bricks-panel').find('.dwc-nav-container');
                
                if ($container.length) {
                    $container.attr('data-mobile-type', type);
                    DWCNavBuilder.updateMobileTypeDisplay($container, type);
                }
            });
        },

        setupAnimationPreview: function() {
            // Preview dropdown animations
            $(document).on('change', '[data-control="animation_type"]', function() {
                const animation = $(this).val();
                const $dropdown = $(this).closest('.bricks-element').find('.dwc-nav-dropdown');
                
                if ($dropdown.length) {
                    // Remove existing animation classes
                    $dropdown.removeClass(function(index, className) {
                        return (className.match(/(^|\s)dwc-anim-\S+/g) || []).join(' ');
                    });
                    
                    // Add new animation class
                    if (animation && animation !== 'none') {
                        $dropdown.addClass('dwc-anim-' + animation);
                    }
                }
            });
        },

        updateBreakpointDisplay: function($container, breakpoint) {
            // Add visual indicator for breakpoint in builder
            const $indicator = $container.find('.dwc-breakpoint-indicator');
            
            if ($indicator.length === 0) {
                $container.append('<div class="dwc-breakpoint-indicator">Mobile: ' + breakpoint + '</div>');
            } else {
                $indicator.text('Mobile: ' + breakpoint);
            }
        },

        updateMobileTypeDisplay: function($container, type) {
            // Update mobile menu preview based on type
            const $mobileMenu = $container.find('.dwc-mobile-menu');
            
            // Remove existing type classes
            $mobileMenu.removeClass(function(index, className) {
                return (className.match(/(^|\s)dwc-type-\S+/g) || []).join(' ');
            });
            
            // Add new type class
            $mobileMenu.addClass('dwc-type-' + type);
            
            // Update content positioning for preview
            const $content = $mobileMenu.find('.dwc-mobile-menu-content');
            
            switch(type) {
                case 'overlay':
                    $content.css({
                        'position': 'relative',
                        'transform': 'none',
                        'border-radius': '8px',
                        'max-width': '400px',
                        'margin': '20px auto'
                    });
                    break;
                    
                case 'dropdown':
                    $content.css({
                        'position': 'static',
                        'transform': 'none',
                        'width': '100%',
                        'margin': '0'
                    });
                    break;
                    
                case 'slide':
                    $content.css({
                        'position': 'relative',
                        'transform': 'none',
                        'max-width': '300px'
                    });
                    break;
            }
        },

        setupLivePreview: function() {
            // Live preview of navigation changes
            $(document).on('input', '[data-control="nav_gap"]', function() {
                const gap = $(this).val();
                const unit = $(this).next('.unit-selector').val() || 'px';
                const $navList = $(this).closest('.bricks-element').find('.dwc-nav-list');
                
                if ($navList.length) {
                    $navList.css('gap', gap + unit);
                }
            });

            // Live preview of icon position changes
            $(document).on('change', '[data-control="icon_position"]', function() {
                const position = $(this).val();
                const $navLink = $(this).closest('.bricks-element').find('.dwc-nav-link');
                
                if ($navLink.length) {
                    // Remove existing position classes
                    $navLink.removeClass('dwc-icon-left dwc-icon-right dwc-icon-top dwc-icon-bottom');
                    
                    // Add new position class
                    if (position) {
                        $navLink.addClass('dwc-icon-' + position);
                    }
                }
            });

            // Live preview of toggle animations
            $(document).on('change', '[data-control="animation_type"]', function() {
                if ($(this).closest('[data-element="dwc-nav-toggle"]').length) {
                    const animation = $(this).val();
                    const $toggle = $(this).closest('.bricks-element').find('.dwc-mobile-toggle');
                    
                    if ($toggle.length) {
                        // Remove existing animation classes
                        $toggle.removeClass(function(index, className) {
                            return (className.match(/(^|\s)dwc-anim-\S+/g) || []).join(' ');
                        });
                        
                        // Add new animation class
                        if (animation && animation !== 'none') {
                            $toggle.addClass('dwc-anim-' + animation);
                        }
                    }
                }
            });
        },

        bindEvents: function() {
            // Builder-specific event handlers
            $(document).on('click', '.dwc-nav-container .dwc-mobile-toggle', function(e) {
                if (window.bricksData && window.bricksData.mode === 'builder') {
                    e.preventDefault();
                    
                    // Toggle for preview only
                    const $container = $(this).closest('.dwc-nav-container');
                    const $mobileMenu = $container.find('.dwc-mobile-menu');
                    
                    $mobileMenu.toggleClass('dwc-active');
                    $(this).toggleClass('dwc-active');
                }
            });

            // Prevent dropdown hover effects in builder
            $(document).on('mouseenter mouseleave', '.dwc-has-dropdown', function(e) {
                if (window.bricksData && window.bricksData.mode === 'builder') {
                    e.stopPropagation();
                }
            });

            // Custom builder commands
            this.setupBuilderCommands();
        },

        setupBuilderCommands: function() {
            // Add custom builder commands for navigation elements
            if (typeof window.wp !== 'undefined' && window.wp.hooks) {
                // Hook into Bricks element rendering
                wp.hooks.addAction('bricks.element.render', 'dwc-nav', function(elementData) {
                    if (elementData.name && elementData.name.startsWith('dwc-nav-')) {
                        DWCNavBuilder.onElementRender(elementData);
                    }
                });

                // Hook into Bricks element settings change
                wp.hooks.addAction('bricks.setting.change', 'dwc-nav', function(setting, value, elementId) {
                    DWCNavBuilder.onSettingChange(setting, value, elementId);
                });
            }

            // Add builder toolbar buttons
            this.addBuilderToolbarButtons();
        },

        onElementRender: function(elementData) {
            // Handle element rendering in builder
            setTimeout(function() {
                const $element = $('[data-element-id="' + elementData.id + '"]');
                
                if ($element.length) {
                    DWCNavBuilder.enhanceBuilderElement($element, elementData);
                }
            }, 100);
        },

        onSettingChange: function(setting, value, elementId) {
            // Handle real-time setting changes
            const $element = $('[data-element-id="' + elementId + '"]');
            
            if ($element.length) {
                switch(setting) {
                    case 'mobile_breakpoint':
                        $element.attr('data-mobile-breakpoint', value);
                        DWCNavBuilder.updateBreakpointDisplay($element, value);
                        break;
                        
                    case 'mobile_menu_type':
                        $element.attr('data-mobile-type', value);
                        DWCNavBuilder.updateMobileTypeDisplay($element, value);
                        break;
                        
                    case 'nav_direction':
                        $element.removeClass('dwc-nav-horizontal dwc-nav-vertical')
                                .addClass('dwc-nav-' + value);
                        break;
                }
            }
        },

        enhanceBuilderElement: function($element, elementData) {
            // Add builder-specific enhancements to elements
            if (elementData.name === 'dwc-nav-container') {
                this.enhanceNavContainer($element);
            } else if (elementData.name === 'dwc-nav-dropdown') {
                this.enhanceDropdown($element);
            } else if (elementData.name === 'dwc-nav-toggle') {
                this.enhanceToggle($element);
            }
        },

        enhanceNavContainer: function($container) {
            // Add container-specific builder enhancements
            if (!$container.find('.dwc-builder-controls').length) {
                const controls = `
                    <div class="dwc-builder-controls">
                        <button class="dwc-preview-mobile" title="Preview Mobile">📱</button>
                        <button class="dwc-preview-desktop" title="Preview Desktop">🖥️</button>
                    </div>
                `;
                $container.prepend(controls);
                
                // Bind control events
                $container.find('.dwc-preview-mobile').on('click', function() {
                    DWCNavBuilder.previewMobile($container);
                });
                
                $container.find('.dwc-preview-desktop').on('click', function() {
                    DWCNavBuilder.previewDesktop($container);
                });
            }
        },

        enhanceDropdown: function($dropdown) {
            // Add dropdown-specific builder enhancements
            $dropdown.css({
                'position': 'relative',
                'opacity': '1',
                'visibility': 'visible',
                'transform': 'none',
                'display': 'block'
            });
            
            // Add builder indicator
            if (!$dropdown.find('.dwc-dropdown-indicator').length) {
                $dropdown.prepend('<div class="dwc-dropdown-indicator">📋 Dropdown Content</div>');
            }
        },

        enhanceToggle: function($toggle) {
            // Add toggle-specific builder enhancements
            $toggle.css('display', 'flex');
            
            // Add click handler for builder preview
            $toggle.off('click.builder').on('click.builder', function(e) {
                e.preventDefault();
                $(this).toggleClass('dwc-active');
                
                // Animate hamburger lines for preview
                if ($(this).hasClass('dwc-toggle-hamburger')) {
                    DWCNavBuilder.animateHamburger($(this));
                }
            });
        },

        animateHamburger: function($toggle) {
            // Animate hamburger for builder preview
            const $lines = $toggle.find('.dwc-toggle-line');
            const isActive = $toggle.hasClass('dwc-active');
            
            if (isActive) {
                // Animate to X
                $lines.eq(0).css('transform', 'rotate(45deg) translate(6px, 6px)');
                $lines.eq(1).css('opacity', '0');
                $lines.eq(2).css('transform', 'rotate(-45deg) translate(6px, -6px)');
            } else {
                // Animate back to hamburger
                $lines.css({
                    'transform': 'none',
                    'opacity': '1'
                });
            }
        },

        previewMobile: function($container) {
            // Force mobile view in builder
            $container.addClass('dwc-builder-mobile-preview');
            $container.find('.dwc-desktop-nav').hide();
            $container.find('.dwc-mobile-toggle').show();
            $container.find('.dwc-mobile-menu').show();
            
            this.showPreviewMessage('Mobile view activated', 'info');
        },

        previewDesktop: function($container) {
            // Force desktop view in builder
            $container.removeClass('dwc-builder-mobile-preview');
            $container.find('.dwc-desktop-nav').show();
            $container.find('.dwc-mobile-toggle').hide();
            $container.find('.dwc-mobile-menu').hide();
            
            this.showPreviewMessage('Desktop view activated', 'info');
        },

        addBuilderToolbarButtons: function() {
            // Add custom buttons to Bricks toolbar
            $(document).on('bricks/toolbar/init', function() {
                // Add navigation-specific toolbar buttons
                if ($('.dwc-nav-container').length) {
                    const toolbarButtons = `
                        <div class="dwc-toolbar-group">
                            <button class="dwc-toolbar-btn" data-action="preview-mobile">
                                <i class="ti-mobile"></i> Mobile
                            </button>
                            <button class="dwc-toolbar-btn" data-action="preview-desktop">
                                <i class="ti-desktop"></i> Desktop
                            </button>
                            <button class="dwc-toolbar-btn" data-action="test-navigation">
                                <i class="ti-eye"></i> Test Nav
                            </button>
                        </div>
                    `;
                    
                    $('.bricks-toolbar').append(toolbarButtons);
                }
            });

            // Bind toolbar button events
            $(document).on('click', '.dwc-toolbar-btn', function() {
                const action = $(this).data('action');
                DWCNavBuilder.handleToolbarAction(action);
            });
        },

        handleToolbarAction: function(action) {
            switch(action) {
                case 'preview-mobile':
                    $('.dwc-nav-container').each(function() {
                        DWCNavBuilder.previewMobile($(this));
                    });
                    break;
                    
                case 'preview-desktop':
                    $('.dwc-nav-container').each(function() {
                        DWCNavBuilder.previewDesktop($(this));
                    });
                    break;
                    
                case 'test-navigation':
                    DWCNavBuilder.testNavigation();
                    break;
            }
        },

        testNavigation: function() {
            // Test navigation functionality in builder
            const $containers = $('.dwc-nav-container');
            
            if ($containers.length === 0) {
                this.showPreviewMessage('No navigation elements found', 'warning');
                return;
            }

            let issues = [];
            
            $containers.each(function() {
                const $container = $(this);
                const containerId = $container.attr('data-element-id') || 'Unknown';
                
                // Check for mobile toggle
                if (!$container.find('.dwc-mobile-toggle').length) {
                    issues.push(`Container ${containerId}: Missing mobile toggle`);
                }
                
                // Check for navigation items
                if (!$container.find('.dwc-nav-item').length) {
                    issues.push(`Container ${containerId}: No navigation items found`);
                }
                
                // Check dropdown structure
                $container.find('.dwc-has-dropdown').each(function() {
                    if (!$(this).find('.dwc-nav-dropdown').length) {
                        issues.push(`Container ${containerId}: Dropdown item missing dropdown element`);
                    }
                });
            });

            if (issues.length === 0) {
                this.showPreviewMessage('✅ Navigation structure looks good!', 'success');
            } else {
                this.showPreviewMessage('⚠️ Issues found:\n' + issues.join('\n'), 'warning');
            }
        },

        showPreviewMessage: function(message, type) {
            // Show builder message
            const messageClass = 'dwc-builder-message dwc-' + type;
            const $message = $('<div class="' + messageClass + '">' + message + '</div>');
            
            $('body').append($message);
            
            setTimeout(function() {
                $message.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 3000);
        },

        // Utility methods
        debounce: function(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = function() {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }
    };

    // Initialize when document is ready
    $(document).ready(function() {
        // Only run in Bricks builder
        if (window.bricksData && window.bricksData.mode === 'builder') {
            DWCNavBuilder.init();
        }
    });

    // Export for external access
    window.DWCNavBuilder = DWCNavBuilder;

})(jQuery);