<?php
namespace EasyPay\Strategy\Ali;

use Ant\Support\Arr;
use EasyPay\Exception\PayParamException;

class TransfersQuery extends BaseAliStrategy
{
    /**
     * {@inheritDoc}
     */
    protected function buildData()
    {
        if (!$this->payData['out_biz_no'] && !$this->payData['order_id']) {
            throw new PayParamException("缺少订单号");
        }

        return parent::buildData();
    }

    /**
     * {@inheritDoc}
     */
    protected function getMethod()
    {
        return BaseAliStrategy::CLOSE_ORDER;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequireParams()
    {
        return ['app_id'];
    }

    /**
     * {@inheritDoc}
     */
    protected function getFillParams()
    {
        return [
            'app_id', 'method', 'format', 'charset', 'sign_type', 'sign',
            'timestamp', 'version', 'app_auth_token', 'biz_content'
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function buildBinContent()
    {
        $data = [
            // 商户转账唯一订单号
            'out_biz_no'            =>  $this->payData['out_biz_no'],
            // 支付宝转账单据号
            'order_id'              =>  $this->payData['order_id'],
        ];

        Arr::removalEmpty($data);

        return $data;
    }
}