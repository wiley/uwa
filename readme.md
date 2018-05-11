# UWA

## Basic Usage

* *Theme Name:* uwa
* *Local Site URL:*
* *Landing Pages:* Custom Post Type
* *Start Date Location:*

## Getting Set Up Locally

### Install Dependencies

Install by navigating to the theme's `library` folder and running `npm install` followed by `bower install`.

### Watch Files

To start watching files use `grunt` from the `library` folder. This will run browsersync and then watch. You can now open any browser and when you make changes the browser(s) will inject the proper files automatically.

### Source Files

Source assets are stored in the "scss", "js", and "images" folders within the library. Any scss and js assets are minified through the `grunt` task. Images need to be optimized manually.

## Other Information

### Critical CSS

This theme utilizes inline styling in the head of the document for faster load times. If it seems like your changes are not working there is a chance that these inline styles are overwriting your changes.

### Custom Post Types:
Custom post types can be found in the `custom-post-types.php` file within the `library` folder. Custom post types for this theme are:

* Degrees
* Landing Pages

### Installed Scripts
Installed scripts are located in `library > js`.

* [Modernizr](https://modernizr.com/) - Browser feature support
* [Mixitup](https://github.com/patrickkunka/mixitup) - DOM manipulation library
* [Owl Carousel](https://github.com/OwlCarousel2/OwlCarousel2) - jQuery responsive slider
* [Font Face Observer](https://github.com/bramstein/fontfaceobserver) - small @font-face loader and monitor

### Resources
* [Starter Theme Wiki](https://github.com/thelearninghouse/starter-theme/wiki)
* [Advanced Custom Fields](https://www.advancedcustomfields.com/resources/)
* [WordPress Developer Reference](https://developer.wordpress.org/reference/)
