<?php
require 'config.php';
$view = 'application_list.php';

$vhostConfig = array();
/* 解析 http-vhost.conf 开始 */
$handle = @fopen($vhostPath, "r");
if ($handle) {
    $tag = false;
    $i = 0;
    while (!feof($handle)) {
        $buffer = fgets($handle, 4096);
        if(strpos($buffer, '#')===0){
            continue;
        }else{
            if(strpos($buffer, '<VirtualHost')===0){
                $tag = true;
                $i++;
            }
            if(strpos($buffer, '</VirtualHost')===0){
                $tag = false;
            }
            if($tag){
                if(strpos($buffer,'DocumentRoot')){
                    $r_path = preg_replace("/DocumentRoot|\s*|\"*/", "", $buffer);
                    $vhostConfig[$i]['path'] = $r_path;
                }
                if(strpos($buffer,'ServerName')){
                    $s_name = trim(str_replace('ServerName', '', $buffer));
                    $vhostConfig[$i]['server'] = $s_name;
                }
            }
        }
    }
    fclose($handle);
}
/* 解析 http-vhost.conf 结束 */
/*  过滤掉有server-name，却没有path的特殊配置 */
foreach($vhostConfig as $k => $v){
    if(empty($v['server']) || empty($v['path'])){
        unset($vhostConfig[$k]);
    }
}
/* 结束 */
/* 解析 host 开始 */
$appHostConfig = array();
$handle = @fopen($hostPath, "r");
if ($handle) {
    $tag = false;
    $i = 0;
    while (!feof($handle)) {
        $buffer = trim(fgets($handle, 4096));
        if(empty($buffer) ||strpos($buffer, '#')!==false){
            continue;
        }else{
            preg_match_all("/[\d|\.]*/", $buffer,$matches);
            $ip = $matches[0][0];
            preg_match_all("/\s+([\w|\.]*)/", $buffer,$matches);
            foreach($matches[1] as $server){
                $appHostConfig[$server] = $ip;
            }
        }
    }
    fclose($handle);
}
//var_dump($appHostConfig);
/* 解析 host 结束 */
include 'tpl/main.php';
?>