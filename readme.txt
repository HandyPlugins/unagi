=== Unagi ===
Contributors:      handyplugins, m_uysl
Tags:              notification,nags,admin notice,
Requires at least: 5.0
Tested up to:      6.6
Requires PHP:      5.6
Stable tag:        0.2.1
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html
Donate link:       https://handyplugins.co/donate/

Unagi clean-up your WordPress notices from the dashboard and show them under the "Notifications" pages.

== Description ==

Unagi is a WordPress plugin that helps keep the admin dashboard clean. It's a zero-configuration plugin; just activate and get rid of the nags.

= How does it work? =

It buffers all the output that hooked into `admin_notices` action and then displays it within a dedicated notification page.

= Limitations & Tips =
- If, there is a notification message only added for a particular page. It won't be displayed on the notifications page. You can use `unagi_show_diff` filter to allow displaying non-global messages.
- The plugin only respects notifications messages that have "notice" class by default. Most of the plugins use "notice" class as a wrapper of the output. You can use `unagi_xpath_expression` filter to customize targered xpath.
- `edit_posts` is the default capability. It can be overridden with `unagi_required_capability` filter.
- By default, plugin saves the output in the usermeta and renders saved output. If you need to avoid DB calls, you can use `unagi_show_notifications_nicely` filter.

> Unagi - "It's not something you are , it's something you have."

If you like our Unagi plugin, then consider checking out our other projects:

* <a href="https://handyplugins.co/magic-login-pro/" rel="friend">Magic Login Pro</a> – Easy, secure, and passwordless authentication for WordPress.
* <a href="https://handyplugins.co/easy-text-to-speech/" rel="friend">Easy Text-to-Speech for WordPress</a> – Transform your textual content into high-quality synthesized speech with Amazon Polly.
* <a href="https://handyplugins.co/handywriter/" rel="friend">Handywriter</a> – AI-powered writing assistant that can help you create content for your WordPress.
* <a href="https://handyplugins.co/paddlepress-pro/" rel="friend">PaddlePress PRO</a> – Paddle Plugin for WordPress
* <a href="https://poweredcache.com/" rel="friend">Powered Cache</a> – Caching and Optimization for WordPress – Easily Improve PageSpeed & Web Vitals Score.
* <a href="https://handyplugins.co/wp-accessibility-toolkit/" rel="friend">WP Accessibility Toolkit</a> – A collection of tools to help you make your WordPress more accessible.


= Contributing & Bug Report =
Bug reports and pull requests are welcome on [Github](https://github.com/HandyPlugins/unagi).

== Installation ==

= Manual Installation =

1. Upload the entire `/unagi` directory to the `/wp-content/plugins/` directory.
2. Activate Unagi through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= Some of the messages are missing under the notifications page? =

This plugin only respects the messages that use `notice` class.  And, the notices that added to a particular page might not be shown. You can use `unagi_show_diff` filter to display them.

== Screenshots ==

1. Before
2. After
3. Notifications screen

== Changelog ==

= 0.2.1 (July 11, 2024) =
* Added playground blueprint.
* Dependency update.
* Tested with WP 6.6

= 0.2 (March 18, 2024) =
* fix mb_convert_encoding deprecation.
* Dependency update.
* Tested with WP 6.5

= 0.1.5 (March 03, 2023) =
* Disable warnings with non-well-formed DomDocument
* Dependency update
* Tested with WP 6.2

= 0.1.4 (November 6, 2022) =
* Tested with WP 6.1 Props [@ZgrK](https://github.com/ZgrK).

= 0.1.3 =
* Tested with WP 5.9 Props [@ZgrK](https://github.com/ZgrK).

= 0.1.2 =
* Revert output hook change. (It causes regression when `admin_notices` removes on a page entirely)
* Add heading to notifications page. Props [@sanzeeb3](https://github.com/sanzeeb3)
* Improve WooCommerce compatibility

= 0.1.1 =
* Change output hook

= 0.1.0 =
* First release

== Upgrade Notice ==

= 0.1.0 =
First Release
