# baserCMSプラグイン[OGP]

OGPプラグインは、head内にogpタグを生成するプラグインです。

## インストール

1. 圧縮ファイルを解凍後、フォルダを Ogp にリネーム
2. BASERCMS/app/Plugin/Ogp に配置します。
3. 管理システムのプラグイン管理にアクセスし、表示されている Ogpプラグイン をインストール（有効化、全体に、）して下さい。
4. head内に以下のタグを入れてください。 (例） /Layouts/default.php の<head></head>内に以下のタグを配置。

```
<?php $this->Ogp->showOgp() ?>
```

### 使い方

基本的にタグを置くだけで動作します。

- 画像はアイキャッチ  
	コンテンツのアイキャッチ、ブログポストのアイキャッチを読み込んで、og:image関連のタグを出力します。アイキャッチ画像がなければ出力しません。
- ディスクリプションは説明文  
	説明文に入れたテキストがog:descriptionに出力されます。ブログポストは概要が出力されます。
- twitter, facebook
	プラグイン管理　→　OGPプラグインの管理ボタンをクリック。twitterアカウント、facebook APP-IDを登録するとそのタグも出力されます。



## 確認済バージョン

|baserCMSバージョン|プラグインバージョン|ステータス|コメント|
|:--|:--|:--|:--|
|4.1.0.1|1.0.0-beta|申請中|動作可|


## Thanks ##

- [http://basercms.net](http://basercms.net/)


## Author ##

- [dubmilli LLC.](https://dubmilli.com/)


## License ##

- [MIT](http://opensource.org/licenses/mit-license.php)
