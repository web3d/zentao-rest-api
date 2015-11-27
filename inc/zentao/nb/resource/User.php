<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 用户实体
 */
class User extends Resource {
    
    /**
     * 默认控制器 返回用户列表 GET /users.xml
     * 
     * @param int $status 用户状态 默认为1
     * @param string $name 按登录名\姓\名\email匹配
     * @param int $group_id 给定分组的用户
     */
    public function fetchAll($status = 1, $name = '', $group_id = 0) {
        global $app;
        
        $model = $this->loadModel('user');
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
    public function fetchByKey($format = 'json') {
        global $app;
        
        $key = !empty($_GET['key']) ? trim($_GET['key']) : '';
        if (!$key) {
            exit;
        }
        
        $model = $this->loadModel('user');
        $user = $model->dao->select('*')->from(TABLE_USER)->where('api_key')->eq($key)->fetch();
        if (!$user) {
            exit;
        }
        echo json_encode(array('user' => array(
            'id' => $user->id,
            'login' => $user->account,
            'firstname' => $user->nickname,
            'lastname' => $user->realname,
            'mail' => $user->email,
            'created_on' => '00-00-00T00:00:00Z',
            'last_login_on' => date('Y-m-d\TH:i:s\Z'),
            'api_key' => $user->api_key,
            'status' => $user->deleted ? 0 : 1
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