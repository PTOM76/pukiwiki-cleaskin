<?php
/*
name: cleaskin
version: 1.7
*/

if (file_exists(SKIN_DIR . "config.ini.php")) {
  include_once(SKIN_DIR . "config.ini.php");
}

// タイトル下の文字
if (!defined('SKIN_EXPLAIN'))
  define("SKIN_EXPLAIN", "Powered by PukiWiki");

// 背景 (画像の設定を優先する)
// 背景画像
if (!defined('BACKGROUND_IMAGE'))
  define("BACKGROUND_IMAGE", "");

// 背景色
if (!defined('BACKGROUND_COLOR'))
  define("BACKGROUND_COLOR", "#DDEEFF");

// グローバルナビ
if (!defined('GLOBAL_NAVI'))
  define("GLOBAL_NAVI", 1); // 1, 0

// 主要ページ (グローバルナビのリンク)
if (!defined('GLOBAL_NAVI_LINKS'))
  define("GLOBAL_NAVI_LINKS", array(
    // '表示名' => 'ページ名',
    'トップ' => 'FrontPage',
    'ヘルプ' => 'Help',
    'PukiWiki' => 'PukiWiki',
  ));

// CSSファイル "cleaskin.css" or "cleaskin_compact.css"
if (!defined('CSS_FILE'))
  define("CSS_FILE", "cleaskin.css");

////////////////////////////////
// シェア機能
if (!defined('CLEASKIN_SHARE'))
  define("CLEASKIN_SHARE", 0); // 1, 0

// シェア先
if (!defined('CS_SHARES'))
  define("CS_SHARES", array(
    'twitter' => [
      'icon' => SKIN_DIR . '/image/share/twitter.png',
      'link' => 'https://twitter.com/share?url={url_string}&text={text_string}',
    ],
    'facebook' => [
      'icon' => SKIN_DIR . '/image/share/facebook.png',
      'link' => 'http://www.facebook.com/share.php?u={url_string}&t={text_string}',
    ],
    'hateb' => [
      'icon' => SKIN_DIR . '/image/share/hateb.png',
      'link' => 'https://b.hatena.ne.jp/entry/s/?{url_string_without_protocol}',
    ],
    'pocket' => [
      'icon' => SKIN_DIR . '/image/share/pocket.png',
      'link' => 'https://getpocket.com/edit?url={url_string}',
    ],
  ));

////////////////////////////////
// SEO関連

// Cleaskin付属SEO機能
if (!defined('CLEASKIN_SEO'))
  define("CLEASKIN_SEO", 1); // 1, 0

// description
if (!defined('CS_SEO_DESCRIPTION'))
  define("CS_SEO_DESCRIPTION", "");

// json-ld
if (!defined('CS_SEO_JSONLD'))
  define("CS_SEO_JSONLD", 0); // 1, 0



function cs_create_share_tag() {
  $tag = '<div style="text-align:center;margin:auto 0;margin-bottom:2px;margin-top:-7px;" class="share_btns">';
  foreach (CS_SHARES as $name => $data) {
    $tag .= '&nbsp;<a class="share_btn" target="_blank" href="' . $data['link'] . '"><img src="' . $data['icon'] . '" alt="share on ' . $name . '" width="40" height="40" /></a>&nbsp;';
  }
  return $tag . '</div>';
}


$cs_share_tag = CLEASKIN_SHARE ? cs_create_share_tag() : '';



// PukiWiki - Yet another WikiWikiWeb clone.
// pukiwiki.skin.php
// Copyright
//   2023 Pitan Network
//   2002-2021 PukiWiki Development Team
//   2001-2002 Originally written by yu-ji
// License: GPL v2 or (at your option) any later version
//
// cleaskin based modern skin

// ------------------------------------------------------------
// Settings (define before here, if you want)

// Set site identities
$_IMAGE['skin']['logo']     = 'pukiwiki.png';
$_IMAGE['skin']['favicon']  = 'image/' . $_IMAGE['skin']['logo']; // Sample: 'image/favicon.ico';

