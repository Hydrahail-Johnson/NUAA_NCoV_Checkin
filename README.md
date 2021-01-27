# i·南航每日自动打卡
  * [项目说明](#项目说明)
  * [使用方法](#使用方法)
    + [一、校外打卡](#一校外打卡)
    + [二、校内打卡](#二校内打卡)
    + [三、配置微信通知](#三配置微信通知)
  * [本地化部署](#本地化部署)
  * [其他说明](#其他说明)
  * [License](#License)

## 项目说明

基于[Qiandao](https://github.com/AragonSnow/qiandao)框架，每日自动上报健康信息，支持校内打卡及校外打卡。

- 定时打卡
- 随机时间区间打卡
- 打卡结果微信通知

声明：本项目仅供学习研究使用，请遵守相关规定，出现任何后果概不负责。


## 使用方法
### 一、校外打卡

#### 获取打卡的地址信息

1、首先访问 [https://lbs.amap.com/console/show/picker](https://lbs.amap.com/console/show/picker) 获取打卡地的经纬度信息。可以按照关键字搜索，也可以拖动地图点击选择位置。在如图所示绿色框中，可以看到打卡地的坐标，逗号前面为经度（longitude）,逗号后面为纬度（latitude）。

![获取坐标](https://cdn.nlark.com/yuque/0/2021/png/387341/1611674457904-2570e4c2-af58-43cd-bcb1-5f50575df668.png)

2、（可选，推荐验证）验证地址信息是否有误
将获取的经度和纬度填写到下面的链接中：
```http://api.xm.mk:8990/GetLocationInfoAPI.php?lng=经度&lat=纬度```
如上图所示，获取清华大学的坐标后，链接即为：

```http://api.xm.mk:8990/GetLocationInfoAPI.php?lng=116.326836&lat=40.00366```

用浏览器打开，即可看到地址信息。检查`address`、`area`字段无误即可。

```geo_info_api:{"type":"complete","info":"SUCCESS","status":1,"position":{"Q":"40.00366","R":"116.326836","lng":"116.326836","lat":"40.00366"},"message":"Get ipLocation failed.Get geolocation success.Convert Success.Get address success.","accuracy":100,"isConverted":"true","addressComponent":{"citycode":"010","adcode":"110108","businessAreas":[],"neighborhoodType":"","neighborhood":"","building":"","buildingType":"","street":"双清路","streetNumber":"30号","country":"中国","province":"北京市","city":[],"district":"海淀区","township":"清华园街道"},"formattedAddress":"北京市海淀区清华园街道清华大学","roads":[],"crosses":[],"pois":[]}
address:"北京市海淀区清华园街道清华大学"
area:"北京市 海淀区"
province:"北京市"
city:[]
```

#### 创建打卡任务

1、登录[https://c.xm.mk:8843/login](https://c.xm.mk:8843/login)，输入邮箱地址和密码注册并登录。
2、点击“所有公开模板”，找到·南航学生打卡（校外打卡），点击“新建签到”。
3、将位置信息和i南航账号密码填入对应参数中。注意：此处先填的第一个参数是纬度（小的），再填经度（大的）。

![参数填写](https://cdn.nlark.com/yuque/0/2021/png/387341/1611675625376-330a5538-9560-4665-a72a-232b2ad4dec1.png)

4、提交即可。如需要指定打卡时间区间，可以设置定时（默认为创建任务的时间）和随机延时。（建议开启定时和随机延时）

![定时和延时设置](https://cdn.nlark.com/yuque/0/2021/png/387341/1609440468875-d6a92a05-b474-4e19-b303-feecf1087209.png)

5、配置微信推送（**重要！即时获取打卡结果！**）看[本文第三部分](https://github.com/Xm798/NUAA_NCoV_Checkin#%E4%B8%89%E9%85%8D%E7%BD%AE%E5%BE%AE%E4%BF%A1%E9%80%9A%E7%9F%A5)。

### 二、校内打卡

1、登录[https://c.xm.mk:8843/login](https://c.xm.mk:8843/login)，输入邮箱地址和密码注册并登录。
2、点击最右侧的“**所有公开模板**”，找到**i·南航每日打卡**，点击“**新建签到**”。无特殊需求24h版（每天执行一次）即可。

![新建签到](https://cdn.nlark.com/yuque/0/2021/png/387341/1609437302246-f3fad3de-2e84-40ff-8187-dc903d4d5082.png)

3、输入统一身份认证账号密码，保存，提示成功即可。
4、可以看到，12或24小时后会自动进行下次打卡。如需要指定打卡时间区间，可以设置定时（默认为创建任务的时间）和随机延时。

![定时和延时](https://cdn.nlark.com/yuque/0/2021/png/387341/1609440468875-d6a92a05-b474-4e19-b303-feecf1087209.png)

>默认提交参数如下，如有变动，请自行修改模板。
>城市：江苏省 南京市 江宁区
>后台详细地址：江苏省南京市江宁区秣陵街道胜太路南京航空航天大学将军路校区
>体温：37度以下
>是否在校：是 
>是否处于隔离期：否
>是否…症状：否
### 三、配置微信通知

**强烈建议配置微信通知**，以便实时获取打卡结果。

#### 1、选择推送方式，并获取配置信息。

根据有无Github账号，有两种方式配置微信通知，任选一种即可。

##### 1）无Github账号

1、微信扫描二维码，关注公众号。

![Wxpusher](https://cdn.nlark.com/yuque/0/2021/png/387341/1609436580196-ef214509-6381-4b42-b3d5-649c2fd08647.png)

> 若二维码失效，点击[该链接](https://wxpusher.zjiecode.com/api/qrcode/mXi7eo7PRb1F5pLh5AsQ7cGyLri7wTIhNkcatc6PxWKzutdAhAJWA6jHB3paQsRP.jpg)，获取最新二维码。

2、进入公众号，点击公众号菜单内“我的”-“我的UID”。

3、回到网站后台，点击“推送注册”，将下面的`APPTOKEN`和自己的`UID`填到wxpusher中，点击测试，微信正常收到送即可。

> apptoken：AT_6kBmtADUKlnbAS2Y9RKe25U7zk8Cuf8f
> uid：自己从微信中获取 

![Wxpusher推送注册](https://cdn.nlark.com/yuque/0/2021/png/387341/1609436709323-95703aea-b494-448c-82ea-1b7a01b50915.png)

##### 2）有Github账号

1、登录http://sc.ftqq.com/，点击右上角“登入”，使用Github账号登录。
2、点击“发送消息”，获取SCKEY。

![发送消息](https://cdn.nlark.com/yuque/0/2021/png/387341/1609436092812-15db93ff-f48b-45be-a379-ea1c9c25cbbe.png)

3、点击“微信推送”，绑定微信。

![Server酱推送注册](https://cdn.nlark.com/yuque/0/2021/png/387341/1609436185442-27bd60a6-59fd-4366-a7f2-af6fa47e176d.png)

4、回到网站后台，点击“推送注册”，将SCKEY填写到S酱中，点击测试，正常收到推送即可。

#### 2、开启推送

配置好推送信息之后，点击“**推送设置**”，根据自己的配置选择推到Server酱或者Wxpusher，并且四种通知全部勾选，检查任务推送开关，然后点击提交。

![推送设置](https://cdn.nlark.com/yuque/0/2021/png/387341/1609436964595-8c13ca8e-0c64-47d7-a6af-16c69579e3df.png)

## 本地化部署
使用Docker[搭建Qiandao框架](ttps://github.com/AragonSnow/qiandao)后，新建模板，上传本项目中的HAR文件即可。

## 其他说明

1、打卡默认参数

> 今日是否在校：否
>
> 所在地点：中国大陆
>
> 今日体温范围：36℃~36.5℃
>
> 今日是否出现发热、乏力、干咳、呼吸困难等症状？否
>
> 今日是否接触疑似/确诊人群？否
>
> 是否处于隔离期/医学观察期（含特殊情况需要居家观察的）？否
>
> 今日是否从境外中高风险地区返回？否
>
> 今日是否有家属从境外中高风险地区返回？否
>
> 今日是否与从境外中高风险地区返回的人员有过密切接触？否
>
> 是否拥有苏康码？是
>
> 当前苏康码颜色是？绿色

2、如何修改上报参数？

使用Fiddler自行抓包后，修改模板中的POST参数。

> 抓包地址
>
> 校外打卡：https://m.nuaa.edu.cn/ncov/wap/default
>
> 校内打卡：https://m.nuaa.edu.cn/ncov/wap/nuaa/index

3、地址信息如何获取？

使用[高德地图坐标拾取工具]( https://lbs.amap.com/console/show/picker)获取经纬度后，会以GET方式提交至`http://api.xm.mk:8990/GetLocationInfoAPI.php?lng=经度&lat=纬度`，获取i`南航上报时所需的地址信息。

4、网站无法访问？

为确保安全，已为站点配置强制HTTPS跳转。请检查链接为https，端口号8843。

5、为什么要加端口号访问？

因为.mk域名为马其顿国家的顶级域名，国内无法备案。为保证访问速度，本项目部署于国内云服务商的主机上，因此不能使用80/443端口。

6、安全性问题

项目基于Qiandao框架，所有用户敏感数据存入数据库时，使用每个用户唯一的256位密钥加密，用户密钥使用256位主密钥加密，所有解密过程只在内存中进行。作者对i南航密码没有兴趣=_=如实在有担心，可以自行本地化部署。

## License

[MIT License](https://github.com/Xm798/NUAA_NCoV_Checkin/blob/master/LICENSE)