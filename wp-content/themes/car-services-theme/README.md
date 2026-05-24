# Car Services Theme

A modern, lightweight WordPress theme designed specifically for car service businesses.

## Features

- **Modern Design**: Clean and professional design optimized for car service businesses
- **Responsive Layout**: Fully responsive and mobile-first approach
- **WooCommerce Ready**: Full support for WooCommerce products and services
- **Gutenberg Compatible**: Full block editor support with custom block styles
- **Performance Optimized**: Lightweight, fast-loading theme
- **SEO Friendly**: Clean semantic HTML5 markup
- **Security**: Proper escaping and security best practices
- **Customizer Support**: Easy customization through WordPress Customizer
- **Accessibility**: WCAG 2.1 accessible color schemes and keyboard navigation
- **Translation Ready**: Full internationalization support with .pot file

## Theme Structure

```
car-services-theme/
├── assets/
│   ├── css/
│   │   ├── style.css           # Main stylesheet
│   │   ├── responsive.css      # Responsive design styles
│   │   ├── editor.css          # Block editor styles
│   │   └── woocommerce.css     # WooCommerce styles
│   └── js/
│       └── main.js             # Main JavaScript
├── inc/
│   ├── theme-setup.php         # Theme setup and features
│   ├── enqueue.php             # CSS/JS enqueue
│   ├── customizer.php          # Customizer configuration
│   ├── template-tags.php       # Helper functions
│   └── woocommerce.php         # WooCommerce support
├── template-parts/
│   ├── header/
│   │   └── navigation.php      # Navigation menu
│   ├── footer/
│   │   └── footer-widgets.php  # Footer widgets
│   └── content/
│       └── post-featured.php   # Featured image
├── header.php                  # Header template
├── footer.php                  # Footer template
├── index.php                   # Main template
├── front-page.php              # Homepage template
├── sidebar.php                 # Sidebar template
├── functions.php               # Theme functions
├── style.css                   # Theme info
├── theme.json                  # Block editor settings
└── README.md                   # This file
```

## Installation

1. Download the theme folder
2. Upload to `/wp-content/themes/`
3. Activate in WordPress admin panel
4. Configure through Appearance > Customize

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Requirements

- WordPress 6.0+
- PHP 8.0+

## Customization

### Colors

Edit CSS variables in `assets/css/style.css`:

```css
:root {
	--primary-color: #0066cc;
	--secondary-color: #ff6b35;
	--accent-color: #004aad;
}
```

### Typography

Fonts are loaded from Google Fonts in `inc/enqueue.php`. Modify the URL to use different fonts.

### Logo & Branding

1. Go to Appearance > Customize
2. Click on "Site Identity"
3. Upload custom logo and set colors

### Business Information

1. Go to Appearance > Customize
2. Click on "Car Services Branding"
3. Add phone, email, address, hours, and social links

## WooCommerce Setup

The theme is fully compatible with WooCommerce. After installing WooCommerce:

1. Go to WooCommerce > Products to add services
2. Customize product pages through the block editor
3. WooCommerce styling is automatic

## Widget Areas

- Primary Sidebar (Blog posts page)
- Footer Column 1-4 (Footer widget areas)

## Menus

- Primary Menu (Main navigation)
- Footer Menu (Footer navigation)
- Mobile Menu (Mobile navigation)

## Development

### CSS Architecture

- **style.css**: Base styles, layout, components
- **responsive.css**: Breakpoints and responsive design
- **editor.css**: Block editor specific styles
- **woocommerce.css**: WooCommerce component styles

### JavaScript

All JavaScript is vanilla (no jQuery dependency) and includes:
- Mobile menu toggle
- Smooth scrolling
- Form validation
- Lazy loading support
- Back-to-top button

## Performance

- Optimized CSS and minimal JavaScript
- No unnecessary HTTP requests
- Efficient use of CSS Grid and Flexbox
- Support for native lazy loading
- Proper asset enqueue with dependencies

## Security

- All outputs are properly escaped
- Form validation and sanitization
- No direct file access
- Follows WordPress security best practices
- No SQL injection vulnerabilities
- XSS protection

## Accessibility

- WCAG 2.1 AA compliant
- Semantic HTML5 structure
- Proper heading hierarchy
- Skip links for keyboard navigation
- ARIA labels where needed
- Color contrast ratios meet standards
- Support for reduced motion preferences

## Support

For theme support and updates, visit the documentation or contact the developer.

## License

This theme is licensed under the GPL v2 or later. See LICENSE file for details.

## Credits

Created for WordPress car service businesses. Built with modern WordPress standards and best practices.
