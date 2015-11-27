<?php

namespace zentao\nb;

/**
 * 资源类 父类
 */
class Resource {

    public function __construct() {
        
    }

    /**
     * Load the model file of one module.
     * 
     * @param   string      $methodName    The method name, if empty, use current module's name.
     * @access  public
     * @return  object|bool If no model file, return false. Else return the model object.
     */
    protected function loadModel($moduleName) {
        $modelFile = \helper::setModelFile($moduleName);

        /* If no model file, try load config. */
        if (!\helper::import($modelFile)) {
            $this->app->loadConfig($moduleName, false);
            $this->app->loadLang($moduleName);
            $this->dao = new dao();
            return false;
        }

        $modelClass = class_exists('ext' . $moduleName . 'model') ? 'ext' . $moduleName . 'model' : $moduleName . 'model';
        $modelClass = '\\' . $modelClass;
        if (!class_exists($modelClass))
            $this->app->triggerError(" The model $modelClass not found", __FILE__, __LINE__, $exit = true);

        $this->$moduleName = new $modelClass();
        $this->dao = $this->$moduleName->dao;
        return $this->$moduleName;
    }
    
    protected function response($data) {
        //TODO 支持多种格式
        echo json_encode($data);
        exit;
    }


    protected function responseNotExixted() {
        //TODO 错误时的处理
        exit;
    }

}
