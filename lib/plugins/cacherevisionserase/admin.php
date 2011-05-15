<?php
/**
 * Cache/Revisions Eraser admin plugin
 * Version : 1.6.6
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     JustBurn <justburner@armail.pt>
 */

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'admin.php');
define('CACHEREVISIONSERASER_VER','1.6.6');
define('CACHEREVISIONSERASER_CONFIGREVISION',2);
define('CACHEREVISIONSERASER_DATE','2010-11-22');

/**
 * All DokuWiki plugins to extend the admin function
 * need to inherit from this class
 */
class admin_plugin_cacherevisionserase extends DokuWiki_Admin_Plugin {

	var $cachedir = null;
	var $revisdir = null;
	var $pagesdir = null;
	var $metadir = null;
	var $configs = null;
	var $filedels = 0;
	var $dirdels = 0;

	/**
	* Constructor
	*/
	function admin_plugin_cacherevisionserase(){
		$this->setupLocale();
		@include(dirname(__FILE__).'/configs.php');
	}

	/**
	* Return plug-in info
	*/
	function getInfo(){
		return array(
			'author' => 'JustBurn',
			'email'  => 'justburner@armail.pt',
			'date'   => CACHEREVISIONSERASER_DATE,
			'name'   => html_entity_decode($this->lang['title']),
			'desc'   => html_entity_decode($this->lang['desc']),
			'url'    => 'http://wiki.splitbrain.org/plugin:cacherevisionseraser',
		);
	}

	/**
	* Return prompt for admin menu
	*/
	function getMenuText($language) {
		return $this->lang['menu'] . ' (v' . CACHEREVISIONSERASER_VER . ')';
	}

	/**
	* Return sort order for position in admin menu
	*/
	function getMenuSort() {
		if ($this->configs['menusort'] == null) return 67;
		else return $this->configs['menusort'];
	}

	/**
	* Handle user request
	*/
	function handle() {
		global $conf;
		$this->cachedir = $conf['cachedir'];
		$this->revisdir = $conf['olddir'];
		$this->pagesdir = $conf['datadir'];
		if ($this->pagesdir == $null) $this->pagesdir = $conf['savedir']; // Olders versions compability?
		$this->metadir = $conf['metadir'];
		if ($this->metadir == $null) $this->metadir = $conf['meta'];      // Olders versions compability?
		$this->locksdir = $conf['lockdir'];
		if ($this->locksdir == $null) $this->locksdir = $this->pagesdir;  // Olders versions compability?
		$this->lang_id = $conf['lang'];
		if (!($this->configs['confrevision'] > 0)) $this->configs['confrevision'] = 0;
		$this->locktime = $conf['locktime'];
	}

	/**
	* Get request variable
	*/
	function get_req($reqvar, $defaultval) {
		if (isset($_REQUEST[$reqvar])) {
			return $_REQUEST[$reqvar];
		} else {
			return $defaultval;
		}
	}

	/**
	* Compare request variable
	*/
	function cmp_req($reqvar, $strtocmp, $onequal, $ondifferent) {
		if (isset($_REQUEST[$reqvar])) {
			return strcmp($_REQUEST[$reqvar], $strtocmp) ? $ondifferent : $onequal;
		} else {
			return $ondifferent;
		}
	}

