# Cleaskin - PukiWikiスキン
レイアウトはほぼそのままでPukiWikiに使い慣れている方でも使いこなせるPukiWiki用スキンです。<br />
作者自身はPukiWikiをブログとして使いたかったので少しブログ風のデザインに仕上げました。<br />
スマホではメニューをハンバーガーメニュー化しています。<br /><br />
はいふん氏の[ModernSkin](https://github.com/hai-fun/modern-skin/)を一部ベースにしています。

## 導入
README.md, .gitignore以外のすべてのファイルをPukiWikiルートフォルダ直下にコピーする<br />
pukiwiki.ini.phpの
```php
define('SKIN_DIR', 'skin/');
```
を以下のように変更する。
```php
define('SKIN_DIR', 'skin/cleaskin/');
```

## イメージ画像
### PC
![image](https://github.com/PTOM76/pukiwiki-cleaskin/assets/58260965/eb417d2c-865d-49be-8b4a-3b8a0bc23363)

### スマホ
![image](https://github.com/PTOM76/pukiwiki-cleaskin/assets/58260965/895467b6-99c9-430c-814a-a2fa40a95d6f)
![image](https://github.com/PTOM76/pukiwiki-cleaskin/assets/58260965/0403f6cb-ecc0-4768-b81a-dd8411e0547b)

## 特徴
- PHP8対応
- 3カラムレイアウト対応
- PukiWiki 1.5.4対応
- メニュー上の検索プラグインのサイズ調整
- モバイル端末時ハンバーガーメニューで対応
