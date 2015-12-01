<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;
use zentao\nb\enum\BugType;

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
        
        $project_id = !empty($_GET['project_id']) ? (int) $_GET['project_id'] : null;
        if ($project_id > 0) {
            $issues = $model->getProjectBugs($project_id);
        } else {
            $issues = $model->getByList();
        }
        $total_count = $model->dao->count();
        
        $limit = !empty($_GET['limit']) ? (int)$_GET['limit'] : 0;
        $offset = !empty($_GET['offset']) ? (int)$_GET['offset'] : 0;
        if ($offset > 0) {
            $this->response(array('issues' => array(), 'total_count' => $total_count, 'offset' => $limit * $offset, 'limit' => $limit));
        }
        
        $data = array();
        if (!$issues) {
            $this->responseNotExixted();
        }
        
        $user_model = $this->loadModel('user');
        $proj_model = $this->loadModel('project');
        foreach ($issues as $issue) {
            $type_id = BugType::getIdByInterId($issue->type);
            $opened_user = $user_model->getById($issue->openedBy);
            $assgined_user = $user_model->getById($issue->assignedTo);
            $project = $proj_model->getById($issue->project);
            $_issue = array(
                'id' => (int)$issue->id,
                'subject' => $issue->title,
                'project' => array('id' => $issue->project, 'name' => $project->name),
                'tracker' => array('id' => 1, 'name' => 'Bug'), //$issue->type
                'status' => array('id' => 1, 'name' => 'active'),
                'priority' => array('id' => (int)$issue->pri, 'name' => $issue->pri),
                'author' => array('id' => $opened_user->id, 'name' => $issue->openedBy), //TODO
                'category' => array('id' => $type_id, 'name' => BugType::findLabelById($type_id)), //TODO
                'assigned_to' => array('id' => $assgined_user->id, 'name' => $issue->assignedTo), //TODO
                'description' => '',//$issue->steps //有特殊符号会挂掉
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
        $model = $this->loadModel('bug');
        $issue = $model->getById($id);
        if (!$issue) {
            $this->responseNotExixted();
        }
        
        $user_model = $this->loadModel('user');
        $proj_model = $this->loadModel('project');
        $type_id = BugType::getIdByInterId($issue->type);
        $opened_user = $user_model->getById($issue->openedBy);
        $assgined_user = $user_model->getById($issue->assignedTo);
        $project = $proj_model->getById($issue->project);

        $_issue = array(
            'id' => (int)$issue->id,
            'project' => array('id' => (int)$issue->project, 'name' => $project->name),
            'subject' => $issue->title,
            'tracker' => array('id' => 1, 'name' => 'Bug'),//
            'category' => array('id' => $type_id, 'name' => BugType::findLabelById($type_id)), //TODO
            'priority' => array('id' => (int)$issue->pri, 'name' => $issue->pri),
            'author' => array('id' => $opened_user->id, 'name' => $issue->openedBy),
            'assigned_to' => array('id' => $assgined_user->id, 'name' => $issue->assignedTo),
            'description' => '',//$issue->steps //有特殊符号会挂掉
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