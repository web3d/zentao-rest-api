<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 项目
 */
class Project extends Resource {
    
    /**
     * 获取所有项目列表 暂不支持分页
     * @param string $format
     */
    public function fetchAll($format = 'json') {
        
        $model = $this->loadModel('project');
        
        $projects = $model->getList();
        $total_count = $model->dao->count();
        
        $data = array();
        if (!$projects) {
            $this->responseNotExixted();
        }
        
        foreach ($projects as $project) {
            $_proj = array(
                'id' => $project->id,
                'name' => $project->name,
                'identifier' => $project->code,
                'description' => $project->desc,
                'status' => 1,//TODO
                'created_on' => $project->begin,//禅道没有记录 用这个代替
                'updated_on' => $project->end,//禅道没有记录 用这个代替
            );
            $data[] = $_proj;
        }

        
        $this->response(array('projects' => $data, 'total_count' => $total_count, 'offset' => 0, 'limit' => $total_count));
    }
    
    /**
     * 返回指定项目得详细数据
     * @param int|string $id
     * @param string $format
     */
    public function fetch($id, $format = 'json') {
        $model = $this->loadModel('project');
        $project = $model->getById($id);//TODO 支持按项目代号查找
        if (!$project) {
            $this->responseNotExixted();
        }
        
        $_proj = array(
            'id' => $project->id,
            'name' => $project->name,
            'identifier' => $project->code,
            'description' => $project->desc,
            'status' => 1,//TODO
            'created_on' => $project->begin,//禅道没有记录 用这个代替
            'updated_on' => $project->end,//禅道没有记录 用这个代替
        );
        $this->response(array('project' => $_proj));
    }
}