// SKIN_DEFAULT_DISABLE_TOPICPATH
//   1 = Show reload URL
//   0 = Show topicpath
if (! defined('SKIN_DEFAULT_DISABLE_TOPICPATH'))
	define('SKIN_DEFAULT_DISABLE_TOPICPATH', 0); // 1, 0

// Show / Hide navigation bar UI at your choice
// NOTE: This is not stop their functionalities!
if (! defined('PKWK_SKIN_SHOW_NAVBAR'))
	define('PKWK_SKIN_SHOW_NAVBAR', 1); // 1, 0

// Show / Hide toolbar UI at your choice
// NOTE: This is not stop their functionalities!
if (! defined('PKWK_SKIN_SHOW_TOOLBAR'))
	define('PKWK_SKIN_SHOW_TOOLBAR', 1); // 1, 0

// ------------------------------------------------------------
// Code start

// Prohibit direct access
if (! defined('UI_LANG')) die('UI_LANG is not set');
if (! isset($_LANG)) die('$_LANG is not set');
if (! defined('PKWK_READONLY')) die('PKWK_READONLY is not set');

$lang  = & $_LANG['skin'];
$link  = & $_LINK;
$image = & $_IMAGE['skin'];
$rw    = ! PKWK_READONLY;

// MenuBar
$menu = exist_plugin_convert('menu') ? do_plugin_convert('menu') : FALSE;
// RightBar
$rightbar = FALSE;
if (exist_plugin_convert('rightbar')) {
	$rightbar = do_plugin_convert('rightbar');
}

function _navigator($key, $value = '', $javascript = ''){
	$lang = & $GLOBALS['_LANG']['skin'];
	$link = & $GLOBALS['_LINK'];
	if (! isset($lang[$key])) { echo 'LANG NOT FOUND'; return FALSE; }
	if (! isset($link[$key])) { echo 'LINK NOT FOUND'; return FALSE; }
	
	if (arg_check($key) || ($GLOBALS['plugin'] == 'newpage' && $key == 'new'))
		echo '<span>' .
			(($value === '') ? $lang[$key] : $value) .
			'</span>';
	else 
		echo '<a href="' . $link[$key] . '" ' . $javascript . '>' .
			(($value === '') ? $lang[$key] : $value) .
			'</a>';

	return TRUE;
}

function _toolbar($key, $x = 20, $y = 20){
	$lang  = & $GLOBALS['_LANG']['skin'];
	$link  = & $GLOBALS['_LINK'];
	$image = & $GLOBALS['_IMAGE']['skin'];
	if (! isset($lang[$key]) ) { echo 'LANG NOT FOUND';  return FALSE; }
	if (! isset($link[$key]) ) { echo 'LINK NOT FOUND';  return FALSE; }
	if (! isset($image[$key])) { echo 'IMAGE NOT FOUND'; return FALSE; }

	echo '<a href="' . $link[$key] . '">' .
		'<img src="' . SKIN_DIR . "image/" . $image[$key] . '" width="' . $x . '" height="' . $y . '" ' .
			'alt="' . $lang[$key] . '" title="' . $lang[$key] . '" />' .
		'</a>';
	return TRUE;
}

// ------------------------------------------------------------
// Output

// HTTP headers
pkwk_common_headers();
header('Cache-control: no-cache');
header('Pragma: no-cache');
header('Content-Type: text/html; charset=' . CONTENT_CHARSET);

?>
<!DOCTYPE html>
<html lang="<?php echo LANG ?>">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CONTENT_CHARSET ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php if ($nofollow || ! $is_read)  { ?> <meta name="robots" content="NOINDEX,NOFOLLOW" /><?php } ?>
    <?php if ($html_meta_referrer_policy) { ?> <meta name="referrer" content="<?php echo htmlsc(html_meta_referrer_policy) ?>" /><?php } ?>
    
    <title><?php echo $title ?> | <?php echo $page_title ?></title>
    <link rel="SHORTCUT ICON" href="<?php echo $image['favicon'] ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo SKIN_DIR . CSS_FILE ?>" />
    <script>console.log("loaded css")</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $link['rss'] ?>" /><?php // RSS auto-discovery ?>
    <script type="text/javascript" src="skin/main.js" defer></script>
    <script type="text/javascript" src="skin/search2.js" defer></script>
