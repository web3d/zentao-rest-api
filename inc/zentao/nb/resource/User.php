<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 用户实体
 */
class Users extends Resource {
    
    /**
     * 默认控制器 返回用户列表 GET /users.xml
     * 
     * @param int $status 用户状态 默认为1
     * @param string $name 按登录名\姓\名\email匹配
     * @param int $group_id 给定分组的用户
     */
    public function fetchAll($status = 1, $name = '', $group_id = 0) {
        
    }
    
    /**
     * 创建用户
     * @link http://www.redmine.org/projects/redmine/wiki/Rest_Users#POST
     */
    public function create() {
        
    }
    
    /**
     * 返回用户详情
     * GET /users/:id.:format
     * @link http://www.redmine.org/projects/redmine/wiki/Rest_Users#usersidformat
     * @param string $include 可选参数 逗号分隔的参数 memberships groups 任意组合
     * 如 GET /users/3.xml?include=memberships,groups
     */
    public function fetch() {
        
    }
    
    /**
     * 根据api_key查询返回用户详情
     * GET /users/current.xml
     * @param string $key
     */
    public function fetchByKey() {
        echo json_encode(array('user' => array(
            'id' => 1,
            'login' => 'jimmy',
            'firstname' => 'redmine',
            'lastname' => 'Admin',
            'mail' => 'admin@admin.com',
            'created_on' => '2015-11-15T06:28:10Z',
            'last_login_on' => '2015-11-15T06:28:10Z',
            'api_key' => 'bf4df8c515968257c5d9622a8998ff9b7d1b23f3',
            'status' => 1
            )));
        
    }
    
    /**
     * 更新用户数据
     * PUT /users/20.xml
     * 
     */
    public function update() {
        
    }
    
    /**
     * 删除用户
     * DELETE /users/20.xml
     */
    public function delete() {
        
    }
}