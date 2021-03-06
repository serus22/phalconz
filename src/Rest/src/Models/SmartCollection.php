<?php

namespace PhalconZ\Rest\Models;

use Zend\InputFilter\InputFilter;
use Phalcon\Mvc\Collection;
use PhalconZ\Rest\Controllers\RestValidationException;

abstract class SmartCollection extends Collection
{
    /**
     * @var array
     */
    private $__blackList;


    /**
     * @var Filter
     */
    private $__filter;

    /**
     * @return array
     */
    public function getReservedAttributes()
    {
        $this->__blackList['__blackList'] = '__blacklList';
        $this->__blackList['__filter'] = '__filter';
        return array_values($this->__blackList);
    }

    /**
     * @param $name
     * @return SmartCollection
     */
    public function ignore($name)
    {
        $this->__blackList[$name] = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSource() {
        $a = explode('\\', get_called_class());
        return strtolower(end($a));
    }

    /**
     * @return InputFilter
     */
    public function filter()
    {
        if($this->__filter instanceof InputFilter) return $this->__filter;
        $class = str_replace('Models', 'Filters', get_called_class()) . 'Filter';
        if(class_exists($class))
            $this->__filter = new $class($this);
        return $this->__filter;
    }

    /**
     * @return bool
     * @throws RestValidationException
     */
    public function validation()
    {
        if(empty($this->filter())) return true;
        $data = $this->toArray();
        $this->filter()->setData($data);
        if($this->filter()->isValid()) return true;
        throw new RestValidationException($this->filter()->getMessages());
    }

    public function __call($name, $params)
    {
        if(substr($name, 0,3) === "get") {
            $a = lcfirst(substr($name, -1 * (strlen($name)-3)));
            if(isSet($this->$a)) return $this->$a;
        }
        return null;
    }

    /**
     * Updates a model instance. Returning true on success or false otherwise
     *
     * @return boolean
     */
    public function update()
    {
      // TODO: Implement update() method.
    }

    /**
     * Returns a cloned collection
     *
     * @param \Phalcon\Mvc\Collection $collection
     * @param array $document
     * @return \Phalcon\Mvc\Collection
     */
    public function dumpResult($collection, $document)
    {
      // TODO: Implement dumpResult() method.
    }

    /**
     * Creates a model instance. Returning true on success or false otherwise
     *
     * @return boolean
     */
    public function create()
    {
      // TODO: Implement create() method.
    }
}