	/**
	* Output appropriate html
	*/
	function html() {
		global $ID;
		global $lang;
		global $cacherevercfg;
		global $conf;

		$cmd = $this->get_req('cmd', 'main');

		// Plug-in title
		ptln('<h1>'.$this->lang['title'].' '.$this->lang['version'].' '.CACHEREVISIONSERASER_VER.'</h1>');

		// Make sure outputinfo level is valid
		$theoutputinfo = intval($this->get_req('level_outputinfo', 0));
		if ($this->configs['allow_outputinfo']) {
			if (($theoutputinfo < 0) || ($theoutputinfo > 2)) $theoutputinfo = 0;
		} else {
			$theoutputinfo = intval($this->configs['level_outputinfo']);
		}

		// Debugging only
		if ($this->configs['debuglist']) {
			ptln('<table class="inline">');
			ptln('<tr><th class="centeralign"><strong>Debugging information</strong></th></tr>');
			ptln('<tr><th>');
			ptln('config revision: <em>'.$this->configs['confrevision'].' (require '.CACHEREVISIONSERASER_CONFIGREVISION.')</em><br />');
			ptln('admin menu position: <em>'.$this->configs['menusort'].'</em><br />');
			ptln('language (C/R E.): <em>'.$this->lang['language'].'</em><br />');
			ptln('cachedir: <em>'.$this->cachedir.'</em><br />');
			ptln('revisdir: <em>'.$this->revisdir.'</em><br />');
			ptln('pagesdir: <em>'.$this->pagesdir.'</em><br />');
			ptln('metadir: <em>'.$this->metadir.'</em><br />');
			ptln('locksdir: <em>'.$this->locksdir.'</em><br />');
			ptln('language id (Doku): <em>'.$this->lang_id.'</em><br />');
			ptln('</th></tr></table><br />');
		}

		// Plug-in processing...
		$this->filedels = 0;
		$this->dirdels = 0;
		if ($this->analyzecrpt($cmd))
		if ((strcmp($cmd, 'erasecache') == 0) && ($this->configs['allow_allcachedel'])) {
			// Erase cache...
			ptln('<table class="inline">');
			ptln('<tr><th class="leftalign">');
			clearstatcache();
			$succop = true;
			$params = $this->cmp_req('delfl_UNK', 'yes', 0x01, 0) + $this->cmp_req('del_indexing', 'yes', 0x02, 0) + $this->cmp_req('delfl_i', 'yes', 0x04, 0) + $this->cmp_req('delfl_xhtml', 'yes', 0x08, 0) + $this->cmp_req('delfl_js', 'yes', 0x10, 0) + $this->cmp_req('delfl_css', 'yes', 0x20, 0) + $this->cmp_req('delfl_mediaP', 'yes', 0x40, 0);
			$prmask = ($this->configs['cache_delext_UNK']==0 ? 0 : 0x01) + ($this->configs['cache_del_indexing']==0 ? 0 : 0x02) + ($this->configs['cache_delext_i']==0 ? 0 : 0x04) + ($this->configs['cache_delext_xhtml']==0 ? 0 : 0x08) + ($this->configs['cache_delext_js']==0 ? 0 : 0x10) + ($this->configs['cache_delext_css']==0 ? 0 : 0x20) + ($this->configs['cache_delext_mediaP']==0 ? 0 : 0x40);
			if ($this->cmp_req('del_oldpagelocks', 'yes', true, false) && ($this->configs['cache_del_oldlocks'])) {
				if ($this->rmeverything_oldlockpages($this->locksdir, $this->locksdir, $theoutputinfo) == false) $succop = false;
			}
			if ($this->rmeverything_cache($this->cachedir, $this->cachedir, $params & $prmask, $theoutputinfo) == false) $succop = false;
			ptln('<strong>'.$this->lang['numfilesdel'].' '.$this->filedels.'<br />'.$this->lang['numdirsdel'].' '.$this->dirdels.'</strong><br />');
			ptln('</th></tr>');
			if ($succop)
				ptln('<tr><th>'.$this->lang['successcache'].'</th></tr>');
			else
				ptln('<tr><th>'.$this->lang['failedcache'].'</th></tr>');
			ptln('</table>');
			ptln('<table class="inline">');
			ptln('<tr><th class="centeralign">');
			ptln('<form method="post" action="'.wl($ID).'"><div class="no">');
			ptln('<input type="hidden" name="do" value="admin" />');
			ptln('<input type="hidden" name="page" value="cacherevisionserase" />');
			ptln('<input type="hidden" name="cmd" value="main" />');
			ptln('<input type="submit" class="button" value="'.$this->lang['backbtn'].'" />');
			ptln('</div></form></th></tr></table>');
		} else if ((strcmp($cmd, 'eraseallrevisions') == 0) && ($this->configs['allow_allrevisdel'])) {
			// Erase old revisions...
			ptln('<table class="inline">');
			ptln('<tr><th class="leftalign">');
			clearstatcache();
			$succop = true;
			if ($this->cmp_req('del_metafiles', 'yes', true, false) && ($this->configs['cache_del_metafiles'])) {
				if ($this->rmeverything_meta($this->metadir, $this->metadir, $theoutputinfo) == false) $succop = false;
			}
			if ($this->cmp_req('del_revisfiles', 'yes', true, false) && ($this->configs['cache_del_revisfiles'])) {
				if ($this->rmeverything_revis($this->revisdir, $this->revisdir, $theoutputinfo) == false) $succop == false;
			}
			ptln('<strong>'.$this->lang['numfilesdel'].' '.$this->filedels.'<br />'.$this->lang['numdirsdel'].' '.$this->dirdels.'</strong><br />');
			ptln('</th></tr>');
			if ($succop)
				ptln('<tr><th>'.$this->lang['successrevisions'].'</th></tr>');
			else
				ptln('<tr><th>'.$this->lang['failedrevisions'].'</th></tr>');
			ptln('</table>');
			ptln('<table class="inline">');
			ptln('<tr><th class="centeralign">');
			ptln('<form method="post" action="'.wl($ID).'"><div class="no">');
			ptln('<input type="hidden" name="do" value="admin" />');
			ptln('<input type="hidden" name="page" value="cacherevisionserase" />');
			ptln('<input type="hidden" name="cmd" value="main" />');
			ptln('<input type="submit" class="button" value="'.$this->lang['backbtn'].'" />');
			ptln('</div></form></th></tr></table>');
		} else {
			// Controls
			ptln('<table class="inline">');
			ptln('<tr><th class="centeralign">');
			if ($this->configs['allow_allcachedel']) {
				ptln($this->lang['cachedesc'].'</th></tr><tr><th class="leftalign"><br/>');
				ptln('<form method="post" action="'.wl($ID).'" onsubmit="return confirm(\''.str_replace('\\\\n','\\n',addslashes($this->lang['askcache'])).'\')">');
				ptln('<input type="hidden" name="do" value="admin" />');
				ptln('<input type="hidden" name="page" value="cacherevisionserase" />');
				ptln('<input type="hidden" name="cmd" value="erasecache" />');
				if ($this->configs['cache_delext_i'] < 0)
					ptln('<input type="checkbox" name="delfl_i" value="yes" '.(($this->configs['cache_delext_i']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['extdesc_i'].'<br />');
				else
					ptln('<input type="checkbox" name="delfl_i" value="yes" '.($this->configs['cache_delext_i'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['extdesc_i'].'<br />');
				if ($this->configs['cache_delext_xhtml'] < 0)
					ptln('<input type="checkbox" name="delfl_xhtml" value="yes" '.(($this->configs['cache_delext_xhtml']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['extdesc_xhtml'].'<br />');
				else
					ptln('<input type="checkbox" name="delfl_xhtml" value="yes" '.($this->configs['cache_delext_xhtml'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['extdesc_xhtml'].'<br />');
				if ($this->configs['cache_delext_js'] < 0)
					ptln('<input type="checkbox" name="delfl_js" value="yes" '.(($this->configs['cache_delext_js']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['extdesc_js'].'<br />');
				else
					ptln('<input type="checkbox" name="delfl_js" value="yes" '.($this->configs['cache_delext_js'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['extdesc_js'].'<br />');
				if ($this->configs['cache_delext_css'] < 0)
					ptln('<input type="checkbox" name="delfl_css" value="yes" '.(($this->configs['cache_delext_css']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['extdesc_css'].'<br />');
				else
					ptln('<input type="checkbox" name="delfl_css" value="yes" '.($this->configs['cache_delext_css'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['extdesc_css'].'<br />');
				if ($this->configs['cache_delext_mediaP'] < 0)
					ptln('<input type="checkbox" name="delfl_mediaP" value="yes" '.(($this->configs['cache_delext_mediaP']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['extdesc_mediaP'].'<br />');
				else
					ptln('<input type="checkbox" name="delfl_mediaP" value="yes" '.($this->configs['cache_delext_mediaP'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['extdesc_mediaP'].'<br />');
				if ($this->configs['cache_delext_UNK'] < 0)
					ptln('<input type="checkbox" name="delfl_UNK" value="yes" '.(($this->configs['cache_delext_UNK']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['extdesc_UNK'].'<br />');
				else
					ptln('<input type="checkbox" name="delfl_UNK" value="yes" '.($this->configs['cache_delext_UNK'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['extdesc_UNK'].'<br />');
				if ($this->configs['cache_del_oldlocks'] < 0)
					ptln('<input type="checkbox" name="del_oldpagelocks" value="yes" '.(($this->configs['cache_del_oldlocks']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['deloldlockdesc'].'<br />');
				else
					ptln('<input type="checkbox" name="del_oldpagelocks" value="yes" '.($this->configs['cache_del_oldlocks'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['deloldlockdesc'].'<br />');
				if ($this->configs['cache_del_indexing'] < 0)
					ptln('<input type="checkbox" name="del_indexing" value="yes" '.(($this->configs['cache_del_indexing']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['delindexingdesc'].'<br />');
				else
					ptln('<input type="checkbox" name="del_indexing" value="yes" '.($this->configs['cache_del_indexing'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['delindexingdesc'].'<br />');
				ptln('<br />');
				if ($this->configs['allow_outputinfo']) {
					ptln($this->lang['outputinfo_text'].' <input type="radio" name="level_outputinfo" value="0" '.($this->configs['level_outputinfo']==0 ? 'checked="checked"' : '').' />'.$this->lang['outputinfo_lvl0']);
					ptln('<input type="radio" name="level_outputinfo" value="1" '.($this->configs['level_outputinfo']==1 ? 'checked="checked"' : '').' />'.$this->lang['outputinfo_lvl1']);
					ptln('<input type="radio" name="level_outputinfo" value="2" '.($this->configs['level_outputinfo']==2 ? 'checked="checked"' : '').' />'.$this->lang['outputinfo_lvl2']);
				} else {
					if ($this->configs['level_outputinfo'] == 0) {
						ptln('<input type="hidden" name="level_outputinfo" value="0" />'.$this->lang['outputinfo_text'].' '.$this->lang['outputinfo_lvl0']);
					} else if ($this->configs['level_outputinfo'] == 1) {
						ptln('<input type="hidden" name="level_outputinfo" value="1" />'.$this->lang['outputinfo_text'].' '.$this->lang['outputinfo_lvl1']);
					} else if ($this->configs['level_outputinfo'] == 2) {
						ptln('<input type="hidden" name="level_outputinfo" value="2" />'.$this->lang['outputinfo_text'].' '.$this->lang['outputinfo_lvl2']);
					}
				}
				ptln('<br /><br /><div class="centeralign"><input type="submit" class="button" value="'.$this->lang['erasecachebtn'].'" /></div>');
				ptln('</form>');
			} else {
				ptln($this->lang['cachedisabled'].'<br />');
			}
			ptln('</th></tr><tr><td style="border-style: none">&nbsp;<br /></td></tr>');
			ptln('<tr><th class="centeralign">');
			if ($this->configs['allow_allrevisdel']) {
				ptln($this->lang['revisionsdesc'].'</th></tr><tr><th class="leftalign"><br />');
				ptln('<form method="post" action="'.wl($ID).'" onsubmit="return confirm(\''.str_replace('\\\\n','\\n',addslashes($this->lang['askrevisions'])).'\')">');
				ptln('<input type="hidden" name="do" value="admin" />');
				ptln('<input type="hidden" name="page" value="cacherevisionserase" />');
				ptln('<input type="hidden" name="cmd" value="eraseallrevisions" />');
				if ($this->configs['cache_del_metafiles'] < 0)
					ptln('<input type="checkbox" name="del_metafiles" value="yes" '.(($this->configs['cache_del_metafiles']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['delmetadesc'].'<br />');
				else
					ptln('<input type="checkbox" name="del_metafiles" value="yes" '.($this->configs['cache_del_metafiles'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['delmetadesc'].'<br />');
				if ($this->configs['cache_del_revisfiles'] < 0)
					ptln('<input type="checkbox" name="del_revisfiles" value="yes" '.(($this->configs['cache_del_revisfiles']+2) ? 'checked="checked"' : '').' />&nbsp;'.$this->lang['delrevisdesc'].'<br />');
				else
					ptln('<input type="checkbox" name="del_revisfiles" value="yes" '.($this->configs['cache_del_revisfiles'] ? 'checked="checked"' : '').' disabled />&nbsp;'.$this->lang['delrevisdesc'].'<br />');
				ptln('<br />');
				if ($this->configs['allow_outputinfo']) {
					ptln($this->lang['outputinfo_text'].' <input type="radio" name="level_outputinfo" value="0" '.($this->configs['level_outputinfo']==0 ? 'checked="checked"' : '').' />'.$this->lang['outputinfo_lvl0']);
					ptln('<input type="radio" name="level_outputinfo" value="1" '.($this->configs['level_outputinfo']==1 ? 'checked="checked"' : '').' />'.$this->lang['outputinfo_lvl1']);
					ptln('<input type="radio" name="level_outputinfo" value="2" '.($this->configs['level_outputinfo']==2 ? 'checked="checked"' : '').' />'.$this->lang['outputinfo_lvl2']);
				} else {
					if ($this->configs['level_outputinfo'] == 0) {
						ptln('<input type="hidden" name="level_outputinfo" value="0" />'.$this->lang['outputinfo_text'].' '.$this->lang['outputinfo_lvl0']);
					} else if ($this->configs['level_outputinfo'] == 1) {
						ptln('<input type="hidden" name="level_outputinfo" value="1" />'.$this->lang['outputinfo_text'].' '.$this->lang['outputinfo_lvl1']);
					} else if ($this->configs['level_outputinfo'] == 2) {
						ptln('<input type="hidden" name="level_outputinfo" value="2" />'.$this->lang['outputinfo_text'].' '.$this->lang['outputinfo_lvl2']);
					}
				}
				ptln('<br /><br /><p class="centeralign"><input type="submit" class="button" value="'.$this->lang['eraserevisionsbtn'].'" /></p>');
				ptln('<div class="centeralign"><em>'.$this->lang['revisionswarn'].'</em></div>');
				ptln('</form>');
			} else {
				ptln($this->lang['revisdisabled'].'<br />');
			}
			ptln('</th></tr></table>');
		}
		ptln('<br /><a href="http://wiki.splitbrain.org/plugin:cacherevisionseraser" class="urlextern" target="_blank">'.$this->lang['searchyounewversionurl'].'</a> [English only]<br />');
	}

	/**
	* Delete all files into cache directory
	*/
	function rmeverything_cache($fileglob, $basedir, $params, $outputinfo)
	{
		$fileglob2 = substr($fileglob, strlen($basedir));
		if (strpos($fileglob, '*') !== false) {
			foreach (glob($fileglob) as $filename) {
				$this->rmeverything_cache($filename, $basedir, $params, $outputinfo);
			}
		} else if (is_file($fileglob)) {
			if (strcmp($fileglob2, '/_dummy') == 0) return true;
			$pathinfor = pathinfo($fileglob2);
			if (strcmp($basedir, dirname($fileglob)) == 0) {
				if (!($params & 0x02)) return true;
			} else {
				if (substr_count(strtolower($pathinfor['basename']), '.media.') > 0) {
					if (!($params & 0x40)) return true;
				} else if (strcmp(strtolower($pathinfor['extension']), 'i') == 0) {
					if (!($params & 0x04)) return true;
				} else if (strcmp(strtolower($pathinfor['extension']), 'xhtml') == 0) {
					if (!($params & 0x08)) return true;
				} else if (strcmp(strtolower($pathinfor['extension']), 'js') == 0) {
					if (!($params & 0x10)) return true;
				} else if (strcmp(strtolower($pathinfor['extension']), 'css') == 0) {
					if (!($params & 0x20)) return true;
				} else {
					if (!($params & 0x01)) return true;
				}
			}
			if (@unlink($fileglob)) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletefile'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['cache_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				$this->filedels++;
				return true;
			} else {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletefileerr'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['cache_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				return false;
			}
		} else if (is_dir($fileglob)) {
			$ok = $this->rmeverything_cache($fileglob.'/*', $basedir, $params, $outputinfo);
			if (!$ok) return false;
			if (strcmp($fileglob, $basedir) == 0) return true;
			if (@rmdir($fileglob)) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletedir'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['cache_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				$this->dirdels++;
				return true;
			} else {
				return true;
			}
		} else {
			// Woha, this shouldn't never happen...
			if ($outputinfo > 0) ptln('<strong>'.$this->lang['pathclasserror'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['cache_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
			return false;
		}
		return true;
	}

	/**
	* Delete all old lost locks into "data/pages" or "data/locks" directory
	*/
	function rmeverything_oldlockpages($fileglob, $basedir, $outputinfo)
	{
		$fileglob2 = substr($fileglob, strlen($basedir));
		if (strpos($fileglob, '*') !== false) {
			foreach (glob($fileglob) as $filename) {
				$this->rmeverything_oldlockpages($filename, $basedir, $outputinfo);
			}
		} else if (is_file($fileglob)) {
			if (strcmp($fileglob2, '/_dummy') == 0) return true;
			$pathinfor = pathinfo($fileglob2);
			if (strcmp(strtolower($pathinfor['extension']), 'lock') != 0) return true;
			if (time()-@filemtime($fileglob) < $this->locktime) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['lockexpirein'].' '.($this->locktime-(time()-@filemtime($fileglob))).' '.$this->lang['seconds'].'</strong> -&gt; <em>"'.$fileglob2.'"</em>.<br />');
				return true;
			}
			if (@unlink($fileglob)) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletefile'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['lock_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				$this->filedels++;
				return true;
			} else {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletefileerr'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['lock_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				return false;
			}
		} else if (is_dir($fileglob)) {
			$ok = $this->rmeverything_oldlockpages($fileglob.'/*', $basedir, $outputinfo);
			if (!$ok) return false;
			if (strcmp($fileglob, $basedir) == 0) return true;
			if (@rmdir($fileglob)) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletedir'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['lock_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				$this->dirdels++;
				return true;
			} else {
				return true;
			}
		} else {
			// Woha, this shouldn't never happen...
			if ($outputinfo > 0) ptln('<strong>'.$this->lang['pathclasserror'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['lock_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
			return false;
		}
		return true;
	}

	/**
	* Delete all files into meta directory
	*/
	function rmeverything_meta($fileglob, $basedir, $outputinfo)
	{
		$fileglob2 = substr($fileglob, strlen($basedir));
		if (strpos($fileglob, '*') !== false) {
			foreach (glob($fileglob) as $filename) {
				$this->rmeverything_meta($filename, $basedir, $outputinfo);
			}
		} else if (is_file($fileglob)) {
			if (strcmp($fileglob2, '/_dummy') == 0) return true;
			$pathinfor = pathinfo($fileglob2);                                              // For compatibility with the following:
			if (strcmp(strtolower($pathinfor['extension']), 'comments') == 0) return true;  //  Discussion Plugin
			if (strcmp(strtolower($pathinfor['extension']), 'doodle') == 0) return true;    //  Doodle & Doodle2 Plugins
			if (@unlink($fileglob)) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletefile'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['meta_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				$this->filedels++;
				return true;
			} else {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletefileerr'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['meta_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				return false;
			}
		} else if (is_dir($fileglob)) {
			$ok = $this->rmeverything_meta($fileglob.'/*', $basedir, $outputinfo);
			if (!$ok) return false;
			if (strcmp($fileglob, $basedir) == 0) return true;
			if (@rmdir($fileglob)) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletedir'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['meta_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				$this->dirdels++;
				return true;
			} else {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletedirerr'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['meta_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				return false;
			}
		} else {
			// Woha, this shouldn't never happen...
			if ($outputinfo > 0) ptln('<strong>'.$this->lang['pathclasserror'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['meta_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
			return false;
		}
		return true;
	}

	/**
	* Delete all files into old revisions directory
	*/
	function rmeverything_revis($fileglob, $basedir, $outputinfo)
	{
		$fileglob2 = substr($fileglob, strlen($basedir));
		if (strpos($fileglob, '*') !== false) {
			foreach (glob($fileglob) as $filename) {
				$this->rmeverything_revis($filename, $basedir, $outputinfo);
			}
		} else if (is_file($fileglob)) {
			if (strcmp($fileglob2, '/_dummy') == 0) return true;
			if (@unlink($fileglob)) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletefile'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['revis_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				$this->filedels++;
				return true;
			} else {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletefileerr'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['revis_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				return false;
			}
		} else if (is_dir($fileglob)) {
			$ok = $this->rmeverything_revis($fileglob.'/*', $basedir, $outputinfo);
			if (!$ok) return false;
			if (strcmp($fileglob, $basedir) == 0) return true;
			if (@rmdir($fileglob)) {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletedir'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['revis_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				$this->dirdels++;
				return true;
			} else {
				if ($outputinfo > 0) ptln('<strong>'.$this->lang['deletedirerr'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['revis_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
				return false;
			}
		} else {
			// Woha, this shouldn't never happen...
			if ($outputinfo > 0) ptln('<strong>'.$this->lang['pathclasserror'].'</strong>'.(($outputinfo==2) ? ' ('.$this->lang['revis_word'].') ' : ' ').'<em>"'.$fileglob2.'"</em>.<br />');
			return false;
		}
		return true;
	}

	/**
	* Routine to analyze configurations and directories
	*/
	function analyzecrpt($cmd)
	{
		global $ID;

		$analizysucessy = true;
		if ($this->configs['confrevision'] == 0) {
			ptln('<strong>'.$this->lang['analyze_confmissingfailed'].' (ERR: 1)</strong><br />');
			$analizysucessy = false;
		}
		if (($this->configs['confrevision'] != CACHEREVISIONSERASER_CONFIGREVISION) && ($analizysucessy)) {
			ptln('<strong>'.$this->lang['analyze_confrevisionfailed'].' (ERR: 2)</strong><br />');
			$analizysucessy = false;
		}
		if ($analizysucessy == false) {
			if (strcmp($cmd, 'createconf') == 0) {
				$this->writeconfigs();
				ptln('<strong>'.$this->lang['analyze_creatingdefconfs']);
				if (file_exists(dirname(__FILE__).'/configs.php')) {
					ptln($this->lang['analyze_creatingdefconfs_o']);
				} else ptln($this->lang['analyze_creatingdefconfs_x']);
				ptln('</strong><br /><br /><form method="post" action="'.wl($ID).'">');
				ptln('<input type="hidden" name="do" value="admin" />');
				ptln('<input type="hidden" name="page" value="cacherevisionserase" />');
				ptln('<input type="hidden" name="cmd" value="main" />');
				ptln('<input type="submit" class="button" value="'.$this->lang['reanalyzebtn'].'" />');
				ptln('</form><br />');
			} else {
				ptln('<br /><form method="post" action="'.wl($ID).'"><div class="no">');
				ptln('<input type="hidden" name="do" value="admin" />');
				ptln('<input type="hidden" name="page" value="cacherevisionserase" />');
				ptln('<input type="hidden" name="cmd" value="createconf" />');
				ptln('<table width="100%" class="inline"><tr>');
				ptln('<th width="100">&nbsp;</th>');
				ptln('<th width="120"><strong>'.$this->lang['wordb_option'].'</strong></th>');
				ptln('<th><strong>'.$this->lang['wordb_optiondesc'].'</strong></th></tr><tr>');
				ptln('<td />');
				ptln('<td><input type="text" name="menusort" value="67" maxlength="2" size="2" /></td>');
				ptln('<td>'.$this->lang['cfgdesc_menusort'].'</td>');
				ptln('</tr><tr><th />');
				ptln('<th><strong>'.$this->lang['wordb_enable'].'</strong></th>');
				ptln('<th><strong>'.$this->lang['wordb_optiondesc'].'</strong></th>');
				ptln('</tr><tr><td />');
				ptln('<td><input type="checkbox" name="allow_allcachedel_E" value="yes" checked="checked" /></td>');
				ptln('<td>'.$this->lang['delxcacheclass'].'</td>');
				ptln('</tr><tr><td />');
				ptln('<td><input type="checkbox" name="allow_allrevisdel_E" value="yes" checked="checked" /></td>');
				ptln('<td>'.$this->lang['delxrevisclass'].'</td>');
				ptln('</tr><tr><td />');
				ptln('<td><input type="checkbox" name="allow_debug_E" value="yes" /></td>');
				ptln('<td>'.$this->lang['delxdebugmode'].'</td>');
				ptln('</tr><tr>');
				ptln('<th><strong>'.$this->lang['wordb_allowuserchag'].'</strong></th>');
				ptln('<th><strong>'.$this->lang['wordb_checkedasdef'].'</strong></th>');
				ptln('<th><strong>'.$this->lang['wordb_optiondesc'].'</strong></th>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="delext_i_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="delext_i_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['extdesc_i'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="delext_xhtml_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="delext_xhtml_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['extdesc_xhtml'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="delext_js_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="delext_js_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['extdesc_js'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="delext_css_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="delext_css_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['extdesc_css'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="delext_mediaP_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="delext_mediaP_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['extdesc_mediaP'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="delext_UNK_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="delext_UNK_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['extdesc_UNK'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="del_oldlock_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="del_oldlock_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['deloldlockdesc'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="del_indexing_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="del_indexing_C" value="yes" /></td>');
				ptln('<td>' . $this->lang['delindexingdesc'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="del_meta_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="del_meta_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['delmetadesc'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="del_revis_A" value="yes" checked="checked" /></td>');
				ptln('<td><input type="checkbox" name="del_revis_C" value="yes" checked="checked" /></td>');
				ptln('<td>' . $this->lang['delrevisdesc'] . '</td>');
				ptln('</tr><tr>');
				ptln('<td><input type="checkbox" name="allow_outputinfo" value="yes" checked="checked" /></td>');
				ptln('<td><input type="radio" name="level_outputinfo" value="0" />'.$this->lang['outputinfo_lvl0'].'<br />');
				ptln('<input type="radio" name="level_outputinfo" value="1" />'.$this->lang['outputinfo_lvl1'].'<br />');
				ptln('<input type="radio" name="level_outputinfo" value="2" checked="checked" />'.$this->lang['outputinfo_lvl2']);
				ptln('</td><td>'.$this->lang['delxverbose'].'</td>');
				ptln('</tr><tr><th /><th />');
				ptln('<th><input type="submit" class="button" value="'.$this->lang['createconfbtn'].'" /></th>');
				ptln('</tr></table></div></form>');
			}
		}
		if (!is_dir($this->cachedir)) {
			ptln('<strong>'.$this->lang['analyze_cachedirfailed'].' (ERR: 3)</strong><br />');
			$analizysucessy = false;
		}
		if (!is_dir($this->revisdir)) {
			ptln('<strong>'.$this->lang['analyze_revisdirfailed'].' (ERR: 4)</strong><br />');
			$analizysucessy = false;
		}
		if (!is_dir($this->pagesdir)) {
			ptln('<strong>'.$this->lang['analyze_pagesdirfailed'].' (ERR: 5)</strong><br />');
			$analizysucessy = false;
		}
		if (!is_dir($this->metadir)) {
			ptln('<strong>'.$this->lang['analyze_metadirfailed'].' (ERR: 6)</strong><br />');
			$analizysucessy = false;
		}
		if (!is_dir($this->locksdir)) {
			ptln('<strong>'.$this->lang['analyze_locksdirfailed'].' (ERR: 7)</strong><br />');
			$analizysucessy = false;
		}
		if ($analizysucessy == false) {
			ptln('<br /><strong>'.$this->lang['analyze_checkreadme'].'</strong><br />');
		}
		return $analizysucessy;
	}

	/**
	* Routine to create "configs.php"
	*/
	function writeconfigs()
	{
		global $lang;
		$cahdelext_i = -2 + $this->cmp_req('delext_i_A', 'yes', 0, 2) + $this->cmp_req('delext_i_C', 'yes', 1, 0);
		$cahdelext_xhtml = -2 + $this->cmp_req('delext_xhtml_A', 'yes', 0, 2) + $this->cmp_req('delext_xhtml_C', 'yes', 1, 0);
		$cahdelext_js = -2 + $this->cmp_req('delext_js_A', 'yes', 0, 2) + $this->cmp_req('delext_js_C', 'yes', 1, 0);
		$cahdelext_css = -2 + $this->cmp_req('delext_css_A', 'yes', 0, 2) + $this->cmp_req('delext_css_C', 'yes', 1, 0);
		$cahdelext_mediaP = -2 + $this->cmp_req('delext_mediaP_A', 'yes', 0, 2) + $this->cmp_req('delext_mediaP_C', 'yes', 1, 0);
		$cahdelext_UNK = -2 + $this->cmp_req('delext_UNK_A', 'yes', 0, 2) + $this->cmp_req('delext_UNK_C', 'yes', 1, 0);
		$cahdel_oldlocks = -2 + $this->cmp_req('del_oldlock_A', 'yes', 0, 2) + $this->cmp_req('del_oldlock_C', 'yes', 1, 0);
		$cahdel_indexing = -2 + $this->cmp_req('del_indexing_A', 'yes', 0, 2) + $this->cmp_req('del_indexing_C', 'yes', 1, 0);
		$cahdel_metafiles = -2 + $this->cmp_req('del_meta_A', 'yes', 0, 2) + $this->cmp_req('del_meta_C', 'yes', 1, 0);
		$cahdel_revisfiles = -2 + $this->cmp_req('del_revis_A', 'yes', 0, 2) + $this->cmp_req('del_revis_C', 'yes', 1, 0);
		$wcnf = fopen(dirname(__FILE__).'/configs.php', 'w');
		fwrite($wcnf, "<?php\n/**\n * Cache/Revisions Eraser configuration file\n *\n * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)\n * @author     JustBurn <justburner@armail.pt>\n *\n *\n");
		fwrite($wcnf, " * Generated automatically by the plug-in, Cache/Revisions Eraser v" . CACHEREVISIONSERASER_VER . "\n *\n */\n\n");
		fwrite($wcnf, '$this->configs[\'confrevision\'] = 2;' . "\n");
		if ((intval($this->get_req('menusort','67')) >= 0) && (intval($this->get_req('menusort','67')) <= 99))
			fwrite($wcnf, '$this->configs[\'menusort\'] = ' . intval($this->get_req('menusort','67')) . ";\n");
		else
			fwrite($wcnf, '$this->configs[\'menusort\'] = 67' . ";\n");
		fwrite($wcnf, '$this->configs[\'allow_allcachedel\'] = ' . $this->cmp_req('allow_allcachedel_E', 'yes', 'true', 'false') . ";\n");
		fwrite($wcnf, '$this->configs[\'allow_allrevisdel\'] = ' . $this->cmp_req('allow_allrevisdel_E', 'yes', 'true', 'false') . ";\n");
		fwrite($wcnf, '$this->configs[\'debuglist\'] = ' . $this->cmp_req('allow_debug_E', 'yes', 'true', 'false') . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_delext_i\'] = ' . $cahdelext_i . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_delext_xhtml\'] = ' . $cahdelext_xhtml . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_delext_js\'] = ' . $cahdelext_js . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_delext_css\'] = ' . $cahdelext_css . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_delext_mediaP\'] = ' . $cahdelext_mediaP . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_delext_UNK\'] = ' . $cahdelext_UNK . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_del_oldlocks\'] = ' . $cahdel_oldlocks . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_del_indexing\'] = ' . $cahdel_indexing . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_del_metafiles\'] = ' . $cahdel_metafiles . ";\n");
		fwrite($wcnf, '$this->configs[\'cache_del_revisfiles\'] = ' . $cahdel_revisfiles . ";\n");
		fwrite($wcnf, '$this->configs[\'allow_outputinfo\'] = ' . $this->cmp_req('allow_outputinfo', 'yes', 'true', 'false') . ";\n");
		if ((intval($this->get_req('level_outputinfo','0')) >= 0) && (intval($this->get_req('level_outputinfo','0')) <= 2))
			fwrite($wcnf, '$this->configs[\'level_outputinfo\'] = ' . intval($this->get_req('level_outputinfo','0')) . ";\n");
		else
			fwrite($wcnf, '$this->configs[\'level_outputinfo\'] = 0'.";\n");
		fwrite($wcnf, "\n\n?>");
		fclose($wcnf);
	}

}

?>
