<?php
include "../vendor/autoload.php";

try {
    // 使用支付宝网页支付
    $trade = new \EasyPay\Trade('ali.wap.pay' , [
        // 支付宝应用id
        'app_id'            =>  '2016072900120125',
        // 签名加密方式(目前仅支持RSA,RSA2两种)
        'sign_type'         =>  'RSA',
        // 生成的RSA密钥,用于生成签名(可用openssl或者支付宝自带的密钥生成器来生成)
        'ssl_private_key'   =>  'ssl/ali/rsa1/rsa_private_key.pem',
        // 支付宝提供的公钥,用于验证签名
        'ali_public_key'    =>  'ssl/ali/rsa1/ali_public_key.pem',
        // 是否是沙箱测试(默认为沙箱测试)
        'is_sand_box'       =>  true
    ]);

    // EasyPay生成的支付跳转url
    $url = $trade->execute([
        // 订单标题
        'subject'           =>  "ali pay test",
        // 订单详细信息
        'body'              =>  "这是支付宝支付的测试订单",
        // 订单号(随机生成的订单号,最长为64位)
        'out_trade_no'      =>  substr(md5(uniqid()),0,18).date("YmdHis"),
        // 支付金额,单位为元,最小可精确到分(0.01)
        'total_amount'      =>  '1',
        // 商品类型 0—虚拟类商品，1—实物类商品
        'goods_type'        =>  '1',
        // 订单超时时间(m-分钟，h-小时，d-天，1c-当天)
        'timeout_express'   =>  '15m',
        // 支付完成后,重定向地址
        'return_url'        =>  'http://example.com',
        // 支付完成后,异步通知地址
        'notify_url'        =>  'http://example.com',
    ]);

    // 支付宝支付方式为生成收银台url,然后跳转,由用户进行支付
    header("Location: {$url}");
} catch (\Exception $e) {
    // 打印错误县信息
    echo "错误信息为 : {$e->getMessage()}","<br>";
    echo "错误文件为 : {$e->getFile()}, 错误行为 : {$e->getLine()}";
}