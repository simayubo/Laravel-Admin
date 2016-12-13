> Laravel学习

## 后台管理系统
Laravel+inspinia_admin
使用`zizaco/entrust`控制后台权限，前后台用户分表处理，使用`dingo/api`和`jwt-auth`开发api，简单的使用了`pjax`，不喜欢的可以在`/public/js/admin-common.js`中注释
```javascript
$(document).pjax("a[href!='#']", '.pjax');
$(document).on('pjax:start', function() { NProgress.start(); });
$(document).on('pjax:end',   function() { NProgress.done();  });
$(document).on("pjax:timeout", function(event) {
    // 阻止超时导致链接跳转事件发生
    event.preventDefault()
});
```
后台登录地址：http://xxxx.com/admin  默认账号密码：admin@admin.com  123456
## 安装方法
1. 下载到本地，或者`git clone`
2. 执行`composer install`
3. 修改配置文件中`.env`中的数据库信息
3. 执行迁移`php artisan migrate`
4. 填充数据`php artisan db:seed`

## 使用到的包
```json
"barryvdh/laravel-ide-helper":"dev-master",
"mews/captcha": "^2.1",
"zizaco/entrust": "5.2.x-dev",
"predis/predis": "1.0.*",
"laracasts/flash": "^2.0",
"hieu-le/active": "^3.3",
"dingo/api": "1.0.*@dev",
"tymon/jwt-auth": "0.5.*"
```