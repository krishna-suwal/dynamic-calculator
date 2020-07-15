=== Dynamic Calculator ===
Contributors: krishnasuwal
Tags: dynamic, dynamic calculator, calculator
Requires at least: 4.9
Tested up to: 5.4
Requires PHP: 5.6
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to embed calculator in your posts and pages using shortcode.

== Description ==

Embed calculator in your posts and pages using shortcode.

DISCLAIMER: UI design was referenced from Google calculator.

**FEATURES:**

* Basic operations (Addition, Subtraction, Division, Multiplication)
* Remainder (Character `R` has been used to indicate `Remainder` as the use of `%` symbol might conflict with percentage)
* Insert multiple zeros (You can insert upto 4 zeros with one click)
* Use of Brackets
* Previously calculated answer can be referenced using `Ans` button
* Separate buttons for AC (All Clear) and CE (Clear Entry)

**SHORTCODE:**
Use the shortcode `dc_calculator` to embed a calculator.

== Installation ==

Go to Plugins > Add New > Search for the plugin and click install, or download and extract the plugin, and copy the the plugin folder into your wp-content/plugins directory and activate.
You can also upload the Zip file and install from your Plugins > Add New section.

== Frequently Asked Questions ==

= Can I contribute? =

Sure you can. Here's the GitHub [main repository](https://github.com/krishna-suwal/wp-calculator/) and [submodule](https://github.com/krishna-suwal/wp-calculator-frontend)

= Can I embed multiple calculator on a single page? =

Currently, operations of multiple calculators on a single page isn't supported. If you insert multiple shortcode on same page, the calculator UI WILL be rendered multiple times but an action in one calculator will be reflected in all of the present calculators on the page, with same output.

== Screenshots ==
1. Preview of the calculator

== Changelog ==

= 1.0.0 - 2020-xx-xx =
* Initial Release