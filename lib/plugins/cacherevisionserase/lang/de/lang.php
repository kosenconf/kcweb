<?php
/**
 * German language file
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     platinum <platinum4friends@gmx.de>
 */

$lang['encoding']                      = 'utf-8';
$lang['direction']                     = 'ltr';
$lang['utf8supportrequired']           = false;
$lang['language']                      = 'German'; // Debug only, leave it untranslated
$lang['menu']                          = 'Cache/Revisionen l&ouml;schen';
$lang['title']                         = 'Cache/Revisions Eraser';
$lang['desc']                          = 'L&ouml;sche wikis Cache und/oder alte Revisionen';
$lang['successcache']                  = 'Operation erfolgreich';
$lang['successrevisions']              = 'Operation erfolgreich';
$lang['failedcache']                   = 'Fehler w&auml;hrend der Operation, pr&uuml;fen Sie die Dateizugriffsrechte.';
$lang['failedrevisions']               = 'Fehler w&auml;hrend der Operation, pr&uuml;fen Sie die Dateizugriffsrechte.';
$lang['deletefile']                    = 'Gel&ouml;schte Datei';
$lang['deletefileerr']                 = 'Kann Datei nicht l&ouml;schen';
$lang['deletedir']                     = 'Gel&ouml;schtes Verzeichnis';
$lang['deletedirerr']                  = 'Kann Verzeichnis nicht l&ouml;schen';
$lang['erasecachebtn']                 = 'Start (Cache)';
$lang['eraserevisionsbtn']             = 'Start (Alte Revisionen)';
$lang['askcache']                      = 'Wollen Sie wirklich den Cache l&ouml;schen?';
$lang['askrevisions']                  = 'Wollen Sie wirklich die alten Revisionen l&ouml;schen?';
$lang['cachedesc']                     = '[[ Optionen: Cache ]]';
$lang['revisionsdesc']                 = '[[ Optionen: Alte Revisionen]]';
$lang['revisionswarn']                 = 'Hinwei&szlig;: Sobald die alten Revisionen einmal gel&ouml;scht sind gibt es keine M&ouml;glichkeit sie wiederherzustellen.';
$lang['backbtn']                       = 'Zur&uuml;ck';
$lang['cachedisabled']                 = 'L&ouml;schen des Caches wurde abgeschaltet';
$lang['revisdisabled']                 = 'L&ouml;schen der alten Revisionen wurde abgeschaltet';
$lang['extdesc_i']                     = '.i Dateien (Backlinks und mehr???)';
$lang['extdesc_xhtml']                 = '.xhtml Dateien (HTML Formulare auf einer Wiki Seite)';
$lang['extdesc_js']                    = '.js Dateien (Javascripte)';
$lang['extdesc_css']                   = '.css Dateien (CSS-Sheets)';
$lang['extdesc_mediaP']                = '.media.* Dateien (Media Dateien)';
$lang['extdesc_UNK']                   = 'Alle anderen unbekannten Formate';
$lang['delindexingdesc']               = 'Index Dateien (nicht empfohlen)';
$lang['delmetadesc']                   = 'Historie der alten Revisionen (meta/*)';
$lang['deloldlockdesc']                = 'Alte verlorene Page Locks (*.lock)';
$lang['lockexpirein']                  = 'Lock l&auml;uft ab in';
$lang['seconds']                       = 'Sekunden';
$lang['version']                       = 'Version';
$lang['delrevisdesc']                  = 'Alte Revisions Dateien (attic/*)';
$lang['pathclasserror']                = 'Kann Pfad der Klasse nicht finden:';
$lang['analyze_confmissingfailed']     = 'Fehler: Fehlende oder inkompatible Konfigurationsdatei';
$lang['analyze_confrevisionfailed']    = 'Fehler: Inkompatible Konfigurationsdatei';
$lang['analyze_cachedirfailed']        = 'Fehler: Plug-in konnte das \'Cache\' Verzeichnis nicht finden<br />Benutzn Sie den Debugger um die \'cachedir\' Variable zu &uuml;berpr&uuml;fen';
$lang['analyze_revisdirfailed']        = 'Fehler: Plug-in konnte das \'Revisions\' Verzeichnis nicht finden<br />Benutzn Sie den Debugger um die \'revisdir\' Variable zu &uuml;berpr&uuml;fen';
$lang['analyze_pagesdirfailed']        = 'Fehler: Plug-in konnte das \'Pages\' Verzeichnis nicht finden<br />Benutzn Sie den Debugger um die \'pagesdir\' Variable zu &uuml;berpr&uuml;fen';
$lang['analyze_metadirfailed']         = 'Fehler: Plug-in konnte das \'Meta\' Verzeichnis nicht finden<br />Benutzn Sie den Debugger um die \'metadir\' Variable zu &uuml;berpr&uuml;fen';
$lang['analyze_locksdirfailed']        = 'Fehler: Plug-in konnte das \'Locks\' Verzeichnis nicht finden<br />Benutzn Sie den Debugger um die \'locksdir\' Variable zu &uuml;berpr&uuml;fen';
$lang['analyze_checkreadme']           = 'Bitte lesen Sie die readme.txt Datei oder die offizielle Plug-in Homepage um mehr Informationen &uuml;ber diesen Fehler zu erhalten.';
$lang['analyze_creatingdefconfs']      = 'Erstelle Konfigurationsdatei...';
$lang['analyze_creatingdefconfs_x']    = 'fehl geschlagen (C/R Erase Plug-in Verzeichnis erlaubt keine Schreibvorg&auml;nge)';
$lang['analyze_creatingdefconfs_o']    = 'erfolgreich (Bitte neu analysieren)';
$lang['yesbtn']                        = 'Ja';
$lang['nobtn']                         = 'Nein';
$lang['reanalyzebtn']                  = 'Neu analysieren';
$lang['cache_word']                    = 'Cache';
$lang['lock_word']                     = 'Lock';
$lang['meta_word']                     = 'Meta';
$lang['oldrevis_word']                 = 'Alte Revis.';
$lang['delxcacheclass']                = 'Zeige Cache Klasse';
$lang['delxrevisclass']                = 'Zeige Revisions Klasse';
$lang['delxdebugmode']                 = 'Debug Modus';
$lang['delxverbose']                   = 'Ausgabe der Informationen w&auml;hrend der Reinigung.';
$lang['wordb_enable']                  = 'Einschalten';
$lang['wordb_option']                  = 'Wahl';
$lang['wordb_optiondesc']              = 'Beschreibung';
$lang['wordb_allowuserchag']           = 'Erlaube Schreiben';
$lang['wordb_checkedasdef']            = 'Standardeinstellung';
$lang['createconfbtn']                 = 'Erstelle config.php';
$lang['searchyounewversionurl']        = 'Besuch Cache and Revisions Eraser Website (&ouml;ffnet ein neues Fenster)';
$lang['outputinfo_text']               = 'Ausgabe:';
$lang['outputinfo_lvl0']               = 'Datei und Verzeichnis Z&auml;hler';
$lang['outputinfo_lvl1']               = 'Nur Dateinamen';
$lang['outputinfo_lvl2']               = 'Alles';
$lang['numfilesdel']                   = 'Dateien gel&ouml;scht:';
$lang['numdirsdel']                    = 'Verzeichnisse gel&ouml;scht:';
$lang['cfgdesc_menusort']              = 'Men&uuml; Position innerhalb der Adminliste (Def: 67)';

?>
