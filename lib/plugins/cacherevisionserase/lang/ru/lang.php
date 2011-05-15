<?php
/**
 * Russian language file
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Alexander Zubkov <az@libfl.ru>
 */

$lang['encoding']                      = 'utf-8';
$lang['direction']                     = 'ltr';
$lang['utf8supportrequired']           = true;
$lang['language']                      = 'Russian'; // Debug only, leave it untranslated
$lang['menu']                          = 'Очистка кэша и/или удаление старых версий страниц';
$lang['title']                         = 'Очистка кэша и/или удаление старых версий страниц';
$lang['desc']                          = 'Очистка кэша DokuWiki и/или удаление старых версий страниц';
$lang['successcache']                  = 'Операция завершена успешно.';
$lang['successrevisions']              = 'Операция завершена успешно.';
$lang['failedcache']                   = 'Ошибка операции, проверьте права доступа к файлам.';
$lang['failedrevisions']               = 'Ошибка операции, проверьте права доступа к файлам.';
$lang['deletefile']                    = 'Удалён файл';
$lang['deletefileerr']                 = 'Невозможно удалить файл';
$lang['deletedir']                     = 'Удалена директория';
$lang['deletedirerr']                  = 'Невозможно удалить директорию';
$lang['erasecachebtn']                 = 'Старт (кэш)';
$lang['eraserevisionsbtn']             = 'Старт (старые версии)';
$lang['askcache']                      = 'Вы уверены, что хотите продолжить?';
$lang['askrevisions']                  = 'Вы уверены, что хотите продолжить?';
$lang['cachedesc']                     = '[[ Опции очистки кэша ]]';
$lang['revisionsdesc']                 = '[[ Опции удаления истории правок ]]';
$lang['revisionswarn']                 = 'ВНИМАНИЕ: После удаления старых версий страниц<br />восстановление их невозможно.';
$lang['backbtn']                       = 'Вернуться';
$lang['cachedisabled']                 = 'Очистка кэша заблокирована в настройках';
$lang['revisdisabled']                 = 'Удаление старых версий страниц заблокировано в настройках';
$lang['extdesc_i']                     = '.i файлы (обратные ссылки и др.???)';
$lang['extdesc_xhtml']                 = '.xhtml файлы (кэшированные HTML-версии страниц)';
$lang['extdesc_js']                    = '.js файлы (кэшированные Java-скрипты)';
$lang['extdesc_css']                   = '.css файлы (кэшированные таблицы стилей)';
$lang['extdesc_mediaP']                = '.media.* файлы (кэшированные файлы мультимедиа)';
$lang['extdesc_UNK']                   = 'Все другие неизвестные форматы';
$lang['delindexingdesc']               = 'Индекс полнотекстового поиска (не рекомендуется)';
$lang['delmetadesc']                   = 'История правок страниц (meta/*)';
$lang['deloldlockdesc']                = 'Старые файлы блокировки страниц (*.lock)';
$lang['lockexpirein']                  = 'Блокировка истекает через';
$lang['seconds']                       = 'сек.';
$lang['version']                       = 'версия';
$lang['delrevisdesc']                  = 'Старые версии страниц (attic/*)';
$lang['pathclasserror']                = 'Не определен класс "path":';
$lang['analyze_confmissingfailed']     = 'ОШИБКА: Отсутствует или несовместимый файл конфигурации.';
$lang['analyze_confrevisionfailed']    = 'ОШИБКА: Несовместимый файл конфигурации.';
$lang['analyze_cachedirfailed']        = 'ОШИБКА: Плагину не удалось определить директорию кэша (cache).<br />Используйте отладчик для проверки переменной \"cachedir\"';
$lang['analyze_revisdirfailed']        = 'ОШИБКА: Плагину не удалось определить директорию версий страниц (attic).<br />Используйте отладчик для проверки переменной \"revisdir\"';
$lang['analyze_pagesdirfailed']        = 'ОШИБКА: Плагину не удалось определить директорию страниц (pages).<br />Используйте отладчик для проверки переменной \"pagesdir\"';
$lang['analyze_metadirfailed']         = 'ОШИБКА: Плагину не удалось определить директорию метафайлов (meta).<br />Используйте отладчик для проверки переменной \"metadir\"';
$lang['analyze_locksdirfailed']        = 'ОШИБКА: Плагину не удалось определить директорию блокировок (locks).<br />Используйте отладчик для проверки переменной \"locksdir\"';
$lang['analyze_checkreadme']           = 'Информацию об этой ошибке можно найти в файле readme.txt или на официальной странице плагина.';
$lang['analyze_creatingdefconfs']      = 'Создаём файл конфигурации...';
$lang['analyze_creatingdefconfs_x']    = 'ошибка (директория плагина защищена от записи).';
$lang['analyze_creatingdefconfs_o']    = 'создан (обновите окно)';
$lang['yesbtn']                        = 'Да';
$lang['nobtn']                         = 'Нет';
$lang['reanalyzebtn']                  = 'Обновить';
$lang['cache_word']                    = 'кэш';
$lang['lock_word']                     = 'временные блокировки';
$lang['meta_word']                     = 'метаданые';
$lang['oldrevis_word']                 = 'старые версии страниц';
$lang['delxcacheclass']                = 'Показать класс "cache"';
$lang['delxrevisclass']                = 'Показать класс "revisions"';
$lang['delxdebugmode']                 = 'Режим отладки';
$lang['delxverbose']                   = 'Детализация отчета по очистке';
$lang['wordb_enable']                  = 'Включить';
$lang['wordb_option']                  = 'Опции';
$lang['wordb_optiondesc']              = 'Описание опции';
$lang['wordb_allowuserchag']           = 'Разрешить изменения';
$lang['wordb_checkedasdef']            = 'Отмечено по умолчанию';
$lang['createconfbtn']                 = 'Создать config.php';
$lang['searchyounewversionurl']        = 'Посетить веб-сайт плагина (открыть в новом окне)';
$lang['outputinfo_text']               = 'Отчет:';
$lang['outputinfo_lvl0']               = 'Без отчета';
$lang['outputinfo_lvl1']               = 'Только имена файлов';
$lang['outputinfo_lvl2']               = 'Всё';
$lang['numfilesdel']                   = 'Удаленно файлов:';
$lang['numdirsdel']                    = 'Удалено директорий:';
$lang['cfgdesc_menusort']              = 'Позиция в менеджере плагинов (по умолчанию: 67)';

?>
