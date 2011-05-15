<?php
/**
 * Spanish language file
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Bernabé García <dklight@gmail.com>
 */

$lang['encoding']                      = 'utf-8';
$lang['direction']                     = 'ltr';
$lang['utf8supportrequired']           = true;
$lang['language']                      = 'Spanish'; // Debug only, leave it untranslated
$lang['menu']                          = 'Borrar cache/revisiones';
$lang['title']                         = 'Borrar Cache/Revisiones';
$lang['desc']                          = 'Borrar el cache del wiki y las revisiones viejas';
$lang['successcache']                  = 'Operación exitosa';
$lang['successrevisions']              = 'Operación exitosa';
$lang['failedcache']                   = 'Error durante la operación, revisar permisos de archivos.';
$lang['failedrevisions']               = 'Error durante la operación, revisar permisos de archivos.';
$lang['deletefile']                    = 'Archivo borrado';
$lang['deletefileerr']                 = 'No se pudo borrar el archivo';
$lang['deletedir']                     = 'Directorio eliminado';
$lang['deletedirerr']                  = 'No se pudo borrar el directorio';
$lang['erasecachebtn']                 = 'Comenzar (cache)';
$lang['eraserevisionsbtn']             = 'Comenzar (revisiones viejas)';
$lang['askcache']                      = 'Está seguro que desea proceder?';
$lang['askrevisions']                  = 'Está seguro que desea proceder?';
$lang['cachedesc']                     = '[[ Opciones de Cache ]]';
$lang['revisionsdesc']                 = '[[ Opciones de revisiones viejas ]]';
$lang['revisionswarn']                 = 'Nota: Una vez que las revisiones viejas son borradas, no existe forma de recupoerarlas.';
$lang['backbtn']                       = 'Volver atrás';
$lang['cachedisabled']                 = 'La operación borrar todo el cache ha sido deshabilitada';
$lang['revisdisabled']                 = 'La operación borrar todas las revisiones viejas ha sido deshabilitada';
$lang['extdesc_i']                     = 'Archivos .i (Backlinks y demás???)';
$lang['extdesc_xhtml']                 = 'Archivos .xhtml (HTML en cache de páginas wiki)';
$lang['extdesc_js']                    = 'Archivos .js (Javascript en cache)';
$lang['extdesc_css']                   = 'Archivos .css (Hojas de estilo CSS en cache)';
$lang['extdesc_mediaP']                = 'Archivos .media.* (Archivos multimedia en cache)';
$lang['extdesc_UNK']                   = 'Todos los demás formatos desconocidos';
$lang['delindexingdesc']               = 'Archivos de búsqueda indexada (no recomendado)';
$lang['delmetadesc']                   = 'Historial de revisiones viejas (meta/*)';
$lang['deloldlockdesc']                = 'Viejos bloqueos de página perdidos (*.lock)';
$lang['lockexpirein']                  = 'Bloqueo expirará en ';
$lang['seconds']                       = ' segundos';
$lang['version']                       = 'versión';
$lang['delrevisdesc']                  = 'Viejos archivos de revisiones (attic/*)';
$lang['pathclasserror']                = 'No se puede detectar la ruta de';
$lang['analyze_confmissingfailed']     = 'ERROR: Archivos de configuración erroneos o inexistentes';
$lang['analyze_confrevisionfailed']    = 'ERROR: Archivos de configuración incompatibles';
$lang['analyze_cachedirfailed']        = 'ERROR: El plug-in ha fallado al obtener el directorio de cache.<br />Utilize el debuggeer para chequear la variable cachedir';
$lang['analyze_revisdirfailed']        = 'ERROR: El plug-in ha fallado al obtener el directorio de revisiones.<br />Utilize el debuggeer para chequear la variable revisdir';
$lang['analyze_pagesdirfailed']        = 'ERROR: El plug-in ha fallado al obtener el directorio de páginas<br />Utilize el debuggeer para chequear la variable pagesdir';
$lang['analyze_metadirfailed']         = 'ERROR: El plug-in ha fallado al obtener el directorio de metadata<br />Utilize el debuggeer para chequear la variable metadir';
$lang['analyze_locksdirfailed']        = 'ERROR: El plug-in ha fallado al obtener el directorio de bloqueos<br />Utilize el debuggeer para chequear la variable locksdir';
$lang['analyze_checkreadme']           = 'Para obtener más información sobre este error revise el archivo readme.txt o la página oficial del plugin .';
$lang['analyze_creatingdefconfs']      = 'Creando los archivos de configuración... ';
$lang['analyze_creatingdefconfs_x']    = 'error (el directorio del plugin C/R erase no permite escritura)';
$lang['analyze_creatingdefconfs_o']    = 'operación exitosa (por favor vuelva a analizar)';
$lang['yesbtn']                        = 'Sí';
$lang['nobtn']                         = 'No';
$lang['reanalyzebtn']                  = 'Volver a analizar';
$lang['cache_word']                    = 'cache';
$lang['lock_word']                     = 'bloqueo';
$lang['meta_word']                     = 'metadata';
$lang['oldrevis_word']                 = 'revisiones viejas';
$lang['delxcacheclass']                = 'Mostrar clase de cache';
$lang['delxrevisclass']                = 'Mostrar clase de revisiones';
$lang['delxdebugmode']                 = 'Modo debug';
$lang['delxverbose']                   = 'Nivel de reporte mientras se procesa la limpieza';
$lang['wordb_enable']                  = 'Hyabilitado';
$lang['wordb_option']                  = 'Opción';
$lang['wordb_optiondesc']              = 'Descripción de la opción';
$lang['wordb_allowuserchag']           = 'Permitir cambio';
$lang['wordb_checkedasdef']            = 'Seleccionado por omisión';
$lang['createconfbtn']                 = 'Crear config.php';
$lang['searchyounewversionurl']        = 'Visitar el sitio web oficial del plugin Cache and Revisions Eraser (Se abre en una ventana nueva)';
$lang['outputinfo_text']               = 'Reporte:';
$lang['outputinfo_lvl0']               = 'Silencioso';
$lang['outputinfo_lvl1']               = 'Sólo nombres de acrchivos';
$lang['outputinfo_lvl2']               = 'Todos';
$lang['numfilesdel']                   = 'Archivos borrados:';
$lang['numdirsdel']                    = 'Directorios borrados:';
$lang['cfgdesc_menusort']              = 'Posición del menú dentro de la lista de administración (Def: 67)';

?>
