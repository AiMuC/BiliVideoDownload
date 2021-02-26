# BiliVideoDownload
基于PHP的哔哩哔哩视频下载<br>

$type类型geturl/download<br>
$id为视频的AV号或BV号<br>

# 获取视频地址示例 推荐
示例:http://127.0.0.1/blidownload/?type=geturl&id=BV1Qv4y1o7bT<br>

返回结果:<br>
{
"code": 200,
"msg": "视频地址获取成功",
"data": "https://upos-sz-mirrorcoso1.bilivideo.com/upgcxcode/28/96/292329628/292329628_nb2-1-32.flv?e=ig8euxZM2rNcNbNM7WdVhoMg7wUVhwdEto8g5X10ugNcXBlqNxHxNEVE5XREto8KqJZHUa6m5J0SqE85tZvEuENvNo8g2ENvNo8i8o859r1qXg8xNEVE5XREto8GuFGv2U7SuxI72X6fTr859r1qXg8gNEVE5XREto8z5JZC2X2gkX5L5F1eTX1jkXlsTXHeux_f2o859IB_&uipk=5&nbs=1&deadline=1614334765&gen=playurlv2&os=coso1bv&oi=3729533076&trid=f08874a409264862a24795c07d0a5cccu&platform=pc&upsig=b2ab93c04ef89db92a4fec2103cf787e&uparams=e,uipk,nbs,deadline,gen,os,oi,trid,platform&mid=0&orderid=0,3&agrr=1&logo=80000000"
}<br>


由于B站显示视频地址无法直接打开 需要设置浏览器请求头<br>
Referer:https://www.bilibili.com/video/视频号<br>
此处我使用的是浏览器插件ModHeader<br>

![text-here](https://s3.ax1x.com/2021/02/26/yz0DJg.png)

# 视频下载示例 //不推荐
不推荐使用此方法下载视频!<br>
由于PHP存在脚本执行时间限制 默认一般为300秒 此时遇到较大的视频会出现,视频未下载完成就被中断执行的情况<br>
此问题可以通过调整PHP脚本执行时间来解决!

示例:http://127.0.0.1/blidownload/?type=download&id=BV1Bp4y1n74J<br>
返回结果:视频下载成功-----视频存放路径为 blidownload/download/BV1Bp4y1n74J.flv<br>