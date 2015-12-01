<?php

namespace zentao\nb\resource;

/**
 * 问题的类型 用 bug 的类型来代替
 * 
 */
class Tracker extends \zentao\nb\resource {

    public function index($format = 'json') {
        
        echo json_encode(array('trackers' => array()));
    }
}