<?php

namespace Drupal\itkdev_user_log\Formatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'Random_default' formatter.
 *
 * @FieldFormatter(
 *   id = "user_log_formatter",
 *   label = @Translation("User Log"),
 *   field_types = {
 *     "text",
 *   }
 * )
 */
class UserFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Displays details regarding the deleted user.');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Render each element as markup.
      $element[$delta] = ['#markup' => '$item->value'];
    }

    return $element;
  }

}
