<?php

namespace Drupal\haku_theme_extension\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Provides a custom Twig extension for rendering SVG icons.
 *
 * This class registers a Twig function `icon()` that allows rendering
 * of inline SVG icons from an SVG sprite, using the icon ID and optional
 * attributes such as classes or accessibility labels.
 *
 * Example usage in Twig:
 * @code
 *   {{ icon('search', {'class': 'icon--small', 'aria-label': 'Search'}) }}
 * @endcode
 */
class IconExtension extends AbstractExtension {

  /**
   * Returns a list of custom Twig functions provided by this extension.
   *
   * @return \Twig\TwigFunction[]
   *   An array of TwigFunction definitions.
   */
  public function getFunctions() {
    return [
      new TwigFunction('icon', [$this, 'renderIcon'], ['is_safe' => ['html']]),
    ];
  }

  /**
   * Renders an SVG icon from a sprite by its symbol ID.
   *
   * @param string $icon_id
   *   The ID of the symbol to reference (without the `#` prefix).
   * @param array $attributes
   *   Optional attributes to add to the <svg> element.
   *
   * @return string
   *   The rendered SVG markup.
   */
  public function renderIcon(string $icon_id, array $attributes = []): string {
    $attributes['class'] = $this->ensureIconClass($attributes['class'] ?? 'icon');
    $this->applyAccessibilityDefaults($attributes);
    $attr_string = $this->buildAttributes($attributes);

    return '<svg' . $attr_string . '><use href="#' . htmlspecialchars($icon_id, ENT_QUOTES, 'UTF-8') . '"></use></svg>';
  }

  /**
   * Ensures the SVG has the base 'icon' class.
   *
   * @param string $class
   *   The original class attribute.
   *
   * @return string
   *   Class string with 'icon' included.
   */
  private function ensureIconClass(string $class): string {
    $has_icon = (function_exists('str_contains')) ? str_contains($class, 'icon') : strpos($class, 'icon') !== FALSE;
    return $has_icon ? $class : 'icon ' . $class;
  }

  /**
   * Applies accessibility defaults to the attributes array.
   *
   * Adds 'aria-hidden' => 'true' if no role, aria-label, or title is set.
   *
   * @param array $attributes
   *   The attributes array to modify (passed by reference).
   */
  private function applyAccessibilityDefaults(array &$attributes): void {
    if (!isset($attributes['role']) && !isset($attributes['aria-label']) && !isset($attributes['title'])) {
      $attributes['aria-hidden'] = 'true';
    }
  }

  /**
   * Builds the HTML attribute string from the attributes array.
   *
   * @param array $attributes
   *   The attributes to convert to a string.
   *
   * @return string
   *   The formatted HTML attribute string.
   */
  private function buildAttributes(array $attributes): string {
    $attr_parts = [];
    foreach ($attributes as $key => $value) {
      if ($value === NULL || $value === FALSE) {
        continue;
      }
      if ($value === TRUE) {
        $attr_parts[] = htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8');
        continue;
      }
      $attr_parts[] = htmlspecialchars((string) $key, ENT_QUOTES, 'UTF-8') . '="' . htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') . '"';
    }
    return $attr_parts ? ' ' . implode(' ', $attr_parts) : '';
  }

}
