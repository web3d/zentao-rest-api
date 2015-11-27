<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 项目 的版本
 */
class ProjectVersion extends Resource {
    
    public function fetchAll($projectId, $format = 'json') {
        $model = $this->loadModel('build');
        
        $builds = $model->getProjectBuilds($projectId);
        $total_count = $model->dao->count();
        //var_dump($builds);exit;
        
        $data = array();
        if (!$builds) {
            $this->responseNotExixted();
        }
        
        foreach ($builds as $build) {
            $_proj = array(
                'id' => $build->id,
                'project' => array('id' => $build->project, 'name' => $build->projectName),
                'name' => $build->name,
                'description' => $build->desc,
                'status' => 'open',//TODO
                'sharing' => 'none',
                'created_on' => date('Y-m-d\TH:i:s\Z', strtotime($build->date)),
                'updated_on' => date('Y-m-d\TH:i:s\Z', strtotime($build->date)),
            );
            $data[] = $_proj;
        }

        
        $this->response(array('versions' => $data, 'total_count' => $total_count));
    }
}