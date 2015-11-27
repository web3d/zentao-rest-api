<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 词典
 */
class Enums extends Resource {
    
    public function run() {
        
    }
    
    /**
     * /enumerations/issue_priorities.:format
     * 返回 issue字典 优先级列表
     * GET /enumerations/issue_priorities.xml
     */
    public function issue_priorities() {
        echo json_encode(array('issue_priorities' => array(
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
     * /enumerations/time_entry_activities.:format
     * 返回时间实体活动字典列表
     */
    public function time_entry_activities() {
        
    }
    
    public function time_entries() {
        
    }
    
    /**
     * /issue_statuses.:format
     * @link http://www.redmine.org/projects/redmine/wiki/Rest_IssueStatuses
     * GET /issue_statuses.xml
     */
    public function issue_statuses() {
        
    }
}