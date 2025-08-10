/**
 * DWC Basic Nav - Frontend JavaScript (Vanilla JS)
 */

(function() {
    'use strict';

    // Main DWC Navigation Class
    class DWCNavigation {
        constructor(element) {
            this.element = element;
            this.mobileBreakpoint = element.dataset.mobileBreakpoint || '768px';
            this.mobileType = element.dataset.mobileType || 'overlay';
            this.slideDirection = element.dataset.slideDirection || 'left';
            
            this.mobileToggle = element.querySelector('.dwc-mobile-toggle');
            this.mobileMenu = element.querySelector('.dwc-mobile-menu');
            this.desktopNav = element.querySelector('.dwc-desktop-nav');
            
            this.isMenuOpen = false;
            this.dropdownTimeouts = new Map();
            
            this.init();
        }

        init() {
            this.setupMobileToggle();
            this.setupDropdowns();
            this.setupKeyboardNavigation();
            this.setupClickOutside();
            this.setupBreakpointCheck();
            this.setupMobileDropdowns();
            
            // Close menu on window resize
            window.addEventListener('resize', () => {
                if (this.isMenuOpen && this.isMobileView()) {
                    this.closeMobileMenu();
                }
            });
        }

        // Mobile Toggle Setup
        setupMobileToggle() {
            if (!this.mobileToggle) return;

            this.mobileToggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                this.toggleMobileMenu();
            });
        }

        toggleMobileMenu() {
            if (this.isMenuOpen) {
                this.closeMobileMenu();
            } else {
                this.openMobileMenu();
            }
        }

        openMobileMenu() {
            if (!this.mobileMenu) return;

            this.isMenuOpen = true;
            this.mobileToggle?.classList.add('dwc-active');
            this.mobileMenu.classList.add('dwc-active');
            this.element.classList.add('dwc-menu-open');
            
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
            
            // Focus management
            this.trapFocus();
            
            // Trigger custom event
            this.element.dispatchEvent(new CustomEvent('dwc:menuOpen'));
        }

        closeMobileMenu() {
            if (!this.mobileMenu) return;

            this.isMenuOpen = false;
            this.mobileToggle?.classList.remove('dwc-active');
            this.mobileMenu.classList.remove('dwc-active');
            this.element.classList.remove('dwc-menu-open');
            
            // Restore body scroll
            document.body.style.overflow = '';
            
            // Close all mobile dropdowns
            this.closeAllMobileDropdowns();
            
            // Return focus to toggle
            if (this.mobileToggle) {
                this.mobileToggle.focus();
            }
            
            // Trigger custom event
            this.element.dispatchEvent(new CustomEvent('dwc:menuClose'));
        }

        // Desktop Dropdown Setup
        setupDropdowns() {
            const dropdownItems = this.element.querySelectorAll('.dwc-has-dropdown');
            
            dropdownItems.forEach(item => {
                const dropdown = item.querySelector('.dwc-nav-dropdown');
                if (!dropdown) return;

                const delay = parseInt(dropdown.dataset.hoverDelay) || 0;
                const duration = parseInt(dropdown.dataset.animationDuration) || 300;

                // Mouse enter
                item.addEventListener('mouseenter', () => {
                    if (this.isMobileView()) return;
                    
                    this.clearDropdownTimeout(item);
                    this.setDropdownTimeout(item, () => {
                        this.openDropdown(item);
                    }, delay);
                });

                // Mouse leave
                item.addEventListener('mouseleave', () => {
                    if (this.isMobileView()) return;
                    
                    this.clearDropdownTimeout(item);
                    this.setDropdownTimeout(item, () => {
                        this.closeDropdown(item);
                    }, 100);
                });

                // Keyboard navigation
                const link = item.querySelector('.dwc-nav-link');
                if (link) {
                    link.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            if (this.isMobileView()) return;
                            
                            e.preventDefault();
                            this.toggleDropdown(item);
                        }
                    });
                }
            });
        }

        openDropdown(item) {
            const dropdown = item.querySelector('.dwc-nav-dropdown');
            if (!dropdown) return;

            // Close other dropdowns first
            this.closeOtherDropdowns(item);

            item.classList.add('dwc-dropdown-open');
            dropdown.style.display = 'block';
            
            // Force reflow for animation
            dropdown.offsetHeight;
            
            dropdown.style.opacity = '1';
            dropdown.style.visibility = 'visible';
            dropdown.style.transform = 'translateY(0)';

            // Set ARIA attributes
            const link = item.querySelector('.dwc-nav-link');
            if (link) {
                link.setAttribute('aria-expanded', 'true');
            }
        }

        closeDropdown(item) {
            const dropdown = item.querySelector('.dwc-nav-dropdown');
            if (!dropdown) return;

            item.classList.remove('dwc-dropdown-open');
            
            dropdown.style.opacity = '0';
            dropdown.style.visibility = 'hidden';
            dropdown.style.transform = 'translateY(-10px)';

            // Hide after animation
            setTimeout(() => {
                if (!item.classList.contains('dwc-dropdown-open')) {
                    dropdown.style.display = 'none';
                }
            }, 300);

            // Set ARIA attributes
            const link = item.querySelector('.dwc-nav-link');
            if (link) {
                link.setAttribute('aria-expanded', 'false');
            }
        }

        toggleDropdown(item) {
            if (item.classList.contains('dwc-dropdown-open')) {
                this.closeDropdown(item);
            } else {
                this.openDropdown(item);
            }
        }

        closeOtherDropdowns(currentItem) {
            const dropdownItems = this.element.querySelectorAll('.dwc-has-dropdown');
            dropdownItems.forEach(item => {
                if (item !== currentItem && item.classList.contains('dwc-dropdown-open')) {
                    this.closeDropdown(item);
                }
            });
        }

        // Mobile Dropdown Setup
        setupMobileDropdowns() {
            const mobileDropdownItems = this.mobileMenu?.querySelectorAll('.dwc-has-dropdown');
            
            if (!mobileDropdownItems) return;

            mobileDropdownItems.forEach(item => {
                const link = item.querySelector('.dwc-nav-link');
                const dropdown = item.querySelector('.dwc-nav-dropdown');
                
                if (!link || !dropdown) return;

                // Clone the link to remove href for mobile
                const mobileLink = link.cloneNode(true);
                mobileLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.toggleMobileDropdown(item);
                });
                
                link.parentNode.replaceChild(mobileLink, link);
            });
        }

        toggleMobileDropdown(item) {
            const isOpen = item.classList.contains('dwc-dropdown-open');
            
            if (isOpen) {
                this.closeMobileDropdown(item);
            } else {
                this.openMobileDropdown(item);
            }
        }

        openMobileDropdown(item) {
            item.classList.add('dwc-dropdown-open');
            
            const dropdown = item.querySelector('.dwc-nav-dropdown');
            if (dropdown) {
                dropdown.style.maxHeight = dropdown.scrollHeight + 'px';
            }
        }

        closeMobileDropdown(item) {
            item.classList.remove('dwc-dropdown-open');
            
            const dropdown = item.querySelector('.dwc-nav-dropdown');
            if (dropdown) {
                dropdown.style.maxHeight = '0';
            }
        }

        closeAllMobileDropdowns() {
            const mobileDropdownItems = this.mobileMenu?.querySelectorAll('.dwc-has-dropdown');
            if (mobileDropdownItems) {
                mobileDropdownItems.forEach(item => {
                    this.closeMobileDropdown(item);
                });
            }
        }

        // Keyboard Navigation
        setupKeyboardNavigation() {
            this.element.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (this.isMenuOpen) {
                        this.closeMobileMenu();
                    } else {
                        // Close all dropdowns
                        this.closeAllDropdowns();
                    }
                }
            });
        }

        closeAllDropdowns() {
            const dropdownItems = this.element.querySelectorAll('.dwc-has-dropdown');
            dropdownItems.forEach(item => {
                this.closeDropdown(item);
            });
        }

        // Click Outside
        setupClickOutside() {
            document.addEventListener('click', (e) => {
                // Close mobile menu if clicked outside
                if (this.isMenuOpen && 
                    !this.element.contains(e.target) && 
                    !e.target.closest('.dwc-mobile-menu')) {
                    this.closeMobileMenu();
                }

                // Close dropdowns if clicked outside
                if (!this.element.contains(e.target)) {
                    this.closeAllDropdowns();
                }
            });
        }

        // Focus Trap for Mobile Menu
        trapFocus() {
            if (!this.isMenuOpen || !this.mobileMenu) return;

            const focusableElements = this.mobileMenu.querySelectorAll(
                'a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])'
            );

            if (focusableElements.length === 0) return;

            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];

            // Focus first element
            firstElement.focus();

            this.mobileMenu.addEventListener('keydown', (e) => {
                if (e.key !== 'Tab') return;

                if (e.shiftKey) {
                    if (document.activeElement === firstElement) {
                        e.preventDefault();
                        lastElement.focus();
                    }
                } else {
                    if (document.activeElement === lastElement) {
                        e.preventDefault();
                        firstElement.focus();
                    }
                }
            });
        }

        // Utility Methods
        isMobileView() {
            return window.matchMedia(`(max-width: ${this.mobileBreakpoint})`).matches;
        }

        setupBreakpointCheck() {
            const mediaQuery = window.matchMedia(`(max-width: ${this.mobileBreakpoint})`);
            
            const handleBreakpointChange = (e) => {
                if (!e.matches && this.isMenuOpen) {
                    // Switched to desktop view, close mobile menu
                    this.closeMobileMenu();
                }
            };

            mediaQuery.addListener(handleBreakpointChange);
            
            // Check initial state
            handleBreakpointChange(mediaQuery);
        }

        setDropdownTimeout(item, callback, delay) {
            this.dropdownTimeouts.set(item, setTimeout(callback, delay));
        }

        clearDropdownTimeout(item) {
            const timeout = this.dropdownTimeouts.get(item);
            if (timeout) {
                clearTimeout(timeout);
                this.dropdownTimeouts.delete(item);
            }
        }

        // Public API
        destroy() {
            // Clean up event listeners and timeouts
            this.dropdownTimeouts.forEach(timeout => clearTimeout(timeout));
            this.dropdownTimeouts.clear();
            
            // Restore body scroll
            if (this.isMenuOpen) {
                document.body.style.overflow = '';
            }
        }
    }

    // Initialize Navigation Elements
    function initDWCNavigation() {
        const navElements = document.querySelectorAll('.dwc-nav-container');
        const instances = [];

        navElements.forEach(element => {
            const instance = new DWCNavigation(element);
            instances.push(instance);
            
            // Store instance on element for external access
            element.dwcNavInstance = instance;
        });

        return instances;
    }

    // Auto-initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDWCNavigation);
    } else {
        initDWCNavigation();
    }

    // Bricks Builder Integration
    if (typeof window.bricksIsFrontend !== 'undefined') {
        // Re-initialize when elements are added/updated in builder
        document.addEventListener('bricks/ajax/load', initDWCNavigation);
    }

    // Export for external use
    window.DWCNavigation = DWCNavigation;
    window.initDWCNavigation = initDWCNavigation;

})();