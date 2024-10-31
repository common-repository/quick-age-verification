=== Quick Age Verification ===
Contributors: cookersdev
Tags: age check, age verification, age restriction
Requires at least: 3.1
Tested up to: 5.8.2
Requires PHP: 5.7
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Presents each site user a quick age verification screen before using the site. Saves the response in a cookie for further visits.

== Description ==
This plugin provides an overlay for each website user to confirm his age (or different things - the text is fully costomizable in the options). On right answer, a cookie is set to remember the user for a set amount of days and not show the nag screen again. Otherwise, a custom message is shown to the user and the access to the site is not granted.

The plugin was initially developed for the age restriction of selling alcoholic beverages in a webshop. Due to legal reasons, such an age restriction must be in place (depending of the country of operation).

== Installation ==
1. Download and install the plugin from WordPress dashboard. You can also upload the entire "quick-age-verification" folder to the "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" menu in WordPress
3. In the plugin options, set the respective texts and other options. Logo or other image is optional.

== Frequently Asked Questions ==
= Can I add my site logo to the question overlay? =

Yes, an image can be added to the top of the overlay in the options. This is optional: without a selected image, nothing is displayed above the text.

= Is the overlay working on every device and browser? =

Yes, it should work on every system. (Javascript must be enabled!) Please check back if you happen to find a device that does not show the overlay.

= Does the plugin work with multiple languages? =

You can customize all texts including the respective buttons to your language. The plugin currently only works in a single language - please check back if you would need multilanguage support.

== Changelog ==
= 1.1.2 =
* Add version to included files for cachebusting.

= 1.1.0 =
* Change cookie path to whole domain.

= 1.0.0 =
* Initial commit.