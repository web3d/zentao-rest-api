<?php

namespace zentao\nb\resource;

/**
 * 问题的类型
 */
class Tracker extends \zentao\nb\resource {
    
    public function index($format = 'json') {
        global $app;

        $types = $app->loadLang('bug')->bug->resolutionList;
        $trackers = array();
        foreach ($types as $key => $type) {
            if ($type == '') {
                $type = 'unknown';
            }
            
            $trackers[] = array('id' => $key, 'name' => $type);
        }
        
        echo json_encode(array('trackers' => $trackers));
    }
}