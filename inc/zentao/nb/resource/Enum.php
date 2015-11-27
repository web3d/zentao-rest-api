<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 词典
 */
class Enum extends Resource {
    
    public function run() {
        
    }
    
    /**
     * /enumerations/issue_priorities.:format
     * 返回 issue字典 优先级列表
     * GET /enumerations/issue_priorities.xml
     */
    public function issue_priorities() {
        global $app;

        $priorities = $app->loadLang('bug')->bug->priList;
        $issue_priorities = array();
        foreach ($priorities as $key => $priority) {
            if ($priority == '') {
                $priority = '-';
            }
            
            $issue_priorities[] = array('id' => $key, 'name' => $priority);
        }
        
        echo json_encode(array('issue_priorities' => $issue_priorities));
    }
    
    /**
     * /enumerations/time_entry_activities.:format
     * 返回时间实体活动字典列表
     */
    public function time_entry_activities() {
        
    }
    
    public function time_entries() {
        
    }
}