<?php
include "../vendor/autoload.php";

\EasyPay\Config::loadConfig([
    'wechat'    =>  [
        // Ӧ��id
//        'appid'         =>  'xxxxxxxxxxxxxxxxxx',
        'appid'         =>  'wx4ed56f6568a5b870',
        // Ӧ����Կ
//        'key'           =>  'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        'key'           =>  'h0l4j5tYu22MoPdt6N7A8v8C9eRTT48u',
        // �̻�ID
//        'mch_id'        =>  'xxxxxxxxxx',
        'mch_id'        =>  '1399107302',
        // �ص���ַ
        'notify_url'    => 'http://example.com',
    ],
    'ali'       =>  [
        // ֧����Ӧ��id
        'app_id'            =>  '2016072900120125',
        // ǩ�����ܷ�ʽ(Ŀǰ��֧��RSA,RSA2����)
        'sign_type'         =>  'RSA',
        // ���ɵ�RSA��Կ,��������ǩ��(����openssl����֧�����Դ�����Կ������������)
        'ssl_private_key'   =>  'ssl/ali/rsa1/rsa_private_key.pem',
        // ֧�����ṩ�Ĺ�Կ,������֤ǩ��
        'ali_public_key'    =>  'ssl/ali/rsa1/ali_public_key.pem',
        // �Ƿ���ɳ�����(Ĭ��Ϊɳ�����)
        'is_sand_box'       =>  true
    ]
]);