<?php
//加一个验证锁，防止别人引用
header("Access-Control-Allow-Origin: https://引用域名");
 
$path = dirname(__FILE__);
$file = file($path."/hitokoto.txt");
 
//随机读取一行
$arr  = mt_rand( 0, count( $file ) - 1 );
$content  = trim($file[$arr]);
 
//编码判断，用于输出相应的响应头部编码
if (isset($_GET['charset']) && !empty($_GET['charset'])) {
    $charset = $_GET['charset'];
    if (strcasecmp($charset,"gbk") == 0 ) {
        $content = mb_convert_encoding($content,'gbk', 'utf-8');
    }
} else {
    $charset = 'utf-8';
}
header("Content-Type: text/html; charset=$charset");
 
//格式化判断，输出js或纯文本
if ($_GET['format'] === 'js') {
    echo "function hitokoto(){document.write('" . $content ."');}";
} else {
    echo $content;
}
