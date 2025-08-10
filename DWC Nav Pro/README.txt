=== DWC Nav Pro for Bricks ===
Contributors: your-username
Tags: bricks, navigation, responsive, menu, dropdown
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A comprehensive responsive navigation system for Bricks Builder with nestable components and full customization.

== Description ==

DWC Nav Pro is a powerful navigation plugin specifically designed for Bricks Builder. It provides a complete set of nestable elements to create responsive, accessible, and highly customizable navigation menus.

**Key Features:**

* **Nestable Architecture**: Container → Items → Dropdowns for maximum flexibility
* **Fully Responsive**: Customizable breakpoints (480px to 1024px)
* **Multiple Mobile Menu Types**: Overlay, slide from any direction, or dropdown
* **Rich Customization**: Full styling control for desktop and mobile states
* **Accessibility Ready**: Keyboard navigation, ARIA labels, focus management
* **Animation Support**: Smooth transitions and hover effects
* **Vanilla JavaScript**: No jQuery dependency for better performance
* **Builder Integration**: Live preview and real-time editing in Bricks

**Elements Included:**

1. **DWC Nav Container**: Main navigation wrapper with responsive settings
2. **DWC Nav Item**: Individual menu items with links, icons, and styling
3. **DWC Nav Dropdown**: Submenu containers with positioning and animations
4. **DWC Mobile Toggle**: Customizable hamburger/icon/text toggle buttons

**Perfect For:**

* Website headers and main navigation
* Footer menus and sitemap navigation  
* Mobile-first responsive designs
* Multi-level dropdown menus
* Custom navigation layouts

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/dwc-nav-pro/`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Ensure Bricks Builder is installed and activated
4. Find the DWC Navigation elements in the Bricks Builder panel

== Frequently Asked Questions ==

= Does this work without Bricks Builder? =

No, this plugin is specifically designed for Bricks Builder and requires it to function.

= Can I customize the styling? =

Yes! Each element includes comprehensive styling options in the Bricks panel, plus CSS classes for advanced customization.

= Is it mobile responsive? =

Absolutely! The plugin includes multiple mobile menu types and customizable breakpoints for perfect mobile experience.

= Does it support multi-level menus? =

Yes, you can nest dropdown elements within navigation items to create multi-level menus.

= Is it accessible? =

Yes, the plugin includes proper ARIA attributes, keyboard navigation, and focus management for screen readers.

= Can I use custom icons? =

Yes, the plugin supports any icon font available in Bricks Builder, including custom icon fonts.

== Screenshots ==

1. DWC Navigation elements in Bricks Builder panel
2. Desktop navigation with dropdown menu
3. Mobile navigation with overlay menu
4. Navigation settings and customization options
5. Live preview in Bricks Builder

== Changelog ==

= 1.0.0 =
* Initial release
* Four nestable navigation elements
* Full responsive support
* Multiple mobile menu types
* Accessibility features
* Bricks Builder integration

== Upgrade Notice ==

= 1.0.0 =
Initial release of DWC Nav Pro for Bricks Builder.

== Developer Notes ==

**File Structure:**
```
dwc-nav-pro/
├── dwc-nav-pro.php (Main plugin file)
├── elements/ (Element PHP files)
├── assets/css/ (Stylesheets)
└── assets/js/ (JavaScript files)
```

**JavaScript Events:**
* `dwc:menuOpen` - Fired when mobile menu opens
* `dwc:menuClose` - Fired when mobile menu closes
* `dwc:dropdownOpen` - Fired when dropdown opens
* `dwc:dropdownClose` - Fired when dropdown closes

**CSS Classes:**
* `.dwc-nav-container` - Main navigation container
* `.dwc-nav-item` - Navigation menu items
* `.dwc-nav-dropdown` - Dropdown/submenu containers
* `.dwc-mobile-toggle` - Mobile menu toggle button

**PHP Hooks:**
* `dwc_nav_container_classes` - Filter container CSS classes
* `dwc_nav_item_classes` - Filter item CSS classes
* `dwc_nav_mobile_breakpoint` - Override mobile breakpoint