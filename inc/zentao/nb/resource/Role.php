<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * 用户角色与权限
 */
class Role extends Resource {
    
    public function fetchAll($format = 'json') {
        $model = $this->loadModel('group');
        
        $groups = $model->getList();
        $total_count = $model->dao->count();
        
        $data = array();
        if (!$groups) {
            $this->responseNotExixted();
        }
        
        foreach ($groups as $group) {
            $_group = array(
                'id' => $group->id,
                'name' => $group->name,
            );
            $data[] = $_group;
        }
        
        $this->response(array('roles' => $data, 'total_count' => $total_count, 'offset' => 0, 'limit' => $total_count));
    }
    
    public function fetch($id, $format = 'json') {
        $model = $this->loadModel('group');
        $group = $model->getByID($id);
        $privs = $model->getPrivs($id);
        if (!$group) {
            $this->responseNotExixted();
        }
        
        $_group = array(
            'id' => $group->id,
            'name' => $group->name,
            'permissions' => $privs
        );
        $this->response(array('role' => $_group));
    }
}