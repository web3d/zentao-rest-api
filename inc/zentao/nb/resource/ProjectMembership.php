<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 项目成员
 */
class ProjectMembership extends Resource {
    /**
     * 获取所有项目成员列表 暂不支持分页
     * @param string $format
     */
    public function fetchAll($projectId, $format = 'json') {
        
        $model = $this->loadModel('project');
        
        $project = $model->getById($projectId);//TODO 支持按项目代号查找
        if (!$project) {
            $this->responseNotExixted();
        }
        
        $total_count = $model->dao->count();
        $limit = !empty($_GET['limit']) ? (int)$_GET['limit'] : 0;
        $offset = !empty($_GET['offset']) ? (int)$_GET['offset'] : 0;
        if ($offset > 0) {
            $this->response(array('memberships' => array(), 'total_count' => $total_count, 'offset' => $limit * $offset, 'limit' => $limit));
        }
        
        $teams = $model->getTeamMembers($projectId);
        
        $data = array();
        if (!$teams) {
            $this->responseNotExixted();
        }
        
        foreach ($teams as $team) {
            $_team = array(
                'id' => $team->id,
                'project' => array('id' => $team->project, 'name' => $project->name),
                'user' => array('id' => 1, 'name' => $team->realname),
                //哪些角色有权限操作这个项目 redmine中体系比较复杂,还有group要考虑
                'roles' => array(array('id' => 0, 'name' => $team->role)),
            );
            $data[] = $_team;
        }
        
        $this->response(array('memberships' => $data, 'total_count' => $total_count, 'offset' => $limit * $offset, 'limit' => $limit));
    }
}