<?php
namespace EasyPay\Interfaces;

/**
 * Interface AsyncNotifyProcessorInterface
 * @package EasyPay\Interfaces
 */
interface AsyncNotifyProcessorInterface extends NotifyProcessorInterface
{
    /**
     * �첽��Ϣ����ɹ�
     *
     * @param $result
     */
    public function success($result = null);

    /**
     * �첽��Ϣ����ʱ�����쳣
     *
     * @param \Exception $exception
     */
    public function fail(\Exception $exception);
}