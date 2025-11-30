# Haku Theme Extension


Simple Drupal custom module that provides:


- A Twig function `icon()` to render SVG icons from a sprite.


## Install


1. Copy the `haku_theme_extension` folder to `modules/custom/`.
2. Enable the module: `drush en haku_theme_extension` or via the UI.
3. Clear caches: `drush cr`.


## Usage in Twig


```twig
{{ icon('search', {'class': 'icon--small', 'aria-label': 'Search'} ) }}
