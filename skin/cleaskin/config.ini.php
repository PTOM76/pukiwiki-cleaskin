<?php
// Cleaskinの設定
// アイコン、ファビコンはpukiwiki.skin.phpから変更すること

// タイトル下の文字
define("SKIN_EXPLAIN", "Powered by PukiWiki");

// 背景 (画像の設定を優先する)
// 背景画像
define("BACKGROUND_IMAGE", "");

// 背景色
define("BACKGROUND_COLOR", "#DDEEFF");

// グローバルナビ
define("GLOBAL_NAVI", 1); // 1, 0

// 主要ページ (グローバルナビのリンク)
define("GLOBAL_NAVI_LINKS", array(
  // '表示名' => 'ページ名',
  'トップ' => 'FrontPage',
  'ヘルプ' => 'Help',
  'PukiWiki' => 'PukiWiki',
));

// CSSファイル "cleaskin.css" or "cleaskin_compact.css"
define("CSS_FILE", "cleaskin.css");

////////////////////////////////
// シェア機能
define("CLEASKIN_SHARE", 0); // 1, 0

// シェア先
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
define("CLEASKIN_SEO", 1); // 1, 0

// description
define("CS_SEO_DESCRIPTION", "");

// json-ld
define("CS_SEO_JSONLD", 0); // 1, 0

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