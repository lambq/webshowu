# 秀站分类目录

[![For Laravel 5][badge_laravel]][link-github-repo]

## 版本更新！
### webshowu 5.2版本
>* 【模块】资讯文章管理模块
>* 【模块】目录网站管理模块
>* 【功能】定时运行程序功能（cron任务调度）
>* 【功能】长耗时运行程序功能（queue队列）
>* 【功能】phpquery采集器功能（语法类似jquery的dom采集操作——是我见过最不错的）
>* 【功能】curl动态代理（是专门针对防止采集的）
>* 【功能】基于http反向索引外链（自动收录网站）
>* 【模块+功能】秀妹组合：基于http反向索引外链、自动收录网站并生成网站缩略图和各种数据的收集。这是一个长耗时php运行时间有可能超出60秒、所以我建立了一个队列(jobs)专门处理“秀妹抛过来的任务”。
>* 【模块+功能】文章采集组合：建立一个采集规则表、调用cron任务调度定时每一分钟读取规则表里面的所以规则、循环抛给处理规则的队列(jobs)、然后把所有要采集的文章(标题和链接)抛给文章采集队列(jobs)。
>* 【扩展包】"overtrue/laravel-lang": "~3.0" 多个国家的语言包
>* 【扩展包】"predis/predis": "~1.0" 最好的redis-php扩展包
>* 【扩展包】"guzzlehttp/guzzle": "~5.3|~6.0" PHP的HTTP客户端，用来轻而易举地发送请求，并集成到我们的WEB服务上
>* 【扩展包】"overtrue/laravel-socialite": "~1.0" 社会化登陆
>* 【扩展包】"stevenyangecho/laravel-u-editor": "~1.3" 百度开源项目我富文本编辑器
>* 【扩展包】"zgldh/qiniu-laravel-storage": "^0.4.2" 七牛云存储SDK
>* 【服务】artisan工具(Artisan Console)
>* 【服务】缓存(Cache)
>* 【服务】文件系统/云存储(Filesystem / Cloud Storage)
>* 【服务】辅助函数(Helpers)
>* 【服务】分页(Pagination)
>* 【服务】队列(Queue)
>* 【服务】session
>* 【服务】任务调度(Task Scheduling)
>* 【php扩展】fileinfo
>* 【php扩展】openssl
>* 【php扩展】pdo
>* 【php扩展】mbstring
>* 【php扩展】tokenizer
>* 【php扩展】pcntl
>* 【php扩展】redis
>* 【php扩展】memcached
>* 【额外程序】python的进程管理控制系统(supervisor)
>* 【额外程序】linux的定时任务系统“只能精确的分钟”(cron/crontab)

### webshowu 5.3版本
>* 【路由】前台，后台分离
>* 【功能】站点地图

### 秀站分类目录 版本
>* [5.2版本amazeui主题点击下载链接](https://github.com/lambq/webshowu/releases/tag/v1.0)
>* [5.3版本amazeui主题点击下载链接](https://github.com/lambq/webshowu/releases/tag/v2.0)

## 安装步骤
[点击链接](https://github.com/lambq/webshowu/wiki/%E5%AE%89%E8%A3%85%E5%8F%8A%E9%85%8D%E7%BD%AE)

## 感激

感谢以下的项目,排名不分先后

* [laravel-china](https://laravel-china.org)
* [bootstrap](http://www.bootcss.com)
* [laravel](http://www.leravel.com)
* [秀站分类目录](http://www.webshowu.com)
* [laravel学院](http://laravelacademy.org)
* [amazeui](http://amazeui.org)

## 有bug反馈
在使用中有任何问题，欢迎反馈给我，可以用以下联系方式跟我交流

* qq群：174353270

# License

> 使用 webshowu 构建，或者基于 webshowu 源代码修改的站点 **必须** 在页脚加上 `Powered by webshowu` 字样，并且必须链接到 `http://www.webshowu.com` 上。**必须** 在页面的每一个标题上加上 `Powered by webshowu` 字样。

在遵守以上规则的情况下，你可以享受等同于 MIT 协议的授权。

或者你可以联系 `any@rushangkeji.com` 购买商业授权，商业授权允许移除页脚和标题的 `Powered by webshowu` 字样。

[badge_laravel]:      https://img.shields.io/badge/laravel-5.*-green.svg
[link-github-repo]:   https://github.com/lambq/webshowu