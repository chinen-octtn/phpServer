# PHPローカルサーバー

PHPのローカルサーバーを起動するためのメモです。

## 使い所

* ローカルでHTMLの更新をするとき、localhostで表示確認しながら編集したい
* HTMLファイルの中でPHPのincludeを使っており、ローカルでも動作してほしい
* 拡張子が `.html` のファイルでもPHPのincludeが動作してほしい

Apacheであれば設定ファイルを変更すれば可能ですが、ローカルのPHPのビルトインサーバーではその方法が使えないため、PHPでルーティングを行います。

## 環境
動作確認した環境

- MacOS 13.6.7
- PHP 8.2.4 

## 準備
1. MacにPHPが入っていない場合はインストールしておく
2. ローカルサーバーを起動したいディレクトリのドキュメントルートに`phpRouter`ディレクトリをコピーする

## 使い方
ターミナルでドキュメントルートのディレクトリに移動

※適宜パスを変更してください

```
cd /path/to/root
```

以下のコマンドを実行してPHPのローカルサーバーが起動します

```
php -S localhost:8000 -t . phpRouter/router.php
```

## 補足
サーバーパスとincludeパスが異なる場合は includeがエラーになります。

```
// エラー
<?php include "/var/www/root/include/parts.html"; ?>
```

```
// ドキュメントルートを使ったパスにする
<?php include($_SERVER['DOCUMENT_ROOT'] . '/include/parts.html'); ?>
```

ドキュメントルートを参照することでincludeできるようになります。
