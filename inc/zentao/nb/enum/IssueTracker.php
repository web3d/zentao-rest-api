<?php

namespace zentao\nb\enum;

class IssueTracker {
    
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
    
    public function getLabel() {
        
    }
}