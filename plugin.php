<?php

/**
 * The file description. *
 * @package Phile
 * @subpackage PhileAnalytics
 * @version 1.0.0
 * @author Philipp Schmitt <philipp@schmitt.co>
 *
 */
class PhileAnalytics extends \Phile\Plugin\AbstractPlugin implements \Phile\EventObserverInterface {

    private $config;
    private $twig_vars;
    private $googleTrackingId;

    public function __construct() {
        \Phile\Event::registerEvent('config_loaded', $this);
        \Phile\Event::registerEvent('before_render_template', $this);
        $this->config = \Phile\Registry::get('Phile_Settings');
        $this->twig_vars = \Phile\Registry::get('templateVars');
    }

    public function on($eventKey, $data = null) {
        if ($eventKey == 'config_loaded' && isset($this->config['google_tracking_id'])) {
                $this->googleTrackingId = $this->config['google_tracking_id'];
        } else if ($eventKey == 'before_render_template' && !empty($this->googleTrackingId)) {
                $this->twig_vars['googletrackingcode'] = '<script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push([\'_setAccount\', \'' . $this->googleTrackingId . '\']);
            _gaq.push([\'_trackPageview\']);
            (function() {
                var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
                ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
                var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>';
                \Phile\Registry::set('templateVars', $this->twig_vars);
        } 
    }
}
