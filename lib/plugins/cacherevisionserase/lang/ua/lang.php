<?php
/**
 * Ukrainian language file
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Olexiy Zagorskyi <zalex_ua@i.ua>
 */

$lang['encoding']                      = 'utf-8';
$lang['direction']                     = 'ltr';
$lang['utf8supportrequired']           = true;
$lang['language']                      = 'Ukrainian'; // Debug only, leave it untranslated
$lang['menu']                          = 'Очистка кешу та/або старих версій сторінок';
$lang['title']                         = 'Очистка кешу та/або старих версій сторінок';
$lang['desc']                          = 'Очистка кешу DokuWiki та/або старих версій сторінок';
$lang['successcache']                  = 'Операцію завершено успішно.';
$lang['successrevisions']              = 'Операцію завершено успішно.';
$lang['failedcache']                   = 'Помилка операції, перевірте права доступу до файлів.';
$lang['failedrevisions']               = 'Помилка операції, перевірте права доступу до файлів.';
$lang['deletefile']                    = 'Видалений файл';
$lang['deletefileerr']                 = 'Неможливо видалити файл';
$lang['deletedir']                     = 'Видалена папка';
$lang['deletedirerr']                  = 'Неможливо видалити папку';
$lang['erasecachebtn']                 = 'Старт (кеш)';
$lang['eraserevisionsbtn']             = 'Старт (старі версії)';
$lang['askcache']                      = 'Ви впевнені що хочете продовжити?';
$lang['askrevisions']                  = 'Ви впевнені що хочете продовжити?';
$lang['cachedesc']                     = '[[ Опції очистки кешу ]]';
$lang['revisionsdesc']                 = '[[ Опції видалення історії правок ]]';
$lang['revisionswarn']                 = 'УВАГА: Після видалення старих версій сторінок<br /> їх відновлення неможливе.';
$lang['backbtn']                       = 'Повернутися';
$lang['cachedisabled']                 = 'Очистку всього кешу заблоковано в налаштуваннях';
$lang['revisdisabled']                 = 'Видалення старих версії сторінок заблоковано в налаштуваннях';
$lang['extdesc_i']                     = '.i файли (зворотні посилання та інше ???)';
$lang['extdesc_xhtml']                 = '.xhtml файли (кешовані HTML-версії сторінок)';
$lang['extdesc_js']                    = '.js файли (кешовані Java-скрипти)';
$lang['extdesc_css']                   = '.css файли (кешовані таблиці стилів)';
$lang['extdesc_mediaP']                = '.media.* файли (кешовані файли мультимедіа)';
$lang['extdesc_UNK']                   = 'Всі інші невідомі формати';
$lang['delindexingdesc']               = 'Індекс повнотекстового пошуку (не рекомендується)';
$lang['delmetadesc']                   = 'Історія правок сторінок (meta/*)';
$lang['deloldlockdesc']                = 'Старі файли блокувань сторінок (*.lock)';
$lang['lockexpirein']                  = 'Блокування закінчиться через';
$lang['seconds']                       = 'сек.';
$lang['version']                       = 'версія';
$lang['delrevisdesc']                  = 'Старі версії сторінок (attic/*)';
$lang['pathclasserror']                = 'Не можливо визначити шлях класу';
$lang['analyze_confmissingfailed']     = 'ПОМИЛКА: Відсутній або несумісний файл конфігурації.';
$lang['analyze_confrevisionfailed']    = 'ПОМИЛКА: Несумісний файл конфігурації.';
$lang['analyze_cachedirfailed']        = 'ПОМИЛКА: Плагіну не вдалось визначити директорію кешу (cache).<br />Використовуйте відладчик для перевірки змінної \"cachedir\"';
$lang['analyze_revisdirfailed']        = 'ПОМИЛКА: Плагіну не вдалось визначити директорію версій сторінок (attic).<br />Використовуйте відладчик для перевірки змінної \"revisdir\"';
$lang['analyze_pagesdirfailed']        = 'ПОМИЛКА: Плагіну не вдалось визначити директорію сторінок (pages).<br />Використовуйте відладчик для перевірки змінної \"pagesdir\"';
$lang['analyze_metadirfailed']         = 'ПОМИЛКА: Плагіну не вдалось визначити директорію метафайлів (meta).<br />Використовуйте відладчик для перевірки змінної \"metadir\"';
$lang['analyze_locksdirfailed']        = 'ПОМИЛКА: Плагіну не вдалось визначити директорію блокіровок (locks).<br />Використовуйте відладчик для перевірки змінної \"locksdir\"';
$lang['analyze_checkreadme']           = 'Інформацію про цю помилку можна знайти у файлі readme.txt або на офіційній сторінці плагіна.';
$lang['analyze_creatingdefconfs']      = 'Створюємо файл конфігурації...';
$lang['analyze_creatingdefconfs_x']    = 'помилка (директорія плагіна захищена від запису).';
$lang['analyze_creatingdefconfs_o']    = 'успішно (Будь ласка зробіть повторний аналіз)';
$lang['yesbtn']                        = 'Так';
$lang['nobtn']                         = 'Ні';
$lang['reanalyzebtn']                  = 'Повторно аналізувати';
$lang['cache_word']                    = 'кеш';
$lang['lock_word']                     = 'тимчасове блокування';
$lang['meta_word']                     = 'метадані';
$lang['oldrevis_word']                 = 'старі версії сторінок';
$lang['delxcacheclass']                = 'Показати клас "cache"';
$lang['delxrevisclass']                = 'Показати клас "revisions"';
$lang['delxdebugmode']                 = 'Режим відладки';
$lang['delxverbose']                   = 'Деталізація звіту по очистці';
$lang['wordb_enable']                  = 'Включити';
$lang['wordb_option']                  = 'Опції';
$lang['wordb_optiondesc']              = 'Опис опції';
$lang['wordb_allowuserchag']           = 'Дозволити зміни';
$lang['wordb_checkedasdef']            = 'Відмічено по замовчуванню';
$lang['createconfbtn']                 = 'Створити config.php';
$lang['searchyounewversionurl']        = 'Відвідати веб-сайт плагіна (відкриється в новому вікні)';
$lang['outputinfo_text']               = 'Звіт:';
$lang['outputinfo_lvl0']               = 'Без звіту';
$lang['outputinfo_lvl1']               = 'Тільки імена файлів';
$lang['outputinfo_lvl2']               = 'Все';
$lang['numfilesdel']                   = 'Видалено файлів:';
$lang['numdirsdel']                    = 'Видалено директорій:';
$lang['cfgdesc_menusort']              = 'Позиція в менеджері плагінів (по замовчуванню: 67)';

?>
