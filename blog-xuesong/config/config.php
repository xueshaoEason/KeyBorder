<?php
//站点目录
define('WEB_SITE','http://www.wyf.com/');
//绝对路径
define('DOC_ROOT',str_replace('\\','/',dirname(__DIR__)) . '/');
//层叠样式表
define('CSS_PATH',WEB_SITE . 'public/css');
//JS样式表
define('JS_PATH',WEB_SITE . 'public/js');
//字体目录
define('TTF_PATH',WEB_SITE . 'public/fonts');
//图片目录
define('IMG_PATH',WEB_SITE . 'public/images');