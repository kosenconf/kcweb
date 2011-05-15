<?php // vim: ts=2 sts=2 sw=2 expandtab :
/**
 *
 * Kosen Style -- the template of Dokuwiki, is specialized for kosenconf.jp.
 *
 * The new kosenconf.jp template is developed by KC-Web Working Gorup. This 
 * style is aimed at the contents written in Japanese and text direction is 
 * limited for Left-to-Right.
 *
 * @link http://kosenconf.jp/
 * @author harukasan <miruca@me.com>
 *
 */

if (!defined('DOKU_INC')) die(); // if dokuwiki is not loaded

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang']?>"
 lang="<?php echo $conf['lang']?>" dir="<?php echo $lang['direction']?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		<?php tpl_pagetitle()?> - <?php echo strip_tags($conf['title'])?>
	</title>
	<!-- meta headers start -->
	<?php tpl_metaheaders()?>
	<!-- meta headers end -->
	<link rel="shortcut icon" href="<?php echo DOKU_TPL?>images/favicon.ico" />
</head>
<body >

<div id="container">
	<?php html_msgarea()?>

	<!-- header start -->
	<div id="header">
    <h1>
      <a href="<?php echo wl(); ?>">
        <img src="<?php echo DOKU_TPL?>images/toplogo.png" alt="高専カンファレンス" title="高専カンファレンス" />
      </a>
    </h1>
    <div class="nav">
      <ul>
        <li><a href="<?php echo wl(); ?>">トップページ</a></li>
      </ul>
    </div>
	</div>
	<!-- header end -->

	<div id="main" class="dokuwiki">
		<!-- wikipage start -->
		<?php tpl_content()?>
		<!-- wikipage end -->
	</div>

	<!-- footer start -->
	<div id="footer-wrap">
		<div id="footer">
			<div id="util">
				<ul>
          <li><a href="<?php echo wl("help") ?>">ヘルプ</a></li>
					<li><?php tpl_actionlink('history') ?></li>
					<li><?php tpl_actionlink('edit') ?></li>
					<li><?php tpl_actionlink('admin') ?></li>
					<li><?php tpl_actionlink('login') ?></li>
				</ul>
			</div>
			<div id="pageinfo">
				<?php tpl_pageinfo() ?>
			</div>
			<div id="copyright">
        <p>このサイトは<a href="<?php echo wl("comitties") ?>">高専カンファレンス事務局</a>により管理、運営されています。</p>
        <p>Developed by <a href="<?php echo wl("kcweb-wg") ?>">KCWeb Working Group</a>.</p>
				<p>Powered by <a href="http://www.dokuwiki.org/">DokuWiki</a> on <a href="http://www.php.net/">PHP</a>.</p>
			</div>
		</div>
    <div class="no">
    <?php
    /* provide DokuWiki housekeeping, required in all templates */
    tpl_indexerWebBug()
    ?>
    </div>
  </div>
	<!-- footer end -->
</div>
</body>
</html>
