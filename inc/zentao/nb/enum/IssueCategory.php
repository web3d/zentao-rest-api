<?php

namespace zentao\nb\enum;

/**
 * Issue分类 枚举类型定义
 * 尝试将禅道中的任务和 bug 以 redmine 分类的形式提供
 */
class IssueCategory {
    
    const BUG = 1;
    const TASK = 2;
    
    /**
     * bug 编号的固定前缀
     */
    const PREFIX_BUG = 100;
    
    /**
     * 任务编号的固定前缀
     */
    const PREFIX_TASK = 200;
    
    public function getLabels() {
        return array(
            self::BUG => 'Bug',
            self::TASK => 'Task'
        );
    }
}