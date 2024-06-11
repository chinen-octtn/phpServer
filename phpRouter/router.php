<?php

require 'functions.php';

// ドキュメントルートを指定
$documentRoot = __DIR__ . '/..';

// リクエストされたURIを取得
$requestUri = $_SERVER['REQUEST_URI'];

// リクエストされたファイルのパスを取得
$requestedFile = getRequestedFilePath($documentRoot, $requestUri);

// ファイルが存在し、拡張子が.htmlの場合にPHPとして処理
if (file_exists($requestedFile) && pathinfo($requestedFile, PATHINFO_EXTENSION) === 'html') {
    // ファイルのディレクトリを取得
    $fileDir = dirname($requestedFile);

    // 現在のディレクトリをファイルのディレクトリに変更
    chdir($fileDir);

    // 出力バッファリングを開始
    ob_start();
    // ファイルを読み込み
    include basename($requestedFile);
    // 出力バッファの内容を取得
    $content = ob_get_clean();
    // バッファの内容を処理し、PHPコードを実行
    eval('?>' . $content);
} else {
    // それ以外のファイルは通常通り処理
    return false; // デフォルトのビルトインサーバーの動作を継続
}
