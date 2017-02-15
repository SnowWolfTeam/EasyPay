<?php
namespace EasyPay\PayApi;

use ArrayAccess;
use ArrayIterator;
use JsonSerializable;
use IteratorAggregate;
use UnexpectedValueException;

abstract class Collection implements ArrayAccess,JsonSerializable,IteratorAggregate
{
    /**
     * 生成的数据
     *
     * @var array
     */
    protected $items = [];

    /**
     * 通过XML获取数据集
     *
     * @param string[XML] $input
     * @return static
     */
    public static function createDataFromXML($input)
    {
        $backup = libxml_disable_entity_loader(true);
        $result = simplexml_load_string($input,\EasyPay\XmlElement::class,LIBXML_NOCDATA);
        libxml_disable_entity_loader($backup);

        if ($result === false) {
            throw new \UnexpectedValueException('XML Error');
        }

        return new static($result->toArray());
    }

    /**
     * 通过JSON数据获取数据集
     *
     * @param $input
     * @param $assoc
     * @param $depth
     * @param $options
     * @return static
     */
    public static function createDataFromJson($input, $assoc, $depth, $options)
    {
        $result = json_decode($input, $assoc, $depth, $options);

        if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \UnexpectedValueException(json_last_error_msg(), json_last_error());
        }

        return new static($result);
    }

    /**
     * PayDataBuilder Construct
     *
     * @param \Iterator|array $items
     */
    public function __construct($items)
    {
        $this->replace($items);
    }

    /**
     * 生成JSON数据
     *
     * @return string
     */
    public function toJson()
    {
        $value = json_encode($this);

        if ($value === false && json_last_error() !== JSON_ERROR_NONE) {
            throw new UnexpectedValueException(json_last_error_msg(), json_last_error());
        }

        return $value;
    }

    /**
     * 生成XML数据
     *
     * @return string
     */
    public function toXml()
    {
        $dom = new \EasyPay\XmlElement('<xml/>');

        foreach($this->items as $key => $value){
            $dom->addChild($key,$value);
        }

        return $dom->asXML();
    }

    /**
     * 替换原有数据
     *
     * @param \Iterator|array $items
     */
    public function replace($items)
    {
        foreach($items as $key => $value){
            $this->items[$key] = $value;
        }
    }

    /**
     * 转换为数组格式
     *
     * @return array
     */
    public function toArray()
    {
        return $this->items;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->items;
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @param mixed $offset
     * @return null
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset,$value)
    {
        $this->$offset = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset,$this->items);
    }

    /**
     * @param $offset
     * @param $value
     */
    public function __set($offset,$value)
    {
        $this->items[$offset] = $value;
    }

    /**
     * @param $offset
     * @return null
     */
    public function __get($offset)
    {
        return isset($this->items[$offset]) ? $this->items[$offset] : null;
    }

    /**
     * 检查参数是否为空
     * PHP7后isset有改动,如果用了重载的方式加载对象属性,可能会出现错误
     *
     * @param $offset
     * @return bool
     */
    public function __isset($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param $offset
     */
    public function __unset($offset)
    {
        unset($this->items[$offset]);
    }
}