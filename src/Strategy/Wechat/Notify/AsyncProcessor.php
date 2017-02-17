<?php
namespace EasyPay\Strategy\Notify;

use Exception;
use EasyPay\Strategy\Wechat\Data;
use EasyPay\Interfaces\AsyncProcessorInterface;

/**
 * �첽֪ͨ������
 *
 * Class AsyncProcessor
 * @package EasyPay\Strategy\Notify
 */
class AsyncProcessor implements  AsyncProcessorInterface
{
    /**
     * ��ȡ֪ͨ����
     *
     * @return Data
     * @throws Exception
     */
    public function getNotify()
    {
        if (empty($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('�޷����������');
        }
        // ���������ж�ȡ����
        $input = file_get_contents("php://input");
        $body = Data::createDataFromXML($input);
        $body->checkResult();

        return $body;
    }

    /**
     * @param string $result
     * @return string
     */
    public function success($result = 'OK')
    {
        return $this->replyNotify([
            'return_code' => 'SUCCESS' ,
            'return_msg' => $result
        ]);
    }

    /**
     * @param Exception $exception
     * @return string
     */
    public function fail(Exception $exception)
    {
        return $this->replyNotify([
            'return_code' => 'FAIL' ,
            'return_msg' => $exception->getMessage()
        ]);
    }

    /**
     * ��ȡ�첽֪ͨ����Ӧ����
     *
     * @param $message
     * @return string
     */
    public function replyNotify($message)
    {
        $res = new Data($message);

        return $res->toXml();
    }
}