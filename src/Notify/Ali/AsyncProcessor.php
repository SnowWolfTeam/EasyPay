<?php
namespace EasyPay\Notify\Ali;


use EasyPay\DataManager\Ali\Data;
use EasyPay\Interfaces\AsyncNotifyProcessorInterface;

class AsyncProcessor implements AsyncNotifyProcessorInterface
{
    public function getNotify()
    {
        if (empty($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new \Exception('无法处理的请求');
        }

        $data = new Data($_GET);
        $data->verifySign();

        return $data;
    }

    /**
     * 异步信息处理成功
     *
     * @param $result
     */
    public function success($result = null)
    {

    }

    /**
     * 异步信息处理时出现异常
     *
     * @param \Exception $exception
     */
    public function fail(\Exception $exception)
    {

    }

    /**
     * 获取异步通知的响应内容
     *
     * @param $message
     */
    public function replyNotify($message)
    {

    }
}