# JoePHP
php框架
JoePHP是一个运用MVC设计模式的快速开发框架。该项目主要目标是提供一个可以让各种层次的PHP开发人员快速地开发出健壮的Web应用，而 又不失灵活性。主要特性：

自动生成表对象，表操作类
基于MVC架构
面向对象
分页
session入库
session跨域

\src\	
	
action	控制层
	
config	配置信息
	
dal	数据层-表操作
	
dmodel	模型层-表的映射
	
includes	基础公共方法
	
model	数据层-逻辑与表操作关联
	
temp	临时文件 缓存
	
templates	视图层-模版
	
ui	视图层-资源文件
	
vendors	插件
	
index.php	程序入口
.htaccess	分布式配置文件
