<?php

namespace zentao\nb\resource;

/**
 * 问题状态
 */
class IssueStatus extends \zentao\nb\resource {
    
    public function index($format = 'json') {
        var_dump($format);
        var_dump(func_get_args());
    }
}