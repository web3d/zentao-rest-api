<?php

namespace zentao\nb\enum;
/**
 * 将 bug 的类型映射为整型 以对应 redmine
 */
class BugType {
    
    const UNKNOWN = 0;
    const CODE_ERROR = 1;
    const INTERFACE_ERROR = 2;
    const DESIGN_CHANGED = 3;
    const NEW_FEATURE = 4;
    const DESIGN_DEFETCT = 5;
    const CONFIG = 6;
    const INSTALL = 7;
    const SECURITY = 8;
    const PERFORMANCE = 9;
    const STANDARD = 10;
    const AUTOMATION = 11;
    const TRACK_THINGS = 12;
    const OTHERS = 13;
    
    const INTER_UNKNOWN = '';
    const INTER_CODE_ERROR = 'codeerror';
    const INTER_INTERFACE_ERROR = 'interface';
    const INTER_DESIGN_CHANGED = 'designchange';
    const INTER_NEW_FEATURE = 'newfeature';
    const INTER_DESIGN_DEFETCT = 'designdefect';
    const INTER_CONFIG = 'config';
    const INTER_INSTALL = 'install';
    const INTER_SECURITY = 'security';
    const INTER_PERFORMANCE = 'performance';
    const INTER_STANDARD = 'standard';
    const INTER_AUTOMATION = 'automation';
    const INTER_TRACK_THINGS = 'trackthings';
    const INTER_OTHERS = 'others';
    
    /**
     *
     * @var array issue类型标识与 整型 id 的对应 只支持系统默认的类型
     */
    protected static $map = array(
        self::INTER_UNKNOWN => self::UNKNOWN,
        self::INTER_CODE_ERROR => self::CODE_ERROR,
        self::INTER_INTERFACE_ERROR => self::INTERFACE_ERROR,
        self::INTER_DESIGN_CHANGED => self::DESIGN_CHANGED,
        self::INTER_NEW_FEATURE => self::NEW_FEATURE,
        self::INTER_DESIGN_DEFETCT => self::DESIGN_DEFETCT,
        self::INTER_CONFIG => self::CONFIG,
        self::INTER_INSTALL => self::INSTALL,
        self::INTER_SECURITY => self::SECURITY,
        self::INTER_PERFORMANCE => self::PERFORMANCE,
        self::INTER_STANDARD => self::STANDARD,
        self::INTER_AUTOMATION => self::AUTOMATION,
        self::INTER_TRACK_THINGS => self::TRACK_THINGS,
        self::INTER_OTHERS => self::OTHERS,
    );
    
    public static function getMap() {
        return self::$map;
    }
    
    /**
     * 
     * @param string $interId
     * @return int
     */
    public static function getIdByInterId($interId) {
        return isset(self::$map[$interId]) ? self::$map[$interId] : self::UNKNOWN;
    }
    
    /**
     * 根据客户端传来的 ID取其 在禅道中的标识如 postponed
     */
    public static function getInterIdById($id) {
        $inter_id = array_search($id, self::$map);
        if ($inter_id === false) {
            $inter_id = self::INTER_UNKNOWN;
        }
    }
    
    /**
     * 根据客户端传来的 ID取其 label 名,如 延期处理
     * @global \zentao\core\Application $app
     * @param int $id
     */
    public static function findLabelById($id) {
        global $app;

        $inter_id = self::getInterIdById($id);
        
        $types = $app->loadLang('bug')->bug->typeList;
        return isset($types[$inter_id]) ? $types[$inter_id] : $types[self::INTER_UNKNOWN];
    }
}