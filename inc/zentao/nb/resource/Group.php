<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 用户组
 */
class Groups extends Resource {
    
    /**
     * 返回全部用户分组列表
     * @link http://www.redmine.org/projects/redmine/wiki/Rest_Groups#Groups
     * GET /groups.xml
     */
    public function fetchAll() {
        
    }
    
    /**
     * 创建分组
     * POST /groups.xml
     */
    public function create() {
        
    }
    
    /**
     * /groups/:id.:format
     * 返回一个分组的详细信息
     * GET /groups/20.xml?include=users
     * 
     * @link http://www.redmine.org/projects/redmine/wiki/Rest_Groups#groupsidformat
     * @param string $include 逗号分隔,任意组合 users memberships
     */
    public function fetch() {
        
    }
    
    public function udpate() {
        
    }
    
    public function delete() {
        
    }
    
    /**
     * /groups/:id/users.:format
     * 指定用户添加到某个分组
     * POST /groups/10/users.xml
     * @param int $user_id 用户id
     */
    public function addUser() {
        
    }
    
    /**
     * /groups/:id/users/:user_id.:format
     * 将用户从分组中删除
     * DELETE /groups/10/users/5.xml
     */
    public function deleteUser() {
        
    }
}