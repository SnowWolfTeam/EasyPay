<?php
namespace EasyPay;


class Notify
{
    /**
     * @var array
     */
    protected static $modes = [
        'ali'     =>  \EasyPay\Notify\Ali\Processor::class,
    ];

    /**
     * ��ȡ�첽���������
     *
     * @param $mode
     * @return \EasyPay\Interfaces\AsyncNotifyProcessorInterface
     */
    public static function getProcessor($mode)
    {
        $class = isset(static::$modes[$mode]) ? static::$modes[$mode] : $mode;

        if (!class_exists($class)) {
            throw new \RuntimeException('֪ͨ������������');
        }

        return new $class;
    }
}