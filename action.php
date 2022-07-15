<?php
/**
 * DokuWiki Plugin mathjax (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Goldentianya <goldentianya@gmail.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

/**
 * Add scripts via an event handler
 */
class action_plugin_yixuetianya extends DokuWiki_Action_Plugin {

    /**
     * Registers our handler for the TPL_METAHEADER_OUTPUT event
     */
    public function register(Doku_Event_Handler $controller) {
       $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, '_tpl_metaheader');
    }

    /**
     * Add <script> blocks to the headers:
     *   - Load Katex if user select the library.
     *   - Load Yixue Library and config, which math library to use
     *
     * @param Doku_Event $event
     * @param            $param
     */
    public function _tpl_metaheader(Doku_Event $event, $param) {
        // Create main config block
        
		// 'href'  => $this->getConf('urlcss'),
        if($this->getConf('usekatex') == 1) {
            $event->data['link'][] = array(
                'href'  => '/lib/plugins/yixuetianya/src/katex.min.css',
                'rel'   => 'stylesheet'
            );

            $event->data['script'][] = array(
                'type'    => 'text/javascript',
                'src'     => '/lib/plugins/yixuetianya/src/katex.min.js',
				'charset' => 'utf-8',
                'defer'   => ''
            );

            $event->data['script'][] = array(
                'type'    => 'text/javascript',
				'charset' => 'utf-8',
                'src'     => '/lib/plugins/yixuetianya/src/auto-render.min.js',
                'defer'   => ''
            );
        }



        $katex = $this->getConf('usekatex') == 1 ? '?华鹤=1&字体=5&水土=1&短名=0&katex=1' : '?华鹤=1&字体=5&水土=1&短名=0&katex=0';
        $event->data['script'][] = array(
            'type'    => 'text/javascript',
            'src'     => '/lib/plugins/yixuetianya/src/bundle.js'.$katex,
            'charset' => 'utf-8',
            'defer'   => ''
        );
    }

}

// vim:ts=4:sw=4:et:
