<?php
/**
 * French language file
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Flavien VIOLLET <flavien_viollet@yahoo.fr>
 * @author     Christophe Martin <Christophe.Martin AT gmx DOT com>
 */

$lang['encoding']                      = 'utf-8';
$lang['direction']                     = 'ltr';
$lang['utf8supportrequired']           = false;
$lang['language']                      = 'French'; // Debug only, leave it untranslated
$lang['menu']                          = 'Purger cache/r&eacute;visions';
$lang['title']                         = 'Purge du cache et des r&eacute;visions';
$lang['desc']                          = 'Purge le cache du wiki et/ou les r&eacute;visions';
$lang['successcache']                  = 'La purge du Cache s\'est effectu&eacute;e correctement.';
$lang['successrevisions']              = 'Les anciennes r&eacute;visions ont &eacute;t&eacute; effac&eacute;es.';
$lang['failedcache']                   = 'Erreur lors de la purge du cache, v&eacute;rifiez les permissions des fichiers.';
$lang['failedrevisions']               = 'Erreur lors de la purge des r&eacute;visions, v&eacute;rifiez les permissions des fichiers.';
$lang['deletefile']                    = 'Fichier effac&eacute;';
$lang['deletefileerr']                 = 'Effacement impossible';
$lang['deletedir']                     = 'R&eacute;pertoire supprim&eacute;';
$lang['deletedirerr']                  = 'Suppression r&eacute;pertoire impossible';
$lang['erasecachebtn']                 = 'Purger tout le cache';
$lang['eraserevisionsbtn']             = 'Purger toutes les r&eacute;visions';
$lang['askcache']                      = 'Voulez-vous supprimer la totalit&eacute; du cache ?';
$lang['askrevisions']                  = 'Voulez-vous supprimer l\'ensemble des r&eacute;visions?';
$lang['cachedesc']                     = 'Cliquez sur le bouton pour purger le cache...';
$lang['revisionsdesc']                 = 'Cliquez sur le bouton pour purger les r&eacute;visions...';
$lang['revisionswarn']                 = 'NOTE: Une fois les r&eacute;visions purg&eacute;es, il n\'est plus possible de les restaurer.';
$lang['backbtn']                       = 'Retour';
$lang['cachedisabled']                 = 'La purge du cache a &eacute;t&eacute; d&eacute;sactiv&eacute;e';
$lang['revisdisabled']                 = 'La purge des r&eacute;visions a &eacute;t&eacute; d&eacute;sactiv&eacute;e';
$lang['extdesc_i']                     = 'Fichiers .i (r&eacute;troliens et autres ???)';
$lang['extdesc_xhtml']                 = 'Fichiers .xhtml (formulaires HTML des pages)';
$lang['extdesc_js']                    = 'Fichiers .js (Cache Javascript)';
$lang['extdesc_css']                   = 'Fichiers .css (Cache feuilles CSS)';
$lang['extdesc_mediaP']                = 'Fichiers .media.* (Cache media)';
$lang['extdesc_UNK']                   = 'Tous les fichiers dans d\'autres formats';
$lang['delindexingdesc']               = 'Fichiers d\'index de recherche (non recommand&eacute;)';
$lang['delmetadesc']                   = 'Fichiers de meta donn&eacute;es (meta/*)';
$lang['deloldlockdesc']                = 'Anciens verrous de page (*.lock)';
$lang['lockexpirein']                  = 'Le verrou expirera dans';
$lang['seconds']                       = 'secondes';
$lang['version']                       = 'version';
$lang['delrevisdesc']                  = 'fichiers des anciennes r&eacute;visions (attic/*)';
$lang['pathclasserror']                = 'Impossible de d&eacute;tecter le chemin de classe de';
$lang['analyze_confmissingfailed']     = 'ERREUR: Fichier "configs.php" manquant ou incompatible';
$lang['analyze_confrevisionfailed']    = 'ERREUR: Fichier "configs.php" incompatible';
$lang['analyze_cachedirfailed']        = 'ERREUR: le greffon n\'a pas trouv&eacute; le r&eacute;pertoire du cache<br />Utilisez le d&eacute;vermineur pour v&eacute;rifier la variable "cachedir"';
$lang['analyze_revisdirfailed']        = 'ERREUR: le greffon n\'a pas trouv&eacute; le r&eacute;pertoire des r&eacute;visions<br />Utilisez le d&eacute;vermineur pour v&eacute;rifier la variable "revisdir"';
$lang['analyze_pagesdirfailed']        = 'ERREUR: le greffon n\'a pas trouv&eacute; le r&eacute;pertoire des pages<br />Utilisez le d&eacute;vermineur pour v&eacute;rifier la variable "pagesdir"';
$lang['analyze_metadirfailed']         = 'ERREUR: le greffon n\'a pas trouv&eacute; le r&eacute;pertoire de l\'historique<br />Utilisez le d&eacute;vermineur pour v&eacute;rifier la variable "metadir"';
$lang['analyze_locksdirfailed']        = 'ERREUR: le greffon n\'a pas trouv&eacute; le r&eacute;pertoire de verrous<br />Utilisez le d&eacute;vermineur pour v&eacute;rifier la variable "locksdir"';
$lang['analyze_checkreadme']           = 'Veuillez vous reporter au fichier "readme.txt" ou &agrave; la page web officielle de ce greffon pour de plus amples informations concernant cette erreur';
$lang['analyze_creatingdefconfs']      = 'Creation du fichier "configs.php"...';
$lang['analyze_creatingdefconfs_x']    = 'Erreur (le r&eacute;pertoire du greffon ne permet pas qu\'on y &eacute;crive)';
$lang['analyze_creatingdefconfs_o']    = 'Termin&eacute; (veuillez r&eacute;-analyser)';
$lang['yesbtn']                        = 'Oui';
$lang['nobtn']                         = 'Non';
$lang['reanalyzebtn']                  = 'R&eacute;-analyzer';
$lang['cache_word']                    = 'cache';
$lang['lock_word']                     = 'verrou';
$lang['meta_word']                     = 'meta';
$lang['oldrevis_word']                 = 'anc. revis.';
$lang['delxcacheclass']                = 'Activer la gestion du cache';
$lang['delxrevisclass']                = 'Activer la gestion des anciennes r&eacute;visions';
$lang['delxdebugmode']                 = 'Mode d&eacute;verminage';
$lang['delxverbose']                   = 'Affichage verbeux pendant la purge';
$lang['wordb_enable']                  = 'Activer';
$lang['wordb_option']                  = 'Option';
$lang['wordb_optiondesc']              = 'Description';
$lang['wordb_allowuserchag']           = 'Autoriser les changements';
$lang['wordb_checkedasdef']            = 'Valeur par d&eacute;faut';
$lang['createconfbtn']                 = 'Cr&eacute;er "configs.php"';
$lang['searchyounewversionurl']        = 'Visiter le site web du greffon (dans une nouvelle fen&ecirc;tre)';
$lang['outputinfo_text']               = 'affichage:';
$lang['outputinfo_lvl0']               = 'Silencieux';
$lang['outputinfo_lvl1']               = 'fichiers uniquement';
$lang['outputinfo_lvl2']               = 'Tout';
$lang['numfilesdel']                   = 'Fichiers effac&eacute;s:';
$lang['numdirsdel']                    = 'R&eacute;pertoires effac&eacute;s:';
$lang['cfgdesc_menusort']              = 'Position dans la liste d\'administration (Def: 67)';

?>
