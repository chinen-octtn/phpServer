<?php
require 'phpRouter/functions.php';

// ファイルパスの取得が期待通りに動作しているかテスト
function testGetRequestedFilePath() {
    $documentRoot = '/var/www/html';
    $requestUri = '/test/';
    $expected = '/var/www/html/test/index.html';
    $result = getRequestedFilePath($documentRoot, $requestUri);
    assert($result === $expected, 'Failed for 末尾がスラッシュのパス');

    $requestUri = '/test/index.html';
    $expected = '/var/www/html/test/index.html';
    $result = getRequestedFilePath($documentRoot, $requestUri);
    assert($result === $expected, 'Failed for 末尾がindex.htmlのパス');

    $requestUri = '/test';
    $expected = '/var/www/html/test';
    $result = getRequestedFilePath($documentRoot, $requestUri);
    assert($result === $expected, 'Failed for 末尾にスラッシュがないパス');
}

testGetRequestedFilePath();

// ファイルの内容を取得してPHPコードを実行する関数が期待通りに動作しているかテスト
function testExecutePhpFile() {
    $fileName = 'test.php';
    file_put_contents($fileName, '<?php echo "Hello, World!"; ?>');
    ob_start();
    executePhpFile($fileName);
    $output = ob_get_clean();
    assert($output === 'Hello, World!', 'Failed to execute PHP file');
    unlink($fileName);
}

testExecutePhpFile();