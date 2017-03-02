## ��ʹ��

```php
require "vendor/autoload.php";

use EasyPay\Trade;
use EasyPay\Payment;

// ʹ��֧������ҳ֧��
$trade = new Trade(Payment::ALI_WAP_PAY, [
    // Ӧ��ID
    'app_id'            =>  '2016073100130857',
    // �û����ɵ�˽Կ֤��
    'ssl_private_key'   =>  'ssl/ali/rsa1/rsa_private_key.pem',
    // �����ṩ�Ĺ�Կ֤��
    'ali_public_key'    =>  'ssl/ali/rsa1/ali_public_key.pem',
    // ɳ�����
    'is_sand_box'       =>  true,
]);

// EasyPay���ɵ�֧����תurl
$url = $trade->execute([
    // ��������
    'subject'               =>  "ali pay test",
    // ������ϸ��Ϣ
    'body'                  =>  "����֧����֧���Ĳ��Զ���",
    // ������(������ɵĶ�����,�Ϊ64λ)
    'out_trade_no'          =>  substr(md5(uniqid()),0,18).date("YmdHis"),
    // ֧�����,��λΪԪ,��С�ɾ�ȷ����(0.01)
    'total_amount'          =>  '1',
    // ��Ʒ���� 0����������Ʒ��1��ʵ������Ʒ
    'goods_type'            =>  '1',
    // ������ʱʱ��(m-���ӣ�h-Сʱ��d-�죬1c-����)
    'timeout_express'       =>  '15m',
    // ֧����ɺ�,�첽֪ͨ��ַ
    'notify_url'            =>  'http://examples.com/',
    // ֧�����,�û����ص�ҳ��
    'return_url'            =>  'http://examples.com/',
    // �տ�֧�����û�ID
    'seller_id'             =>  '',
    // �û���Ȩ��
    'auth_token'            =>  '',
    // ���۲�Ʒ��
    'product_code'          =>  '',
    // ���ûش�����
    'passback_params'       =>  '',
    // �Żݲ���
    'promo_params'          =>  '',
    // ҵ����չ����(��ϸ��鿴�ӿ��ĵ�)
    'extend_params'         =>  '',
    // ָ���û�֧������,ͨ��","���зָ�
    'enable_pay_channels'   =>  '',
    // ָ���û������õ�����,ͨ��","���зָ�
    'disable_pay_channels'  =>  '',
    // �̻��ŵ���
    'store_id'              =>  '',
]);

// ֧����֧����ʽΪ��������̨url,Ȼ����ת,���û�����֧��
header("Location: {$url}");
```

## Todo
* ����֧������������
* ��RSA���ܷ���Ϊ�����Ŀ�,ͬʱ�����Կ����
* ֧�ֶ��ֱ���(Ŀǰ��֧��utf-8)
* �ĵ�������
* ��֧�����������칦�ܽ��г���
* ��ҵת�˲�ѯ
* App֧��
