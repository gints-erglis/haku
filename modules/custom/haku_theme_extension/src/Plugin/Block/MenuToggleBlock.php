<?php

namespace Drupal\haku_theme_extension\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a menu toggle button block.
 *
 * @Block(
 *   id = "haku_blocks_menu_toggle",
 *   admin_label = @Translation("Menu Toggle Block"),
 *   category = @Translation("Haku Custom")
 * )
 */
class MenuToggleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['menu-toggle'] = [
      '#type' => 'html_tag',
      '#tag' => 'button',
      '#attributes' => [
        'id' => 'menu-toggle-button',
        'class' => [
          'button',
          'button--menu-toggle',
        ],
        'aria-label' => $this->t('Menu'),
        'aria-expanded' => 'false',
      ],
      'children' => [
        [
          '#type' => 'html_tag',
          '#tag' => 'span',
          '#attributes' => [
            'class' => 'menu-burger__line',
          ],
        ],
        [
          '#type' => 'html_tag',
          '#tag' => 'span',
          '#attributes' => [
            'class' => 'menu-burger__line',
          ],
        ],
        [
          '#type' => 'html_tag',
          '#tag' => 'span',
          '#attributes' => [
            'class' => 'menu-burger__line',
          ],
        ],
      ],
    ];

    return $build;
  }

}
