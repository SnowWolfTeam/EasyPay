<?php
namespace EasyPay\Utils;

use Ant\Http\Body;
use Ant\Http\Request;
use Ant\Http\Response;
use Psr\Http\Message\RequestInterface;

/**
 * ���׵�Http�ͻ���
 *
 * Class HttpClient
 * @package EasyPay\Utils
 */
class HttpClient
{
    protected $options = [
        'CURLOPT_TIMEOUT'           =>  30,
        'CURLOPT_ENCODING'          =>  '',
        'CURLOPT_IPRESOLVE'         =>  1,
        'CURLOPT_RETURNTRANSFER'    =>  true,
        'CURLOPT_SSL_VERIFYPEER'    =>  false,
        'CURLOPT_SSL_VERIFYHOST'    =>  false,
        'CURLOPT_CONNECTTIMEOUT'    =>  10,
        'CURLOPT_HEADER'            =>  true
    ];

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     */
    public function __construct($method, $uri, array $options = [])
    {
        $this->options = array_merge($this->options, isset($options['curl']) ? $options['curl'] : []);
        $header = (isset($options['header']) ? $options['header'] : []);

        $this->request = new Request($method, $uri, $header);
    }

    /**
     * @param $item
     * @param null $value
     * @return $this
     */
    public function setCurlOption($item, $value = null)
    {
        if (is_array($item)) {
            foreach($item as $key => &$value){
                $this->options[$key] = $value;
            }
        } else {
            $this->options[$item] = $value;
        }

        return $this;
    }

    /**
     * @param $item
     * @param null $default
     * @return null
     */
    public function getCurlOption($item, $default = null)
    {
        return array_key_exists($item, $this->options)
            ? $this->options[$item]
            : $default;
    }

    /**
     * ����һ��Request����
     *
     * @param RequestInterface $request
     */
    public function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }

    /**
     * ����ָ�����ݵ������
     *
     * @param null|Body|string $body
     * @return Response
     */
    public function send($body = null)
    {
        if ($body instanceof Body) {
            $this->request = $this->request->withBody($body);
        } elseif (is_string($body)) {
            $this->request->getBody()->write($body);
        }

        return $this->request();
    }

    /**
     * ����һ��http����
     *
     * @return Response
     */
    public function request()
    {
        $ch = $this->curlInit();

        if (false === $result = curl_exec($ch)) {
            throw new \RuntimeException(curl_error($ch), curl_errno($ch));
        }

        return Response::createFromResponseStr($result);
    }

    /**
     * ��ʼ��curl���
     *
     * @return resource
     */
    protected function curlInit()
    {
        $ch = curl_init((string)$this->request->getUri());

        // ����Curlѡ��
        foreach ($this->options as $key => $val) {
            if (is_string($key)) {
                $key = constant(strtoupper($key));
            }
            curl_setopt($ch, $key, $val);
        }

        // ����Http����
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->request->getMethod());
        $header = [];
        foreach ($this->request->getHeaders() as $headerName => $headerValue) {
            if (is_array($headerValue)) {
                $headerValue = implode(',', $headerValue);
            }

            $headerName = implode('-', array_map('ucfirst', explode('-',$headerName)));
            $header[] = sprintf('%s: %s', $headerName, $headerValue);
        }

        // ����Http header����
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        // ����Http body����
        curl_setopt($ch, CURLOPT_POSTFIELDS, (string)$this->request->getBody());

        return $ch;
    }
}