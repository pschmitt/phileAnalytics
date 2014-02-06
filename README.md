# PhileAnalytics

## Description
Adds Google Analytics Tracking to your Phile Site.

## Note
This plugin was is a port from [Pico-GoogleAnalytics](https://github.com/Janaros/Pico-Analytics) from [Janaros](https://github.com/Janaros)

## Install
1. Download the zip and extract the content to the Phile plugin folder
2. Activate the plugin by inserting `'phileAnalytics' => array('active' => true)` to the `$config['plugins']` array in your `config.php`
3. Add `$config['google_tracking_id'] = '<YOUR_GOOGLE_TRACKING_ID>';` to `config.php`
4. Insert `{{ googletrackingcode }}` into your template