<?php
if (CLEASKIN_SEO) {
  if (!empty(CS_SEO_DESCRIPTION)) {
?>
    <meta name="description" content="<?= CS_SEO_DESCRIPTION ?>" />
<?php
  }
  if (CS_SEO_JSONLD) {
    $root_url = (!empty($_SERVER['HTTPS']) ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'];
?>
    <script type="application/ld+json">
    {
      "@context" : "https://schema.org",
      "@type" : "WebSite",
      "name" : "<?= $page_title ?>",
      "url" : "<?= $root_url ?>",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "<?= $root_url . $_SERVER['SCRIPT_NAME'] ?>/?cmd=search2&q={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
    </script>
<?php
  }
}
if (CLEASKIN_SHARE) {
?>
    <script>
    window.addEventListener("load", function() {
      var $btn = document.getElementsByClassName("share_btn");
      for (var $i = 0; $i < $btn.length; ++$i) {
        $btn[$i].addEventListener("click", function($e) {
          $e.preventDefault();
          this.href = this.href.replace('?{url_string_without_protocol}', encodeURI(location.hostname + location.pathname + location.search));
          this.href = this.href.replace('{url_string}', encodeURI(location.href));
          this.href = this.href.replace('{text_string}', encodeURI(document.title));
          window.open(this.href, "SNS_window", "width=600, height=500, menubar=no, toolbar=no, scrollbars=yes");
        }, false);
      }
    });
    </script>
<?php
}
?>
<?php echo $head_tag ?>
  </head>
  <body>
<?php echo $html_scripting_data ?>
<?php if (!empty(BACKGROUND_IMAGE)) { ?>

    <div class="container-bg" style="background-image: url('<?= BACKGROUND_IMAGE ?>');background-size: cover;"></div>
<?php } else if (!empty(BACKGROUND_COLOR)) {
?>

    <div class="container-bg" style="background-color: <?= BACKGROUND_COLOR ?>;"></div>
<?php } else {
?>
    <div class="container-bg" style="background-color: #DDEEFF;"></div>
<?php
} ?>
    <div id="header">
      <div id="h_contents">
        <a href="<?php echo $link['top'] ?>"><img id="logo" src="<?php echo IMAGE_DIR . $image['logo'] ?>" width="80" height="80" alt="[PukiWiki]" title="[PukiWiki]" /></a>
 
        <h1 class="title"><a class="title" href="<?php echo $link['top'] ?>"><?php echo $page_title ?></a></h1>
        <?php echo SKIN_EXPLAIN ?>

        <label for="flag_m_menubar" class="m_menubar_btn">≡</label>
        <input type="checkbox" id="flag_m_menubar" class="check_m_menubar" />
        <label for="flag_m_menubar" class="bg_m_menubar">
          <label class="m_menubar">
            <div class="m_menubar_content">
<?php if ($menu) { ?>
              <div id="m_leftbar"><?php echo $menu ?></div><br />
              <?php if ($rightbar) echo $hr; ?>
<?php } ?>
<?php if ($rightbar) { ?>
              <div id="m_rightbar"><?php echo $rightbar ?></div><br />
<?php } ?>              
            </div>
          </label>
        </label>
        
        <div id="navigator">
<?php if(PKWK_SKIN_SHOW_NAVBAR) { ?>
<?php if ($is_page || arg_check('backup')) { ?>
 <?php if ($rw) { ?>
	<?php _navigator('edit') ?>
	<?php if ($is_read && $function_freeze) { ?>
		&nbsp; <?php (! $is_freeze) ? _navigator('freeze') : _navigator('unfreeze') ?>
	<?php } ?>
 <?php } ?>
 <?php if (arg_check('diff') || arg_check('backup')) { ?>
	&nbsp; <?php _navigator('diff') ?>
 <?php } ?>
 <?php if ($do_backup) { ?>
	&nbsp; <?php _navigator('backup') ?>
 <?php } ?>
 <?php if ($rw && (bool)ini_get('file_uploads')) { ?>
	&nbsp; <?php _navigator('upload') ?>
 <?php } ?>
<?php } ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php if ($rw) { ?>
	<?php _navigator('new') ?> &nbsp;
 <?php } ?>
   <?php _navigator('list') ?>
 <?php if (arg_check('list')) { ?>
	&nbsp; <?php _navigator('filelist') ?>
 <?php } ?>
 &nbsp; <?php _navigator('search') ?>
 &nbsp; <?php _navigator('recent') ?>
 <?php if ($enable_login) { ?>
 &nbsp; <?php _navigator('login') ?>
 <?php } ?>
 <?php if ($enable_logout) { ?>
 &nbsp; <?php _navigator('logout') ?>
 <?php } ?>
<?php } // PKWK_SKIN_SHOW_NAVBAR ?>
        </div>
      </div>
    </div>

    <div id="m_navigator">
<?php if(PKWK_SKIN_SHOW_NAVBAR) { ?>
<?php if ($is_page || arg_check('backup')) { ?>
 <?php if ($rw) { ?>
	<?php _navigator('edit') ?>
	<?php if ($is_read && $function_freeze) { ?>
		&nbsp; <?php (! $is_freeze) ? _navigator('freeze') : _navigator('unfreeze') ?>
	<?php } ?>
 <?php } ?>
 <?php if (arg_check('diff') || arg_check('backup')) { ?>
	&nbsp; <?php _navigator('diff') ?>
 <?php } ?>
 <?php if ($do_backup) { ?>
	&nbsp; <?php _navigator('backup') ?>
 <?php } ?>
 <?php if ($rw && (bool)ini_get('file_uploads')) { ?>
	&nbsp; <?php _navigator('upload') ?>
 <?php } ?>
<?php } ?>
<br />
 <?php if ($rw) { ?>
	<?php _navigator('new') ?> &nbsp;
 <?php } ?>
   <?php _navigator('list') ?>
 <?php if (arg_check('list')) { ?>
	&nbsp; <?php _navigator('filelist') ?>
 <?php } ?>
 &nbsp; <?php _navigator('search') ?>
 &nbsp; <?php _navigator('recent') ?>
 <?php if ($enable_login) { ?>
 &nbsp; <?php _navigator('login') ?>
 <?php } ?>
 <?php if ($enable_logout) { ?>
 &nbsp; <?php _navigator('logout') ?>
 <?php } ?>
<?php } // PKWK_SKIN_SHOW_NAVBAR ?>
    </div>
<?php if (GLOBAL_NAVI) { ?>
    <div id="global-navi-wrap">
      <div id="global-navi">
<?php
  foreach (GLOBAL_NAVI_LINKS as $naviname => $navilink) {
    echo '<span><a href="?' . $navilink . '">' . $naviname . '</a></span>';
  }
?>
      </div>
    </div>
<?php } ?>
    <?= $cs_share_tag ?>
    <div id="contents">
      <div id="body">
        <div id="path">
<?php if ($is_page) { ?>
  <?php if(SKIN_DEFAULT_DISABLE_TOPICPATH) { ?>
          <a href="<?php echo $link['canonical_url'] ?>"><span class="small"><?php echo $link['canonical_url'] ?></span></a>
  <?php } else { ?>
          <span class="small">
  <?php
    if ($defaultpage == $title) {
      echo $defaultpage;
    } else {
      require_once(PLUGIN_DIR . 'topicpath.inc.php');
      $path_html = plugin_topicpath_inline();
      global $vars;
      if (!empty($path_html) && $vars['cmd'] == "read") {
        echo preg_replace("/(<a .*? class=\"link_page_passage\" .*?>).*?(<\/a>)/", "$1" . $defaultpage . "$2", str_replace("<span class=\"topicpath-slash\">/</span>", "<span class=\"topicpath-slash\">&gt;</span>", $path_html));
      } else {echo $page;}
    }
?>
          </span>
<?php 
  }
}
?>
        </div>
        <?php
          if (!$is_read && (substr($body, 0, 3) !== '<h2' && !preg_match("/<h2(\s.*)?>/", $body))) {
            echo "<h2>" . $title . "</h2>";
          }
        ?>
        <?php echo $body ?>
      </div>
<?php if ($menu) { ?>
      <div id="menubar"><?php echo $menu ?></div>
<?php } ?>
<?php if ($rightbar) { ?>
      <div id="rightbar"><?php echo $rightbar ?></div>
<?php } ?>
    </div>

<?php if ($notes != '') { ?>
    <div id="note"><?php echo $notes ?></div>
<?php } ?>

<?php if ($attaches != '') { ?>
    <div id="attach">
<?php echo $attaches ?>
    </div>
<?php } ?>

<?php if (PKWK_SKIN_SHOW_TOOLBAR) { ?>
<!-- Toolbar -->
    <div id="toolbar">
<?php

// Set toolbar-specific images
$_IMAGE['skin']['reload']   = 'reload.png';
$_IMAGE['skin']['new']      = 'new.png';
$_IMAGE['skin']['edit']     = 'edit.png';
$_IMAGE['skin']['freeze']   = 'freeze.png';
$_IMAGE['skin']['unfreeze'] = 'unfreeze.png';
$_IMAGE['skin']['diff']     = 'diff.png';
$_IMAGE['skin']['upload']   = 'file.png';
$_IMAGE['skin']['copy']     = 'copy.png';
$_IMAGE['skin']['rename']   = 'rename.png';
$_IMAGE['skin']['top']      = 'top.png';
$_IMAGE['skin']['list']     = 'list.png';
$_IMAGE['skin']['search']   = 'search.png';
$_IMAGE['skin']['recent']   = 'recentchanges.png';
$_IMAGE['skin']['backup']   = 'backup.png';
$_IMAGE['skin']['help']     = 'help.png';
$_IMAGE['skin']['rss']      = 'rss.png';
$_IMAGE['skin']['rss10']    = & $_IMAGE['skin']['rss'];
$_IMAGE['skin']['rss20']    = 'rss20.png';
$_IMAGE['skin']['rdf']      = 'rdf.png';
?>

<?php if ($is_page) { ?>
 &nbsp;
 <?php if ($rw) { ?>
	<?php _toolbar('edit') ?>
	<?php if ($is_read && $function_freeze) { ?>
		<?php if (! $is_freeze) { _toolbar('freeze'); } else { _toolbar('unfreeze'); } ?>
	<?php } ?>
 <?php } ?>
 <?php _toolbar('diff') ?>
<?php if ($do_backup) { ?>
	<?php _toolbar('backup') ?>
<?php } ?>
<?php if ($rw) { ?>
	<?php if ((bool)ini_get('file_uploads')) { ?>
		<?php _toolbar('upload') ?>
	<?php } ?>
	<?php _toolbar('copy') ?>
	<?php _toolbar('rename') ?>
<?php } ?>
 <?php _toolbar('reload') ?>
<?php } ?>
 &nbsp;
<?php if ($rw) { ?>
	<?php _toolbar('new') ?>
<?php } ?>
 <?php _toolbar('list')   ?>
 <?php _toolbar('search') ?>
 <?php _toolbar('recent') ?>
 &nbsp; <?php _toolbar('help') ?>
 &nbsp; <?php _toolbar('rss10', 36, 14) ?>
    </div>
<?php } // PKWK_SKIN_SHOW_TOOLBAR ?>

<?php if ($lastmodified != '') { ?>
    <div id="lastmodified">Last-modified: <?php echo $lastmodified ?></div>
<?php } ?>

<?php if ($related != '') { ?>
    <div id="related">Link: <?php echo $related ?></div>
<?php } ?>

    <div id="footer">
 Admin: <a href="<?php echo $modifierlink ?>"><?php echo $modifier ?></a>
      <p>
        <?php echo S_COPYRIGHT ?>
      </p>
    </div>
  </body>
</html>
