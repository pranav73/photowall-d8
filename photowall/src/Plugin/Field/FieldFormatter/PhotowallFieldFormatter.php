<?php

namespace Drupal\photowall\Plugin\Field\FieldFormatter;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatterBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\file\Entity\File;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Entity\EntityTypeManagerInterface; # New Import.

/**
 * Plugin implementation of the 'photowall_field_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "photowall",
 *   label = @Translation("Photowall"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class PhotowallFieldFormatter extends ImageFormatterBase implements ContainerFactoryPluginInterface {

  /**
   * The image style entity storage.
   *
   * @var \Drupal\image\ImageStyleStorageInterface
   */
  protected $imageStyleStorage;

  /**
   * Constructs an ImageFormatter object.
   *
   * @param string $plugin_id
   *   The plugin_id for the formatter.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the formatter is associated.
   * @param array $settings
   *   The formatter settings.
   * @param string $label
   *   The formatter label display setting.
   * @param string $view_mode
   *   The view mode.
   * @param array $third_party_settings
   *   The current user.
   * @param \Drupal\Core\Entity\EntityStorageInterface $image_style_storage
   *   The image style.
   */
  public function __construct($plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, $label, $view_mode, array $third_party_settings, EntityStorageInterface $image_style_storage) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $label, $view_mode, $third_party_settings);
    $this->imageStyleStorage = $image_style_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['label'],
      $configuration['view_mode'],
      $configuration['third_party_settings'],
      $container->get('entity_type.manager')->getStorage('user') # Added
      // $container->get('entity.manager')->getStorage('image_style')   # Removed
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return [
      // Implement default settings.
      'zoom_factor' => '1.5',
    ] + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $element['zoom_factor'] = [
      '#title' => t('Zoom factor'),
      '#type' => 'number',
      '#step' => 'any',
      '#default_value' => $this->getSetting('zoom_factor'),
      '#required' => TRUE,
      '#description' => t('Enter value between 1.3 to 1.6 for better results.'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    // Implement settings summary.
    $zoom_factor = $this->getSetting('zoom_factor');
    if ($zoom_factor) {
      $summary[] .= $this->t('Zoom factor: @zoom_factor', ['@zoom_factor' => $zoom_factor]);
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];

    // Early opt-out if the field is empty.
    if (empty($items->count())) {
      return $elements;
    }

    $zoom_factor = $this->getSetting('zoom_factor');
    if (!isset($zoom_factor)) {
      $zoom_factor = '1.5';
    }
    $photowall = [];
    $photowall_options = [];
    $photowall_items = $items->getValue();
    foreach ($photowall_items as $num => $item) {
      // Generate ids.
      $id = 'photowall-' . ($num + 1);
      // Get image path.
      $file = File::load($item['target_id']);
      if (!empty($file)) {
        $image['path'] = file_create_url($file->getFileUri());
      }
      // Specify width & height.
      if (isset($item['width']) && isset($item['height'])) {
        $image['width'] = $item['width'];
        $image['height'] = $item['height'];
      }
      else {
        $image_dims = getimagesize($image['path']);
        $image['width'] = $image_dims[0];
        $image['height'] = $image_dims[1];
      }
      // The height and width will be adjusted by photowall plugin itself.
      $photowall[$id] = [
        'id' => $id,
        // Source image for Showbox.
        'img' => $image['path'],
        'width' => $image['width'],
        'height' => $image['height'],
        'th' => [
          // Source image for Photowall thumbnails.
          'src' => $image['path'],
          'width' => trim($image['width'], ""),
          'height' => trim($image['height'], ""),
          'zoom_src' => '',
          'zoom_factor' => $zoom_factor,
        ],
      ];
    }
    if ($items->getValue()[0]['target_id'] != NULL) {
      $photowall_options = [
        'zoom_factor' => $zoom_factor,
        'entity_type' => $items->getEntity()->bundle(),
        'entity_id' => $items->getEntity()->id(),
        'target_id' => $items->getValue()[0]['target_id'],
      ];
    }

    $elements[] = [
      '#theme' => 'photowall',
      '#photowall_settings' => Json::encode($photowall),
      '#photowall_options' => Json::encode($photowall_options),
    ];

    // Attach the photowall libraries.
    $elements['#attached']['library'][] = 'photowall/photowall';
    $elements['#attached']['library'][] = 'photowall/init';

    return $elements;
  }

}
