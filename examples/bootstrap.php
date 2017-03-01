<?php
include "../vendor/autoload.php";

\EasyPay\Config::loadConfig([
    'wechat'    =>  [
        // Ӧ��id
        'appid'         =>  'xxxxxxxxxxxxxxxxxx',
        // Ӧ����Կ
        'key'           =>  'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
        // �̻�ID
        'mch_id'        =>  'xxxxxxxxxx',
        // �ص���ַ
        'notify_url'    =>  'http://example.com',
        // ssl֤��·��
        'ssl_cert_path' => '',
        // ssl��Կ·��
        'ssl_key_path'  => '',
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