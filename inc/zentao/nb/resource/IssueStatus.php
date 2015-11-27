<?php

namespace zentao\nb\resource;

/**
 * 问题状态
 */
class IssueStatus extends \zentao\nb\resource {
    
    /**
     *
     * @var array issue标识标识与 整型 id 的对应 只支持系统默认的类型
     */
    protected $map = array(
        'null' => 0,
        'active' => 1,
        'resolved' => 2,
        'closed' => 3,
    );
    
    public function index($format = 'json') {
        global $app;

        $statuses = $app->loadLang('bug')->bug->statusList;
        $issue_statuses = array();
        foreach ($statuses as $key => $status) {
            if ($status == '') {
                $status = 'unknown';
            }
            
            $issue_statuses[] = array('id' => (isset($this->map[$key]) ? $this->map[$key] : $this->map['null']), 'name' => $status);
        }
        
        echo json_encode(array('issue_statuses' => $issue_statuses));
    }
}