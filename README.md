# 秀站分类目录

[![For Laravel 5][badge_laravel]][link-github-repo]

## 有哪些模块？
* 资讯文章管理模块
* 目录网站管理模块

## 有哪些功能？
* 定时运行程序功能（cron任务调度）
* 长耗时运行程序功能（queue队列）
* phpquery采集器功能（语法类似jquery的dom采集操作——是我见过最不错的）
* curl动态代理（是专门针对防止采集的）
* 基于http反向索引外链（自动收录网站）

## 有那些模块和功能的组合呢？
* 秀妹组合：基于http反向索引外链、自动收录网站并生成网站缩略图和各种数据的收集。这是一个长耗时php运行时间有可能超出60秒、所以我建立了一个队列(jobs)专门处理“秀妹抛过来的任务”。
* 文章采集组合：建立一个采集规则表、调用cron任务调度定时每一分钟读取规则表里面的所以规则、循环抛给处理规则的队列(jobs)、然后把所有要采集的文章(标题和链接)抛给文章采集队列(jobs)。

## 使用了laravel扩展包？
* "overtrue/laravel-lang": "~3.0" 多个国家的语言包
* "predis/predis": "~1.0" 最好的redis-php扩展包
* "guzzlehttp/guzzle": "~5.3|~6.0" PHP的HTTP客户端，用来轻而易举地发送请求，并集成到我们的WEB服务上
* "overtrue/laravel-socialite": "~1.0" 社会化登陆
* "stevenyangecho/laravel-u-editor": "~1.3" 百度开源项目我富文本编辑器
* "zgldh/qiniu-laravel-storage": "^0.4.2" 七牛云存储SDK

## 使用了laravel哪些服务？
* artisan工具(Artisan Console)
* 缓存(Cache)
* 文件系统/云存储(Filesystem / Cloud Storage)
* 辅助函数(Helpers)
* 分页(Pagination)
* 队列(Queue)
* session
* 任务调度(Task Scheduling)

## 使用了php哪些扩展？
* fileinfo
* openssl
* pdo
* mbstring
* tokenizer
* pcntl
* redis
* memcached

## 额外使用了哪些程序呢？
* python的进程管理控制系统(supervisor)
* linux的定时任务系统“只能精确的分钟”(cron/crontab)

## 安装步骤
[点击链接](https://github.com/lambq/webshowu/wiki/%E5%AE%89%E8%A3%85%E5%8F%8A%E9%85%8D%E7%BD%AE)

## 感激

感谢以下的项目,排名不分先后

* [phphub](https://phphub.org)
* [bootstrap](http://www.bootcss.com)
* [laravel](http://www.leravel.com)
* [秀站分类目录](http://www.webshowu.com)
* [laravel学院](http://laravelacademy.org)
* [amazeui](http://amazeui.org)

## 有bug反馈
在使用中有任何问题，欢迎反馈给我，可以用以下联系方式跟我交流

* qq群：55725231

# License

MIT

[badge_laravel]:      https://img.shields.io/badge/laravel-5.*-green.svg
[badge_lumen]:        https://img.shields.io/badge/lumen-5.*-green.svg
[badge_stable]:       https://img.shields.io/packagist/v/overtrue/laravel-lang.svg
[badge_unstable]:     https://img.shields.io/packagist/vpre/overtrue/laravel-lang.svg
[badge_downloads]:    https://img.shields.io/packagist/dt/overtrue/laravel-lang.svg?maxAge=2592000
[badge_license]:      https://img.shields.io/packagist/l/overtrue/laravel-lang.svg?maxAge=2592000

[link-github-repo]:   https://github.com/overtrue/laravel-lang
[link-packagist]:   https://packagist.org/packages/overtrue/laravel-lang