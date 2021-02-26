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
        if (!empty(GetVideoSrc($_GET['id']))) {
            ResponseData('视频地址获取成功', 'success', GetVideoSrc($_GET['id']));
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
