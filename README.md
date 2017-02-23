## ��ʹ��

```
namespace EasyPay;

require "vendor/autoload.php";

Config::loadConfig([
    'wechat' => [
        // ��֧����APPID
        'appid'         => 'xxxxxxxxxxxxxxxxxx',
        // �̻�֧����Կ
        'key'           => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        // �̻���
        'mch_id'        => 'xxxxxxxxxx',
        // �첽֪ͨ��ַ
        'notify_url'    => 'http://foobar.com',
        // ssl֤��·�� (�˿����ʹ��ssl)
        'ssl_cert_path' => __DIR__.DIRECTORY_SEPARATOR.'ssl/apiclient_cert.pem',
        // ssl��Կ·�� (�˿����ʹ��ssl)
        'ssl_key_path'  => __DIR__.DIRECTORY_SEPARATOR.'ssl/apiclient_key.pem'
    ],
    'ali'   =>  [
        // app_id
        'app_id'            => '2016072900120125',
        // RSAǩ�����õ�˽Կ֤��
        'ssl_private_key'   =>  'ssl/ali/rsa1/rsa_private_key_pkcs8.pem',
        // �Ƿ���ɳ�����
        'is_sand_box'       =>  true,
    ]
]);

try {
    // ʹ��֧������ҳ֧��
    $trade = new Trade(Trade::ALI_WAP_PAY);

    // EasyPay���ɵ�֧����תurl
    $url = $trade->execute([
        // ֧��������
        'body'              =>  "�����ͧ",
        'subject'           =>  "��һ��",
        'out_trade_no'      =>  substr(md5(uniqid()),0,18).date("YmdHis"),
        'total_amount'      =>  '90000',
        'goods_type'        =>  '1',
        'timeout_express'   =>  '15m',
    ]);

    // ��ת��֧��ҳ��
    header("Location: {$url}");
} catch (\Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getLine(),$e->getFile());
}
```

## Todo
* ����֧������������
* ��RSA���ܷ���Ϊ�����Ŀ�,ͬʱ�����Կ����
* ����֧������ʱ,��������Ϣ�붩����Ϣ����
* �ø������ŵķ�ʽ����֧����ʽ
* �ĵ�������
