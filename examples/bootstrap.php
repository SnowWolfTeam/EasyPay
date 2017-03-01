<?php
include "../vendor/autoload.php";

\EasyPay\Config::loadConfig([
    'wechat'    =>  [
        // Ӧ��id
        'appid'         =>  'wx4ed56f6568a5b870',
        // Ӧ����Կ
        'key'           =>  'h0l4j5tYu22MoPdt6N7A8v8C9eRTT48u',
        // �̻�ID
        'mch_id'        =>  '1399107302',
        // �ص���ַ
        'notify_url'    =>  'http://example.com',
        // ssl֤��·��
        'ssl_cert_path' => '../ssl/apiclient_cert.pem',
        // ssl��Կ·��
        'ssl_key_path'  => '../ssl/apiclient_key.pem',
    ],
    'ali'       =>  [
        // ֧����Ӧ��id
        'app_id'            =>  '2016072900120125',
        // ǩ�����ܷ�ʽ(Ŀǰ��֧��RSA,RSA2����)
        'sign_type'         =>  'RSA2',
        // ���ɵ�RSA��Կ,��������ǩ��(����openssl����֧�����Դ�����Կ������������)
        'ssl_private_key'   =>  'ssl/ali/rsa2/rsa_private_key.pem',
        // ֧�����ṩ�Ĺ�Կ,������֤ǩ��
        'ali_public_key'    =>  'ssl/ali/rsa2/ali_public_key.pem',
        // �Ƿ���ɳ�����(Ĭ��Ϊɳ�����)
        'is_sand_box'       =>  true,
    ]
]);