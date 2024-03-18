# [Unagi](https://wordpress.org/plugins/unagi/) #

Unagi is a WordPress plugin that helps you to keep the admin dashboard clean. It's a zero-configuration plugin, just activate and rid of the nags.


![Unagi](https://media.giphy.com/media/ubpB6XcvpYMF2/giphy.gif)


> Unagi - "It's not something you are , it's something you have."


## How does it work? ##

It buffers all the output that hooked into `admin_notices` action and then displays it within a dedicated notification page.

### Limitations & Tips ###
- If there is a notification message only added for a particular page. It won't be displayed on the notifications page. You can use `unagi_show_diff` filter to allow displaying non-global messages.
- The plugin only respects notifications messages that have "notice" class by default. Most of the plugins use "notice" class as a wrapper of the output. You can use `unagi_xpath_expression` filter to customize targered xpath.
- `edit_posts` is the default capability. It can be overridden with `unagi_required_capability` filter.
- By default, plugin saves the output in the usermeta and renders saved output. If you need to avoid DB calls, you can use `unagi_show_notifications_nicely` filter.


## Support ##
This is a developer's portal for Unagi and should _not_ be used for support. Please visit the [support forums](https://wordpress.org/support/plugin/unagi/) if you need to submit a support request.

## Other Projects ##

If you like our Unagi plugin, then consider checking out our other projects:

* <a href="https://handyplugins.co/magic-login-pro/" rel="friend">Magic Login Pro</a> – Easy, secure, and passwordless authentication for WordPress.
* <a href="https://handyplugins.co/easy-text-to-speech/" rel="friend">Easy Text-to-Speech for WordPress</a> – Transform your textual content into high-quality synthesized speech with Amazon Polly.
* <a href="https://handyplugins.co/handywriter/" rel="friend">Handywriter</a> – AI-powered writing assistant that can help you create content for your WordPress.
* <a href="https://handyplugins.co/paddlepress-pro/" rel="friend">PaddlePress PRO</a> – Paddle Plugin for WordPress
* <a href="https://poweredcache.com/" rel="friend">Powered Cache</a> – Caching and Optimization for WordPress – Easily Improve PageSpeed & Web Vitals Score.
* <a href="https://handyplugins.co/wp-accessibility-toolkit/" rel="friend">WP Accessibility Toolkit</a> – A collection of tools to help you make your WordPress more accessible.


## Credits
* [unDraw](https://undraw.co/illustrations)
* [10up Toolkit](https://github.com/10up/10up-toolkit)
