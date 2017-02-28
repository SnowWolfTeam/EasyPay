<?php
namespace EasyPay\Notify\Ali;


use EasyPay\DataManager\Ali\Data;
use EasyPay\Interfaces\AsyncNotifyProcessorInterface;

class AsyncProcessor implements AsyncNotifyProcessorInterface
{
    public function getNotify()
    {
        if (empty($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('�޷����������');
        }

        $data = new Data($_POST);
        $data->verifySign();

        return $data;
    }

    /**
     * �첽��Ϣ����ɹ�
     *
     * @param $result
     * @return string
     */
    public function success($result = null)
    {
        return "success";
    }

    /**
     * �첽��Ϣ����ʱ�����쳣
     *
     * @param \Exception $exception
     * @return string
     */
    public function fail(\Exception $exception)
    {
        return 'fail';
    }
}