<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 问题列表
 */
class Issue extends Resource {
    
    /**
     * 获取所有 Issue 列表 暂不支持分页
     * @param string $format
     */
    public function fetchAll($format = 'json') {
        
        $model = $this->loadModel('bug');
        
        $issues = $model->getByList();
        $total_count = $model->dao->count();
        //var_dump($issues);
        
        $limit = !empty($_GET['limit']) ? (int)$_GET['limit'] : 0;
        $offset = !empty($_GET['offset']) ? (int)$_GET['offset'] : 0;
        if ($offset > 0) {
            $this->response(array('issues' => array(), 'total_count' => $total_count, 'offset' => $limit * $offset, 'limit' => $limit));
        }
        
        $data = array();
        if (!$issues) {
            $this->responseNotExixted();
        }
        
        foreach ($issues as $issue) {
            $_issue = array(
                'id' => (int)$issue->id,
                'subject' => $issue->title,
                'project' => array('id' => $issue->project, 'name' => $issue->project .'111'),
                'tracker' => array('id' => 1, 'name' => '11'),
                'status' => array('id' => 1, 'name' => 'issue'),
                'priority' => array('id' => 1, 'name' => '11'),
                'author' => array('id' => 1, 'name' => 'admin'), //TODO
                'assigned_to' => array('id' => 1, 'name' => 'admin'), //TODO
                'description' => '',//$issue->steps
                'start_date' => date('Y-m-d', strtotime($issue->assignedDate)),
                'due_date' => date('Y-m-d', strtotime($issue->assignedDate) + 1000000),
                'done_ratio' => 0,
                'created_on' => date('Y-m-d\TH:i:s\Z', strtotime($issue->openedDate)),//禅道没有记录 用这个代替
                'updated_on' => date('Y-m-d\TH:i:s\Z', time()),//禅道没有记录 用这个代替 $issue->lastEditedDate
            );
            $data[] = $_issue;
        }

        
        $this->response(array('issues' => $data, 'total_count' => $total_count, 'offset' => $limit * $offset, 'limit' => $limit));
    }
    
    /**
     * 返回指定问题的详细数据
     * @param int|string $id
     * @param string $format
     */
    public function fetch($id, $format = 'json') {
        //echo '{"issue":{"id":1,"project":{"id":1,"name":"project1"},"tracker":{"id":1,"name":"track tag1"},"status":{"id":1,"name":"issue"},"priority":{"id":1,"name":"1"},"author":{"id":2,"name":"Redmine Admin"},"assigned_to":{"id":2,"name":"Redmine Admin"},"subject":"issue 144445555","description":"","start_date":"2015-11-15","due_date":"2015-11-17","done_ratio":0,"spent_hours":0.0,"created_on":"2015-11-15T06:36:35Z","updated_on":"2015-11-15T06:38:28Z","attachments":[],"journals":[{"id":1,"user":{"id":2,"name":"Redmine Admin"},"notes":"","created_on":"2015-11-15T06:38:02Z","details":[{"property":"attr","name":"subject","old_value":"issue 1","new_value":"issue 144445555"}]},{"id":2,"user":{"id":2,"name":"Redmine Admin"},"notes":"","created_on":"2015-11-15T06:38:28Z","details":[{"property":"attr","name":"due_date","new_value":"2015-11-17"},{"property":"attr","name":"assigned_to_id","new_value":"2"}]}],"watchers":[]}}';
        //exit;
        $model = $this->loadModel('bug');
        $issue = $model->getById($id);
        if (!$issue) {
            $this->responseNotExixted();
        }

        $_issue = array(
            'id' => (int)$issue->id,
            'project' => array('id' => (int)$issue->project, 'name' => '111'),
            'subject' => $issue->title,
            'tracker' => array('id' => 1, 'name' => '11'),//
            'priority' => array('id' => 1, 'name' => '11'),
            'author' => array('id' => 1, 'name' => 'admin'),
            'assigned_to' => array('id' => 1, 'name' => 'admin'),
            'description' => 'yyy', //$issue->steps
            'start_date' => date('Y-m-d', strtotime($issue->assignedDate)),
            'due_date' => date('Y-m-d', strtotime($issue->assignedDate) + 1000000),
            'done_ratio' => 0,
            'created_on' => date('Y-m-d\TH:i:s\Z', strtotime($issue->openedDate)),
            'updated_on' => date('Y-m-d\TH:i:s\Z', strtotime($issue->lastEditedDate)),
            'attachments' => array(),
            'journals' => array(),
            'watchers' => array(),
        );
        $this->response(array('issue' => $_issue));
    }

}