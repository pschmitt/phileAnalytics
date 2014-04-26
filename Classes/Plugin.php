<?php

namespace Phile\Plugin\Pschmitt\Analytics;

/**
* Google Analytics plugin for Phile
*
* @version 1.0.1
* @author  Philipp Schmitt <philipp@schmitt.co>
* @link    https://github.com/pschmitt/phileAnalytics
* @license http://opensource.org/licenses/MIT
* @package Phile\Plugin\Pschmitt\Analytics
*
*/

class Plugin extends \Phile\Plugin\AbstractPlugin implements \Phile\Gateway\EventObserverInterface {

    private $config;
    private $googleTrackingId;

    public function __construct() {
        \Phile\Event::registerEvent('config_loaded', $this);
        \Phile\Event::registerEvent('before_render_template', $this);
        $this->config = \Phile\Registry::get('Phile_Settings');
    }

    public function on($eventKey, $data = null) {
        if ($eventKey == 'config_loaded' && isset($this->config['google_tracking_id'])) {
                $this->googleTrackingId = $this->config['google_tracking_id'];
        } else if ($eventKey == 'before_render_template' && !empty($this->googleTrackingId)) {
                if (\Phile\Registry::isRegistered('templateVars')) {
                    $twig_vars = \Phile\Registry::get('templateVars');
                } else {
                    $twig_vars = array();
                }

                $twig_vars['googletrackingcode'] = '<script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push([\'_setAccount\', \'' . $this->googleTrackingId . '\']);
            _gaq.push([\'_trackPageview\']);
            (function() {
                var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
                ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
                var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>';
                \Phile\Registry::set('templateVars', $twig_vars);
        }
    }
}
