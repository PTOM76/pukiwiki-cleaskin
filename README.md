# Cleaskin - PukiWikiスキン
レイアウトはほぼそのままでPukiWikiに使い慣れている方でも使いこなせるPukiWiki用の自作スキンです。<br />
作者自身はPukiWikiをブログとして使いたかったので少しブログ風のデザインに仕上げました。<br />
スマホではメニューをハンバーガーメニュー化しています。

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
![image](https://github.com/PTOM76/pukiwiki-cleaskin/assets/58260965/478f1142-f08e-4ded-be69-2fdbf9dc0f3a)

### スマホ
![image](https://github.com/PTOM76/pukiwiki-cleaskin/assets/58260965/53dd17f5-cae1-40f1-8378-042c313792ae)
![image](https://github.com/PTOM76/pukiwiki-cleaskin/assets/58260965/4058ad1a-9f2c-4880-a08a-2a9e70d5c767)

## 特徴
- PHP8対応
- 3カラムレイアウト対応
- PukiWiki 1.5.4対応
- メニュー上の検索プラグインのサイズ調整
- モバイル端末時ハンバーガーメニューで対応
- SEO対策 (JSON-LD, description)
- グローバルナビ

## 変更履歴
- v1.4 検索ボックスのサイズを大きめに変更、グローバルナビを追加、その他色など変更