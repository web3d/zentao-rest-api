<?php

namespace zentao\nb\resource;

/**
 * 问题的类型 用 bug 的类型来代替
 * 
 */
class Tracker extends \zentao\nb\resource {
    /**
     *
     * @var array issue类型标识与 整型 id 的对应 只支持系统默认的类型
     */
    protected $map = array(
        'null' => 0,
        'bydesign' => 1,
        'duplicate' => 2,
        'external' => 3,
        'fixed' => 4,
        'notrepro' => 5,
        'postponed' => 6,
        'willnotfix' => 7,
        'tostory' => 8
    );

    public function index($format = 'json') {
        global $app;

        $types = $app->loadLang('bug')->bug->resolutionList;
        $trackers = array();
        foreach ($types as $key => $type) {
            if ($type == '') {
                $type = '-';
            }
            
            $trackers[] = array('id' => (isset($this->map[$key]) ? $this->map[$key] : $this->map['null']), 'name' => $type);
        }
        
        echo json_encode(array('trackers' => $trackers));
    }
}