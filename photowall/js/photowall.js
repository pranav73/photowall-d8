/**
 * @file
 * Defines Javascript behaviors for the photowall module.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  /**
   * JS required for photowall.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attach behavior for photowall.
   */
  Drupal.behaviors.photowall = {
    attach: function (context, settings) {
      $('.photowall').each(function(i){
        var photowall_val = $(this).attr("data-photowall-settings");
        var photowall = JSON.parse(decodeURIComponent(photowall_val));
        var photowall_options_val = $(this).attr("data-photowall-options");
        var photowall_options = JSON.parse(decodeURIComponent(photowall_options_val));
        PhotoWall.init({
          el: '.photowall-' + photowall_options.entity_type + '-' + photowall_options.entity_id + '-' + photowall_options.target_id,  // Gallery element.
          zoom: true,  // Use zoom.
          zoomAction: 'mouseenter',  // Zoom on action.
          zoomTimeout: 500,  // Timeout before zoom.
          zoomImageBorder: 5,  // Zoomed image border size.
          zoomDuration: 100,  // Zoom duration time.
          showBox: true, // Enable fullscreen mode.
          showBoxSocial: true,  // Show social buttons.
          padding: 5,  // padding between images in gallery.
          lineMaxHeight: 150, // Max set height of pictures line
          lineMaxHeightDynamic: false,  // Dynamic lineMaxHeight.
          baseScreenHeight: 600  // Base screen size from wich calculating dynamic lineMaxHeight.
        });
        PhotoWall.load(photowall);
      });
    }
  }
})(jQuery, Drupal, drupalSettings);
