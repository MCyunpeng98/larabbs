<?php
/**
 * Created by PhpStorm.
 * User: 84106
 * Date: 2018/10/10
 * Time: 9:25
 */
//将当前请求的路由名称转换为 CSS 类名称，作用是允许我们针对某个页面做页面样式定制。
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}