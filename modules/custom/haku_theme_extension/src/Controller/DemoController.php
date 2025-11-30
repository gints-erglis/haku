<?php

namespace Drupal\haku_theme_extension\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller for theme component demo pages.
 *
 * Provides simple demo renderables for the theme components page used during
 * development and QA.
 */
class DemoController extends ControllerBase {

  /**
   * Builds the Theme Components demo page.
   *
   * The returned render array uses the 'components_demo' theme hook which
   * should map to the Twig template `templates/demo/components-demo.html.twig`.
   *
   * @return array
   *   A renderable array for the demo page.
   */
  public function components() {
    return [
      '#theme' => 'components_demo',
      '#attached' => [
        'library' => [
          'haku_base/global',
        ],
      ],
    ];
  }

}
