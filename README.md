## ��ʹ��

```php
require "vendor/autoload.php";

try {
    // ʹ��֧������ҳ֧��
    $trade = new \EasyPay\Trade('ali.wap.pay', [
        'app_id'            =>  '2016073100130857',
        'ssl_private_key'   =>  'ssl/ali/rsa1/rsa_private_key.pem',
        'ali_public_key'    =>  'ssl/ali/rsa1/ali_public_key.pem',
        'is_sand_box'       =>  true,
    ]);

    // EasyPay���ɵ�֧����תurl
    $url = $trade->execute([
        // ֧��������
        'body'              =>  "�����ͧ",
        'subject'           =>  "��һ��",
        'out_trade_no'      =>  substr(md5(uniqid()),0,18).date("YmdHis"),
        'total_amount'      =>  '1',
        'goods_type'        =>  '1',
        'timeout_express'   =>  '15m',
        'return_url'        =>  'http://192.168.0.106/notify.php'
    ]);

    // ��ת��֧��ҳ��
    header("Location: {$url}");
} catch (\Exception $e) {
    var_dump($e->getMessage());
    var_dump($e->getLine(), $e->getFile());
}
```

## Todo
* ����֧������������
* ��RSA���ܷ���Ϊ�����Ŀ�,ͬʱ�����Կ����
* ֧�ֶ��ֱ���(Ŀǰ��֧��utf-8)
* �ĵ�������
* ��֧�����������칦�ܽ��г���
