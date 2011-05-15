<?php
/**
 * Div Shorthand Plugin: Shorthand for <div class="your_class">...</div>.
 *
 *   syntax: #your_class[...]#
 *
 * The text you include between the shorthand opening and closing tags is not
 * parsed in any way.  It's special characters are all escaped.  I'd like to
 * allow embedded syntax, but paragraph generation behaves too strangely to
 * make this useful.  For example, embedding the word "ain't" would produce
 * three separate paragraphs for each of "ain", "'", and "t".  If you know
 * how to fix this, please let me know.
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Joe Lapp <http://www.spiderjoe.com>
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');
 
 
class syntax_plugin_div_shorthand extends DokuWiki_Syntax_Plugin
{
    function getInfo()
    {
        return array(
            'author' => 'Joe Lapp',
            'email'  => '',
            'date'   => '2005-08-21',
            'name'   => 'Div Shorthand',
            'desc'   => 'Shorthand for <div class="your_class">...</div>',
            'url'    => 'http://www.dokuwiki.org/plugin:div_span_shorthand',
        );
    }
 
    function getType()
        { return 'container'; }
 
    function getAllowedTypes()
    {
        // I'd like to allow all types, but the <p> autogen behavior makes them troublesome.
        return array(/*'container','substition','protected','disabled','formatting'*/);
    }
 
    function getPType()
        { return 'block'; }
 
    function getSort()
        { return 500; } // I'm not sure what's appropriate
 
    function connectTo($mode)
    {
        $this->Lexer->addEntryPattern('\#[a-zA-Z0-9_-]+\[(?=.*\x5D\x23)',
                                       $mode, 'plugin_div_shorthand');
    }
 
    // override default accepts() method to allow nesting
    // - ie, to get the plugin accepts its own entry syntax
    function accepts($mode)
    {
        if ($mode == substr(get_class($this), 7)) return true;
 
        return parent::accepts($mode);
    }
 
    function postConnect()
    {
        $this->Lexer->addExitPattern('\]\#', 'plugin_div_shorthand');
    }
 
    function handle($match, $state, $pos, &$handler)
    {
        switch($state)
        {
            case DOKU_LEXER_ENTER:
                return array($state, substr($match, 1, -1));
            case DOKU_LEXER_UNMATCHED:
                return array($state, $match);
            case DOKU_LEXER_EXIT:
                return array($state, '');
        }
        return array();
    }
 
    function render($mode, &$renderer, $data)
    {
        if($mode == 'xhtml')
        {
            list($state, $match) = $data;
            switch($state)
            {
                case DOKU_LEXER_ENTER:
                    //toc is lost when we use $renderer->nest so we back it up here
                    $this->toc = $renderer->toc;
                    $renderer->doc .= '<div class="'.$match.'">';
                    break;
                case DOKU_LEXER_UNMATCHED:
                    // $renderer->doc .= htmlspecialchars($match);
                    // if you want to render instructions placed inside the tag :
                    $renderer->doc .= $renderer->nest(p_get_instructions($match));
                    break;
                case DOKU_LEXER_EXIT:
                    $renderer->doc .= '</div>';
                    //toc restore
                    $renderer->toc = $this->toc;
                    break;
            }
            return true;
        }
        return false;
    }
}
?>
