# PhileAnalytics

## Description
Adds Google Analytics Tracking to your Phile Site.

## Note
This plugin is a port from [Pico-GoogleAnalytics](https://github.com/Janaros/Pico-Analytics) by [Janaros](https://github.com/Janaros)

## Installation

Clone this repository to `plugins/pschmitt/analytics`:

``bash
mkdir -p ~http/plugins/pschmitt
git clone https://github.com/pschmitt/phileAnalytics.git ~http/plugins/pschmitt/analytics
# You may consider using a submodule for this
git submodule add http://github.com/pschmitt/phileAnalytics.git ~http/plugins/pschmitt/analytics
``

Then activate it by editing your `config.php`:

```php
$config['plugins'] = array(
    // [...]
    'pschmitt\\analytics' => array('active' => true),
);

## Usage
1. Add `$config['google_tracking_id'] = '<YOUR_GOOGLE_TRACKING_ID>';` to `config.php`
2. Add `{{ googletrackingcode }}` to your template

