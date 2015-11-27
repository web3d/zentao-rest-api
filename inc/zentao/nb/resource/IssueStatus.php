<?php

namespace zentao\nb\resource;

/**
 * 问题状态
 */
class IssueStatus extends \zentao\nb\resource {
    
    public function index($format = 'json') {
        global $app;

        $statuses = $app->loadLang('bug')->bug->statusList;
        $issue_statuses = array();
        foreach ($statuses as $key => $status) {
            if ($status == '') {
                $status = 'unknown';
            }
            
            $issue_statuses[] = array('id' => $key, 'name' => $status);
        }
        
        echo json_encode(array('issue_statuses' => $issue_statuses));
    }
}