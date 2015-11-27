<?php

namespace zentao\nb\resource;

/**
 * 项目自行定义的问题分类
 */
class IssueCategory extends \zentao\nb\resource {
    
    public function fetchAll($format = 'json') {
        global $app;

        $statuses = $app->loadLang('bug')->bug->typeList;
        $issue_statuses = array();
        foreach ($statuses as $key => $status) {
            if ($status == '') {
                $status = 'unknown';
            }
            
            $issue_statuses[] = array('id' => $key, 'name' => $status);
        }
        
        echo json_encode(array('issue_categories' => $issue_statuses));
    }
}