<?php

namespace zentao\nb\resource;

use zentao\nb\enum\BugType;

/**
 * 项目自行定义的问题分类
 */
class IssueCategory extends \zentao\nb\resource {
    
    public function fetchAll($format = 'json') {
        global $app;

        $types = $app->loadLang('bug')->bug->typeList;
        $issue_categories = array();
        foreach ($types as $key => $name) {
            
            $issue_categories[] = array('id' => BugType::getIdByInterId($key), 'name' => $name);
        }
        
        echo json_encode(array('issue_categories' => $issue_categories));
    }
    
    /**
     *   根据项目来取其中定义的分类
     * @param int $projectId
     * @param string $format
     */
    public function fetchAllByProjectId($projectId, $format = 'json') {
        $model = $this->loadModel('project');
        $project = $model->getById($projectId);//TODO 支持按项目代号查找
        if (!$project) {
            $this->responseNotExixted();
        }
        
        global $app;
        $types = $app->loadLang('bug')->bug->typeList;
        $issue_categories = array();
        foreach ($types as $key => $name) {
            
            $issue_categories[] = array('id' => BugType::getIdByInterId($key), 'project' => array('id' => $projectId, 'name' => $project->name), 'name' => $name);
        }
        
        echo json_encode(array(
            'issue_categories' => $issue_categories,
            'total_count' => 2
        ));
    }
}