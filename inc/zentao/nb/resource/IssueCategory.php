<?php

namespace zentao\nb\resource;

use zentao\nb\enum\IssueCategory AS Category;

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
                $status = '-';
            }
            
            $issue_statuses[] = array('id' => $key, 'name' => $status);
        }
        
        echo json_encode(array('issue_categories' => $issue_statuses));
    }
    
    /**
     *  用 分类来区分 禅道中的任务和 bug
     * @param int $projectId
     * @param string $format
     */
    public function fetchAllByProjectId($projectId, $format = 'json') {
        $model = $this->loadModel('project');
        $project = $model->getById($projectId);//TODO 支持按项目代号查找
        if (!$project) {
            $this->responseNotExixted();
        }
        echo json_encode(array(
            'issue_categories' => array(
                array('id' => Category::BUG, 'name' => 'Bug', 'project' => array('id' => $projectId, 'name' => $project->name)),
                array('id' => Category::TASK, 'name' => 'Task', 'project' => array('id' => $projectId, 'name' => $project->name)),
            ),
            'total_count' => 2
        ));
    }
}