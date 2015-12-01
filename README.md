# zentao-rest-api-redmine

禅道rest api接口，兼容Redmine的rest接口。

## 目的

Redmine是一款被广泛使用的开源项目管理软件，不少IDE都有相应插件与之整合。

本接口即以兼容Redmine REST API的方式，来实现IDE集成或其他可能性的场景。

## 兼容程度

Redmine: <http://www.redmine.org/projects/redmine/wiki/Rest_api>

Redmine中只有Issue的概念,而禅道中有需求(Story)、任务(Task)、Bug三种形式的概念，相应数据的ID没有统一管理,所以概念上无法完全统一,只能一一独立实现,然后从接口上分离,在IDE中分开配置。

后面设定一种关联逻辑,由于跟研发直接相关的为任务与 bug 两种,所以将Redmine 中 Category 这个概念用于区分这两种数据.在任务 id 与 bug id 加上固定的前缀来区分,这样可以合并数据显示.

## 配置

为了实现兼容特性，对禅道数据表做了少量的变更，主要是增加字段。

  * user 表：增加 api_key 字段
  * team 表：增加 id 自增字段
  * 。。。

## 使用

API 地址：

/zentao_path_url/rest/

.htaccess  中的RewriteBase 相应改一下



