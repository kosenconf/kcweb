<< Cache and Revisions Eraser >>

Current Version: 1.6.6

This admin plug-in allows you to erase the entire cache and/or old wiki revisions.
Only use this plug-in if you want to clean up your wiki or if the cache gets corrupted.
I won’t take any resposibility for data lost due to wrong plug-in usage.
Once old revisions are erased; there’s no way to restore them.

Check for lastest version at "http://wiki.splitbrain.org/plugin:cacherevisionseraser"

- What’s new?

v1.6.6
  Added Ukrainian Language (Thanks Olexiy Zagorskyi)
  Compatibility with Doodle & Doodle2 plugins (Thanks schplurtz)

v1.6.5
  Repacked zip correctly again (Only affected v1.6.4, Thanks David for the report)
  Minor internal improvements

v1.6.4
  Updated French Language (Thanks Christophe Martin) 
  Updated German Language (Thanks Arno Puschmann) 

v1.6.3
  Added Spanish Language (Thanks Bernabé García)
  A few minor changes

v1.6.2
  Compatibility with Discussion Plugin (Thanks Micha Meyer)

v1.6.1
  Plugin now report the lastest version date into the Plugins Manager (Thanks Ilya Lebedev)
  Updated Russian Language (Thanks Alexander Zubkov)

v1.6.0
  Changes into the design and HTML output (Valid XHTML 1.0 now)
  Added a workaround for Plugins Manager without UTF-8 support for languages that contains UTF-8 characters.
  Added report level (Detail on output information: Silent; Files only; All)
  Added information of how many files & directories were deleted
  Updated Italian Language (Thanks Diego Pierotto)
  Updated Russian Language (Thanks Alexander Zubkov)
  NOTE: This version have a new config file revision, you'll need to re-create config.php if you're upgrading.

v1.5.4
  Added a hyperlink in the plug-in main page to quickly visit the website (It will open a new window)
  Display the plug-in version in the Administration tasks lists
  Updated German Language (Thanks alex)

v1.5.3
  Bugfixes on writeconfigs function (Thanks Gary for the bug report)

v1.5.2
  User now can create 'configs.php' from the plug-in instead of accepting the default one (See FAQ)
  Fixed a bug about some configurations in 'configs.php' (Thanks Robert Riebisch)
  Updated Russian language (v1.5.1) (Thanks Alexander Zubkov)
  Changes into some sentences inside the languages files
  Discarded outdated language versions (they are still available as a patch)

v1.5.1
  Fixed old locks directory searching
  Deleting files/directories will now show where they are being processed (cache, locks, meta or old-revis.)

v1.5.0
  Improved security (Check directories variables & configurations file checking)
  Added debug list for checking some internal variables (must be enabled in configs)
  Fixed meta directory variable
  Improved files searching engine (Thanks Jeff)
  Many others minor changes...

v1.4.3
  Fixed French language (v1.4.*) (From Flavien Viollet).
  Added Brasil (Portuguese) language (v1.4.*).

