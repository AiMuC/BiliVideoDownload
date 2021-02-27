# BiliVideoDownload [点我充电](http://www.aimuc.cn/)
> 
基于PHP的哔哩哔哩视频下载<br>
$type类型geturl/getfjurl/download<br>
$id为视频的AV号/BV号/番剧EP号<br>
~~暂不支持番剧解析/下载<br>~~

** 2021/2/27 更新后支持番剧解析非大大会员账号不支持解析需要大会员观看的番剧 **



```javascript
   演示DEMO 此接口使用腾讯云函数搭建 
   视频下载演示DEMO:https://service-h98sd4g0-1251752515.gz.apigw.tencentcs.com/release/BiliDownload/?type=geturl&id=BV1T5411K7Wc
   番剧下载演示DEMO:https://service-h98sd4g0-1251752515.gz.apigw.tencentcs.com/release/BiliDownload/?type=getfjurl&id=330489
   仅需更改尾部id=bv号即可返回视频真实地址
   > 示例项目中的cookie可能会过期建议自行搭建使用!
```


# 部署方法
> 
克隆项目到本地进入system/config.php 设置您的Cookie<br>
需要设置您的Cookie 如未设置Cookie视频清晰度默认为360P<br>
如使用腾讯云函数部署该项目请将以上 index.php内的switch case内容注释
腾讯云函数内需定义入口函数为 index.main_handler


# 1.获取视频地址示例 推荐
>  
解析视频示例:http://您的IP/blidownload/?type=geturl&id=BV1Qv4y1o7bT<br>
解析番剧示例:http://您的IP/blidownload/?type=getfjurl&id=330489

返回结果:<br>

```javascript
{
"code": 200,
"msg": "视频地址获取成功",
"data": "https://upos-sz-mirrorcoso1.bilivideo.com/upgcxcode/28/96/292329628/292329628_nb2-1-32.flv?e=ig8euxZM2rNcNbNM7WdVhoMg7wUVhwdEto8g5X10ugNcXBlqNxHxNEVE5XREto8KqJZHUa6m5J0SqE85tZvEuENvNo8g2ENvNo8i8o859r1qXg8xNEVE5XREto8GuFGv2U7SuxI72X6fTr859r1qXg8gNEVE5XREto8z5JZC2X2gkX5L5F1eTX1jkXlsTXHeux_f2o859IB_&uipk=5&nbs=1&deadline=1614334765&gen=playurlv2&os=coso1bv&oi=3729533076&trid=f08874a409264862a24795c07d0a5cccu&platform=pc&upsig=b2ab93c04ef89db92a4fec2103cf787e&uparams=e,uipk,nbs,deadline,gen,os,oi,trid,platform&mid=0&orderid=0,3&agrr=1&logo=80000000"
}
```
# 最简单的下载视频方法

```javascript
复制下载链接打开B站 点击F12打开开发者工具 点击"控制台/console"
输入以下内容 window.location.href="复制的视频真实地址"
回车即可开始下载视频！
```

# 方法1 推荐
> 
由于B站显示视频地址无法直接打开 需要设置浏览器请求头<br>
Referer:https://www.bilibili.com/video/视频号<br>
此处我使用的是浏览器插件ModHeader<br>
![text-here](https://s3.ax1x.com/2021/02/26/yz0DJg.png)
设置完成后直接打开视频地址即可下载<br>


# 方法2 推荐-但视频域名更变后需再次手动更改代理
> 
添加Nginx反向代理在nginx配置文件中添加以下内容<br>
** 以下upos-sz-mirrorcoso1.bilivideo.com需和返回结果中的域名相同<br> **

```javascript
location /download
{
	proxy_pass https://upos-sz-mirrorcoso1.bilivideo.com/;
	proxy_set_header Host upos-sz-mirrorcoso1.bilivideo.com;
	proxy_set_header Referer "https://www.bilibili.com/video/";
}
```


> 代理设置完成后将视频域名替换为本地域名即可下载<br>

```javascript
示例:http://127.0.0.1/download/upgcxcode/65/67/302726765/302726765_nb2-1-32.flv?e=ig8euxZM2rNcNbNVhwdVhoMghwdVhwdEto8g5X10ugNcXBlqNxHxNEVE5XREto8KqJZHUa6m5J0SqE85tZvEuENvNo8g2ENvNo8i8o859r1qXg8xNEVE5XREto8GuFGv2U7SuxI72X6fTr859r1qXg8gNEVE5XREto8z5JZC2X2gkX5L5F1eTX1jkXlsTXHeux_f2o859IB_&uipk=5&nbs=1&deadline=1614356610&gen=playurlv2&os=coso1bv&oi=3729533076&trid=7e6e8c9ebf5e4289b7924b73e31ab62eu&platform=pc&upsig=e2f41b99e87deba55b261a85d9f904ac&uparams=e,uipk,nbs,deadline,gen,os,oi,trid,platform&mid=0&orderid=0,3&agrr=1&logo=80000000

```
# 2.PHP视频下载示例 //不推荐
> 
不推荐使用此方法下载视频!<br>
由于PHP存在脚本执行时间限制 默认一般为300秒,此时遇到较大的视频会出现,<br>
视频未下载完成就被中断执行的情况<br>
此问题可以通过调整PHP脚本执行时间来解决!<br>
示例:http://您的IP/blidownload/?type=download&id=BV1Bp4y1n74J<br>
返回结果:视频下载成功-----视频存放路径为 blidownload/download/BV1Bp4y1n74J.flv<br>

# 折腾笔记

使用到的B站接口如下<br>

```javascript
1.转换bv或av号获取视频Cid
https://api.bilibili.com/x/player/pagelist?bvid=BV号
2.通过BV号以及Cid获取视频真实播放地址
https://api.bilibili.com/x/player/playurl?cid=Cid&bvid=BV号&qn=80
3.通过番剧EP号获取番剧真实播放地址
https://api.bilibili.com/pgc/player/web/playurl?ep_id=EP号&qn=112
qn对照表:
"超清 1080P+",112,
"高清 1080P",80,
"高清 720P",64,
"清晰 480P",32,
"流畅 360P",16,
3.访问视频真实连接需要带上参数
Referer:https://www.bilibili.com/video/BV号码 //必须加 --经过测试bv号非必须
Origin:https://www.bilibili.com //非必须
```

# 仅供学习交流，严禁用于商业用途! 点个Star吧,秋梨膏！

