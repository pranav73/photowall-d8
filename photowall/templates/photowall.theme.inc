<?php

/**
 * @file
 * Theming functions for the Photowall module.
 */

use Drupal\file\Entity\File;

/**
 * Template preprocess handler for 'photowall' theme.
 */
function photowall_preprocess_photowall(&$variables) {
  // Add JQuery plugin and JS.
  $variables['#attached']['library'][] = 'photowall/photowall.local';
  $variables['#attached']['library'][] = 'photowall/jquery-photowall';
  $field_type = $variables['field_type'];

  $photowall = [];
  $photowall_items = array_reverse($variables['items']->getValue());
  foreach ($photowall_items as $num => $item) {
    // Generate ids.
    $id = 'photowall-' . ($num + 1);
    // Get image data.
    $file = File::load($item['target_id']);
    if ($field_type == 'image') {
      $image['path'] = file_create_url($file->getFileUri());
    }
    if ($field_type == 'media') {
      // $image['path'] = file_create_url($file->getFileUri());
    }

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
      'img' => $image['path'], // Source image for Showbox.
      'width' => $image['width'],
      'height' => $image['height'],
      'th' => [
        'src' => $image['path'], //Source image for Photowall thumbnails.
        'width' => $image['width'],
        'height' => $image['height'],
        'zoom_src' => '',
        'zoom_factor' => $variables['zoom_factor'],
      ],
    ];
    // Attached photowall data to drupalSettings.
    $variables['#attached']['drupalSettings']['settings']['photowall'] = $photowall;
  }
}
