<?php
namespace EasyPay\Strategy\Ali;


use Ant\Support\Arr;
use EasyPay\Exception\PayParamException;

class RefundQuery extends BaseAliStrategy
{
    /**
     * {@inheritDoc}
     */
    protected function getMethod()
    {
        return BaseAliStrategy::REFUND_QUERY;
    }

    /**
     * {@inheritDoc}
     */
    protected function getRequireParamsList()
    {
        if (!$this->payData['out_trade_no'] && !$this->payData['trade_no']) {
            throw new PayParamException("ȱ�ٶ�����");
        }

        return ['app_id','out_request_no'];
    }

    /**
     * {@inheritDoc}
     */
    protected function getApiParamsList()
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
            // �̻�Ψһ������
            'out_trade_no'          =>  $this->payData['out_trade_no'],
            // ֧����Ψһ������
            'trade_no'              =>  $this->payData['trade_no'],
            // ��ʶһ���˿�����
            'out_request_no'        =>  $this->payData['out_request_no'],
        ];

        Arr::removalEmpty($data);

        return $data;
    }
}