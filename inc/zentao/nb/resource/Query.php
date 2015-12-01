<?php

namespace zentao\nb\resource;

use zentao\nb\Resource;

/**
 * redmine 中支持保存用户自定义查询条件
 */
class Query extends Resource {
    
    public function index() {
        echo json_encode(array(
            'queries' => array(),
            'total_count' => 0,
            'offset' => 0,
            'limit' => 25
        ));
    }
}