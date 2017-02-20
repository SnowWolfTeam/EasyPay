<?php
namespace EasyPay\Strategy;

use EasyPay\Interfaces\StrategyInterface;

abstract class BaseStrategy implements StrategyInterface
{
    /**
     * ��������
     *
     * @return mixed
     */
    abstract protected function buildData();

    /**
     * ��ȡ�����Http����
     *
     * @return mixed
     */
    abstract protected function getRequestMethod();

    /**
     * ��ȡ�����Ŀ��
     *
     * @return string
     */
    abstract protected function getRequestTarget();

    /**
     * ����ӿڷ��ؽ��
     *
     * @param $result
     * @return mixed
     */
    abstract protected function handleResult($result);
}