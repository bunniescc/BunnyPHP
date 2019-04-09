<?php
/**
 * Created by PhpStorm.
 * User: IvanLu
 * Date: 2018/7/28
 * Time: 18:03
 */

class Controller
{
    protected $_variables = [];
    protected $_controller;
    protected $_action;
    protected $_mode;
    protected $_storage;

    public function __construct($controller, $action, $mode = BunnyPHP::MODE_NORMAL)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_mode = $mode;
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getAction()
    {
        return $this->_action;
    }

    public function assign($name, $value): Controller
    {
        $this->_variables[$name] = $value;
        return $this;
    }

    public function assignAll($arr): Controller
    {
        $this->_variables = array_merge($this->_variables, $arr);
        return $this;
    }

    public function render($template = '')
    {
        View::render($template, $this->_variables, $this->_mode);
    }

    public function renderTemplate($template = '')
    {
        Template::render($template, $this->_variables);
    }

    public function error($code = 200)
    {
        View::error($this->_variables, $this->_mode, $code);
    }

    public function redirect($url, $action = null, $params = [])
    {
        View::redirect($url, $action, $params);
    }

    public function service($serviceName): Service
    {
        $service = ucfirst($serviceName) . 'Service';
        return new $service;
    }

    public function storage(): Storage
    {
        return BunnyPHP::getStorage();
    }

    public function cache(): Cache
    {
        return BunnyPHP::getCache();
    }
}