## INTRODUCTION

Provides a Photowall format for displaying Image field, using the
JQuery Photowall plugin.

The Photowall plugin was originally developed by Andrey Nikishaev (creotiv@gmail.com).
But the plugin was no more maintained & was not supported by latest jQuery
version. Old version is located [here](https://github.com/creotiv/jquery-photowall).

A new version was developed [here](https://github.com/tanmayk/jquery-photowall) which now works with latest jQuery.

## INSTALLATION

* Install the module as normal, see link for instructions.
   Link: https://www.drupal.org/documentation/install/modules-themes/modules-8
* Download the zip containing JQuery Photowall plugin from link below:
   https://github.com/tanmayk/jquery-photowall/releases/tag/0.1.6
* Put jquery-photowall library into /libraries folder so jquery-photowall.js
   can be found at /libraries/jquery-photowall/lib/jquery-photowall.js
* You can remove unnecessary files from library. Only `lib` directory is
   important.
* Go to "Administer" -> "Extend" and enable the Photowall module.
* You should now see a new display formatter i.e. "Photowall" for image field,
   under Manage display section of each content types.

## CONFIGURATION

* Visit any image fields display settings, you will be able to find
   the Photowall formatter.
* Change the display formatter for image field to photowall.
* Add a content & upload 1 or more images to the node and Save. On node view,
   photowall effect will appear for an image field.

## AVAILABLE OPTIONS

* **Zoom Factor** : Set zoom factor between 1.3 to 1.6 for better results.

## KNOWN ISSUE

* When there are more than one instances of photowall, only first instance
   opens up image in photowall popup when image is clicked. For other
   instances, image directly opens up in browser.

## MAINTAINERS

* [Tanmay Khedekar](https://www.drupal.org/u/tanmayk)
* [Pranav Aeer](https://www.drupal.org/u/pranav73)
* [Revati Gawas](https://www.drupal.org/u/revati_gawas)
