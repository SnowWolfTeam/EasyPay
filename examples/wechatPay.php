<?php
include "../vendor/autoload.php";

try {
    // ʹ��΢��ɨ��֧��
    $trade = new \EasyPay\Trade('wechat.qr.pay' , [
    ]);

    $url = $trade->execute([
    ]);

} catch (\Exception $e) {
    // ��ӡ��������Ϣ
    echo "������ϢΪ : {$e->getMessage()}","<br>";
    echo "�����ļ�Ϊ : {$e->getFile()}, ������Ϊ : {$e->getLine()}";
}