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
    case "geturl":
        $Url=GetVideoSrc($_GET['id']);
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
