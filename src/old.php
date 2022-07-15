
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
              'href'  => DOKU_PLUGIN.'yixuetianya/src/katex.min.css',
              'rel'   => 'stylesheet'
          );

          $event->data['script'][] = array(
              'type'    => 'text/javascript',
              'src'     => '/lib/plugins/yixuetianya/src/auto-render.min.js',
      'charset' => 'utf-8',
              'defer'   => ''
          );

          $event->data['script'][] = array(
              'type'    => 'text/javascript',
      'charset' => 'utf-8',
              'src'     => DOKU_PLUGIN.'yixuetianya/src/katex.min.js',
              'defer'   => ''
          );
      }else{
          $event->data['link'][] = array(
              'href'  => $this->getConf('urlcss'),
              'rel'   => 'stylesheet'
          );

          $event->data['script'][] = array(
              'type'    => 'text/javascript',
              'src'     => $this->getConf('urlkatex'),
      'charset' => 'utf-8',
              'defer'   => ''
          );

          $event->data['script'][] = array(
              'type'    => 'text/javascript',
      'charset' => 'utf-8',
              'src'     => $this->getConf('urlautorender'),
              'defer'   => ''
          );
      };



      $katex = $this->getConf('usekatex') == 1 ? '=1' : '=0';
      $event->data['script'][] = array(
          'type'    => 'text/javascript',
          'src'     => $this->getConf('urlyixue').$katex,
          'charset' => 'utf-8',
          'defer'   => ''
      );
  }

}