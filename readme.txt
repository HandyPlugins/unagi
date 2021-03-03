=== Unagi ===
Contributors:      handyplugins,m_uysl
Tags:              notification,nags,admin notice,
Requires at least: 5.0
Tested up to:      5.7
Requires PHP:      5.6
Stable tag:        0.1.0
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Unagi clean-up your WordPress notices from the dashboard and show them under the "Notifications" pages.

== Description ==

Unagi is a WordPress plugin that helps you to keep the admin dashboard clean. It's a zero-configuration plugin, just activate and rid of the nags.

= How does it work? =

It buffers all the output that hooked into `admin_notices` action and then displays it within a dedicated notification page.

= Limitations & Tips =
- If, there is a notification message only added for a particular page. It won't be displayed on the notifications page. You can use `unagi_show_diff` filter to allow displaying non-global messages.
- The plugin only respects notifications messages that have "notice" class by default. Most of the plugins use "notice" class as a wrapper of the output. You can use `unagi_xpath_expression` filter to customize targered xpath.
- `edit_posts` is the default capability. It can be overridden with `unagi_required_capability` filter.
- By default, plugin saves the output in the usermeta and renders saved output. If you need to avoid DB calls, you can use `unagi_show_notifications_nicely` filter.


> Unagi - "It's not something you are , it's something you have."

= Contributing & Bug Report =
Bug reports and pull requests are welcome on [Github](https://github.com/HandyPlugins/unagi).

== Installation ==

= Manual Installation =

1. Upload the entire `/unagi` directory to the `/wp-content/plugins/` directory.
2. Activate Unagi through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

== Screenshots ==

1. Before
2. After
3. Notifications screen

== Changelog ==

= 0.1.0 =
* First release

== Upgrade Notice ==

= 0.1.0 =
First Release
