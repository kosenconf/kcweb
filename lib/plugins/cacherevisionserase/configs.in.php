<?php
/**
 * Cache/Revisions Eraser configuration file
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     JustBurn <justburner@armail.pt>
 *
 *
 * About 4 states option:
 *
 * -2 = Default no, allow user to change it
 * -1 = Default yes, allow user to change it
 * 0  = Force no, user can't change it
 * 1  = Force yes, user can't change it
 */

$this->configs['confrevision'] = 2;          // Configurations file revision, LEAVE THIS UNCHANGED!
$this->configs['menusort'] = 67;             // position in admin menu (Default: 67)

$this->configs['allow_allcachedel'] = true;  // Allow delection of cache class? false=No true=Yes (Default: true)
$this->configs['allow_allrevisdel'] = true;  // Allow delection of old revisions class? false=No true=Yes (Default: true)
$this->configs['debuglist'] = false;         // For debugging only, show some internal information (Default: false)
$this->configs['cache_delext_i'] = -1;       // Delete extension ".i"?  4 states option (Default: -1)
$this->configs['cache_delext_xhtml'] = -1;   // Delete extension ".xhtml"?  4 states option (Default: -1)
$this->configs['cache_delext_js'] = -1;      // Delete extension ".js"?  4 states option (Default: -1)
$this->configs['cache_delext_css'] = -1;     // Delete extension ".css"?  4 states option (Default: -1)
$this->configs['cache_delext_mediaP'] = -1;  // Delete extension ".media.*"?  4 states option (Default: -1)
$this->configs['cache_delext_UNK'] = -1;     // Delete all other unknown extensions?  4 states option (Default: -1)
$this->configs['cache_del_oldlocks'] = -1;   // Delete old lost page locks?  4 states option (Default: -1)
$this->configs['cache_del_indexing'] = -2;   // Delete Indexing-search?  4 states option (Default: -2)
$this->configs['cache_del_metafiles'] = -1;  // Delete meta files?  4 states option (Default: -1)
$this->configs['cache_del_revisfiles'] = -1; // Delete old revisions files?  4 states option (Default: -1)

$this->configs['allow_outputinfo'] = true;  // Allow to change verbose level? false=No true=Yes (Default: true)
$this->configs['level_outputinfo'] = 2;     // Default verbose level... 0=Silent, 1=Filenames Only, 2=All (Default: 2)

?>
