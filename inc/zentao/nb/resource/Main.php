<?php

namespace zentao\nb\resource;

/**
 * 默认控制器
 */
class Main extends \zentao\nb\Resource {
    
    public function index() {
        echo json_encode('yes');
    }
}