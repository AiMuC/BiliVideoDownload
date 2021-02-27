<?php
/* File Info 
 * Author:      AiMuC 
 * CreateTime:  2021/2/12 下午2:16:07 
 * LastEditor:  AiMuC
 * ModifyTime:  2021/2/26 下午4:17:28
 * Description: 
*/
require('system/init.php');

switch ($_GET['type']) {
    case "getfjurl":
        $Url = GetFjUrl($_GET['id']);
        if (!empty($Url)) {
            ResponseData('番剧播放地址获取成功', 'success', $Url);
        } else {
            ResponseData('番剧播放地址获取失败-可能的原因为账号非大会员或cookie设置错误', 'error');
        }
        break;
    case "geturl":
        $Url = GetVideoSrc($_GET['id']);
        if (!empty($Url)) {
            ResponseData('视频地址获取成功', 'success', $Url);
        } else {
            ResponseData('视频地址获取失败', 'error');
        }
        break;
    case "download":
        DownloadVideo($_GET['id']);
        break;
    default:
        break;
}

/* //如使用腾讯云函数部署该项目请将以上 switch case内容注释解开以下注释
*腾讯云函数内需定义入口函数为 index.main_handler
function main_handler($event, $context)
{
    $ID = json_encode($event->queryString->id, JSON_UNESCAPED_UNICODE);
    $ID = str_replace('"', "", $ID);
    $VideoSrc = GetVideoSrc($ID);
    if (!empty($VideoSrc)) {
        return array(
            'isBase64Encoded' => false,
            'statusCode' => 200,
            'headers' => array('Content-Type' => 'text/html; charset=utf-8'),
            'body' => ResponseData('视频地址获取成功', 'success', $VideoSrc)
        );
    } else {
        return array(
            'isBase64Encoded' => false,
            'statusCode' => 200,
            'headers' => array('Content-Type' => 'text/html; charset=utf-8'),
            'body' => ResponseData('视频地址获取失败', 'error')
        );
    }
}
*/