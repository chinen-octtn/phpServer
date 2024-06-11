<?php

/**
 * リクエストされたファイルのパスを取得する
 *
 * @param string $documentRoot ドキュメントルート
 * @param string $requestUri リクエストURI
 * @return string リクエストされたファイルのパス
 */
function getRequestedFilePath($documentRoot, $requestUri) {
    // URIを解析してパスを取得
    $path = parse_url($requestUri, PHP_URL_PATH);

    // パスが"/"で終わる場合にindex.htmlを補完
    if (substr($path, -1) === '/') {
        return $documentRoot . $path . 'index.html';
    } else {
        return $documentRoot . $path;
    }
}

/**
 * ファイルの内容を取得してPHPコードを実行する
 *
 * @param string $fileName ファイル名
 */
function executePhpFile($fileName) {
  // 出力バッファリングを開始
  ob_start();

  // ファイルを読み込み
  include $fileName;

  // 出力バッファの内容を取得
  $content = ob_get_clean();
  
  // バッファの内容を処理し、PHPコードを実行
  eval('?>' . $content);
}