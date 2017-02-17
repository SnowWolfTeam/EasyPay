<?php
namespace EasyPay\Strategy\Wechat;

use EasyPay\Config;
use EasyPay\Interfaces\StrategyInterface;
use FastHttp\Client;

/**
 * Class BaseWechatStrategy
 * @package EasyPay\Strategy\Wechat
 */
abstract class BaseWechatStrategy implements StrategyInterface
{
    // ���𶩵�URL
    const INIT_ORDER_URL = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    // ��ѯ����URL
    const QUERY_ORDER_URL = 'https://api.mch.weixin.qq.com/pay/orderquery';
    // �رն���URL
    const CLOSE_ORDER_URL = 'https://api.mch.weixin.qq.com/pay/closeorder';
    // �˿�URL
    const REFUND_URL = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
    // ��ѯ�˿�URL
    const REFUND_QUERY_URL = 'https://api.mch.weixin.qq.com/pay/refundquery';
    // ���ض��˵���ַ
    const DOWN_LOAD_BILL_URL = 'https://api.mch.weixin.qq.com/pay/downloadbill';
    // ΢��ת�˵�ַ
    const TRANSFERS_URL = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";

    /**
     * @param array $option
     */
    public function __construct(array $option)
    {
        $this->payData = new Data($option);
    }

    /**
     * ����һ��Http����
     *
     * @param $method
     * @param $url
     * @param $body
     * @return Data
     */
    public function sendHttpRequest($method, $url, $body)
    {
        // ��ʼ��Http�ͻ���
        $client = new Client($method, $url);

        if (Config::wechat('ssl_key_path') && Config::wechat('ssl_cert_path')) {
            // ���SSL֤��
            $client->setCurlOption([
                'CURLOPT_SSLKEY'        =>  Config::wechat('ssl_key_path'),
                'CURLOPT_SSLCERT'       =>  Config::wechat('ssl_cert_path'),
                'CURLOPT_SSLKEYTYPE'    =>  'PEM',
                'CURLOPT_SSLCERTTYPE'   =>  'PEM',
            ]);
        }

        $response = $client->send((string)$body);
        // ������ӦXml����
        $result = Data::createDataFromXML((string)$response->getBody());
        // ����Ƿ���ȷ
        $result->checkResult();

        return $result;
    }
}