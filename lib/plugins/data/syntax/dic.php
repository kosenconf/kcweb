<?php
/**
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Andreas Gohr <andi@splitbrain.org>
 * @author     harukasan <miruca@me.com>
 */
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();
require_once(dirname(__FILE__).'/table.php');

/**
 * This inherits from the table syntax, because it's basically the
 * same, just different output
 */
class syntax_plugin_data_dic extends syntax_plugin_data_table {

    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('----+ *datadic(?: [ a-zA-Z0-9_]*)?-+\n.*?\n----+',$mode,'plugin_data_dic');
    }

    protected $before_item = '<li>';
    protected $after_item  = '</li>';
    protected $before_title  = '<span class="title">';
    protected $after_title   = '</span>';
    protected $before_val  = '<span>';
    protected $after_val   = '</span>';

    /**
     * Create output
     */
    function render($format, &$R, $data) {
        if($format != 'xhtml') return false;
        if(is_null($data)) return false;
        $R->info['cache'] = false;

        $sqlite = $this->dthlp->_getDB();
        if(!$sqlite) return false;

        $this->updateSQLwithQuery($data); // handles request params

        // run query
        $clist = array_keys($data['cols']);
        $res = $sqlite->query($data['sql']);

        $cnt = 0;
        $rows = array();
        while ($row = sqlite_fetch_array($res, SQLITE_NUM)) {
            $rows[] = $row;
            $cnt++;
            if($data['limit'] && ($cnt == $data['limit'])) break; // keep an eye on the limit
        }

        if ($cnt === 0) {
            $this->nullList($data, $clist, $R);
            return true;
        }

        $R->doc .= $this->preList($clist, $data);
        foreach ($rows as $row) {
            // build data rows
            $R->doc .= $this->before_item;
            foreach($row as $num => $cval){
				if($clist[$num] !== "%pageid%"){
					// print title
					$R->doc .= "<br>";
					$R->doc .= $this->before_title;
					$R->doc .= $clist[$num];
					$R->doc .= ": ";
					$R->doc .= $this->after_title;
				}

				// print val
                $R->doc .= $this->before_val;
                $R->doc .= $this->dthlp->_formatData(
                                $data['cols'][$clist[$num]],
                                $cval,$R);
                $R->doc .= $this->after_val;

            }
            $R->doc .= $this->after_item;
        }
        $R->doc .= $this->postList($data, sqlite_num_rows($res));

        return true;
    }


    function preList($clist, $data) {
        return '<div class="dataaggregation"><ul class="dataplugin_dic'.$data['classes'].'">';
    }

    function nullList($data, $clist, &$R) {
        $R->doc .= '<div class="dataaggregation"><p class="dataplugin_dic '.$data['classes'].'">';
        $R->cdata($this->getLang('none'));
        $R->doc .= '</p></div>';
    }

    function postList($data) {
        return '</ul></div>';
    }

}