v1.4.2
  Added French language (v1.4.*) (Thanks Flavien Viollet).
  Renamed correctly the russian language filename (Although language isn't yet updated to v1.4.*).
  Using $conf['savedir'] when $conf['datadir'] isn't available.
  Converting files to UNIX format (line-break: 0x10).

v1.4.1
  Updated German language (v1.4.*) (Thanks konus).
  Added Italian language (v1.4.*) (Thanks EndelWar).
  Fixed "version" text that i’ve forgot to do multi-language support (Thanks EndelWar).
  Fixed internal variables for paths (In case they aren’t the default ones) (Thanks Christopher Smith).
  Added a "readme.txt" into the zip with same information as the wiki.

v1.4
  Added German language (v1.3.*) (Thanks konus).
  Added Meta files & old lost page locks delection (suggestion from Kibi).
  “Old lost page locks (*.lock)” will delete expired locks that aren’t deleted by DokuWiki due of creating a page and cancel it (generating a orphan .lock file).

v1.3.1
  Updated Russian language (v1.3.*) (Thanks Kibi).

v1.3
  Added configurations file “<dokuwiki directory>/lib/plugins/cacherevisionserase/configs.php” (request from Hoberion), you should edit it after the install:
    * Position in admin menu (Default 67).
    * Enable/Disable cache erase command (Default ON).
    * Enable/Disable all old revisions erase command (Default OFF).
    * Ask/Enable/Disable delection of cache of extensions:
      * .i files (Backlinks and more???) (Default ASK).
      * .xhtml files (HTML form of a page) (Default ASK).
      * .js files (Cached Javascript) (Default ASK).
      * .css files (Cached CSS-Sheet) (Default ASK).
      * .media.* files (Cached media files) (Default ASK).
      * All other unknown formats (Default ASK).
      * Indexed-search files (Default ASK).
  Thanks Hoberion for all issues.

v1.2
  Added Russian language (Thanks Kibi).
  Fixed bug that didn’t delete cache file / revision page with “_dummy” text on it.
  Fixed “data” path with accordance of security tips (Thanks Kibi).
  Removed auth mechanism (Doku Wiki don’t allow non-admin users to access admins plug-ins anyway), no longer “Invalid auth mechanism” error is returned.

v1.1
  Joined the two plug-ins into a single one.
  Added a basic GUI.
  Plug-in will now ask the admin if he want to execute the command.
  Absolute path of files are now hidden.

v1.0
  First release.

- Available languages:
    * English
      * Always updated
    * Portuguese
      * Always updated
    * Brasil
      * Always updated
    * Spanish
      * Bernabé García, 2009-06-27 v1.6.*
    * Ukrainian
      * Olexiy Zagorskyi, 2010-11-10 v.1.6.*
    * German
      * Arno Puschmann, 2009-09-25 v1.6.*
      * 2008-03-23 v1.6.0
      * Alex, 2006-07-29 v1.5.4
      * konus, 2006-07-09 v1.4.*
    * Italian
      * Diego Pierotto, 2008-03-23 v1.6.*
      * EndelWar, 2006-07-09 v1.4.*
    * Russian
      * Alexander Zubkov, 2008-03-24 v1.6.*
      * Kibi, 2006-07-03 v1.3.*
    * French
      * Christophe Martin, 2009-09-13 v1.6.*
      * Flavien Viollet, 2006-10-18 v1.4.*

More translations are welcome.

- Download & Installation

Method 1:
    * Go to “Admin” and select “Manage Plugins”
    * In the URL Textbox, type one of the mirrors available in "http://wiki.splitbrain.org/plugin:cacherevisionseraser"
    * Press “Download” and it will be automatically installed!
    * If you want to modify default configuration:
      * Modify “<dokuwiki directory>/lib/plugins/cacherevisionserase/configs.php” configurations file with a text editor.
    * You can update in the future by pressing “Update” over the “cacherevisionserase” plug-in.

Method 2:
    * Download the zip package
    * Unzip into ‘<dokuwiki directory>/lib/plugins/’ directory (you should end up with a ‘<dokuwiki directory>/lib/plugins/cacherevisionserase’ folder).
    * Modify “<dokuwiki directory>/lib/plugins/cacherevisionserase/configs.php” configurations file with a text editor.
    * That’s it! Plug-in is now installed and working!

Please visit the website for more mirrors.

- FAQ (Frequently Asked Questions)

Check the official website for the FAQ at "http://wiki.splitbrain.org/plugin:cacherevisionseraser"

- Contact

Plug-in coder:
  JustBurn (Email: justburner [at] armail [dot] pt)

Peoples who helped to make this project better:
  Hoberion, Kibi, konus, EndelWar, Chris. Smith,
  Flavien Viollet, Jeff, Alexander Zubkov,
  Robert Riebisch, Gary, Alex (platinum4friends?),
  Diego Pierotto, Micha Meyer, Bernabé García,
  Christophe Martin, Arno Puschmann, David,
  Olexiy Zagorskyi, schplurtz

Any problems, bugs or improvements should be posted in the wiki "http://wiki.splitbrain.org/plugin:cacherevisionseraser" or directly emailed to me.
