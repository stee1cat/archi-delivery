<?php

/**
 * @package archi-delivery
 * @author Gennadiy Khatuntsev <e.steelcat@gmail.com>
 * @link https://github.com/stee1cat/archi-delivery
 */

namespace ArchiDelivery;

class Loader {

    const METHOD_GET = 1;

    const METHOD_POST = 2;

    /**
     * URL страницы
     *
     * @var string
     */
    protected $url = '';

    /**
     * Содержимое страницы
     *
     * @var string
     */
    protected $content = '';

    /**
     * Заголовки
     *
     * @var array
     */
    protected $headers = array();

    /**
     * Ответ сервера
     *
     * @var string
     */
    protected $response = '';

    /**
     * @var resource
     */
    protected $curl;

    /**
     * GET-параметры
     *
     * @var array
     */
    protected $getParams = array();

    /**
     * POST-параметры
     *
     * @var array
     */
    protected $postParams = array();

    /**
     * @var int
     */
    protected $method;

    public function __construct() {
        $this->method = self::METHOD_GET;
    }

    public function __destruct() {
        $this->close();
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public function get($url = '') {
        $result = false;
        if ($url) {
            $this->url = $url;
        }
        $this->init($this->url);
        $this->setopt();
        if ($this->exec()) {
            $result = $this->content;
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function getHeader($name = '') {
        if ($name) {
            foreach ($this->headers as $header) {
                if (preg_match('/' . preg_quote($name, '/') . '/is', $header)) {
                    return $header;
                }
            }
        }
        return false;
    }

    /**
     * @return bool|string
     */
    public function getCharset() {
        $header = $this->getHeader('Content-Type');
        preg_match('/^.*charset=(.*).*$/is', $header, $matches);
        return (isset($matches[1]))? strtolower($matches[1]): false;
    }

    /**
     * @return bool
     */
    public function isHTML() {
        $header = $this->getHeader('Content-Type');
        return (preg_match('/text\/html;/isu', $header))? true: false;
    }

    /**
     * @return bool
     */
    public function isXML() {
        $header = $this->getHeader('Content-Type');
        return (preg_match('/text\/xml;/isu', $header))? true: false;
    }

    /**
     * @return bool
     */
    public function isText() {
        $header = $this->getHeader('Content-Type');
        return (preg_match('/text;/isu', $header))? true: false;
    }

    /**
     * @param $url
     */
    public function setURL($url) {
        $this->url = $url;
    }

    /**
     * @param array $params
     */
    public function setGetParams(array $params) {
        $this->getParams = $params;
    }

    /**
     * @param array $params
     */
    public function setPostParams(array $params) {
        $this->postParams = $params;
    }

    /**
     * @param $url
     */
    private function init($url) {
        if ($this->getParams) {
            $this->url .= '?' . http_build_query($this->getParams);
        }
        echo $this->url . PHP_EOL;
        $this->curl = curl_init($this->url);
    }

    /**
     * @return string
     */
    private function exec() {
        $this->response = curl_exec($this->curl);
        $info = curl_getinfo($this->curl);
        // Получаем строку заголовков
        $headers = substr($this->response, 0, $info['header_size'] - 1);
        // Преобразовыаем строку в массив
        $headers = explode("\r\n", $headers);
        // Удаляемм пустые элементы массива
        $this->headers = array_diff($headers, array(''));
        // Получаем тело ответа
        $this->content = substr($this->response, $info['header_size']);
        return $this->content;
    }

    /**
     * Устанавливает параметры для сеанса cURL
     *
     */
    private function setopt() {
        curl_setopt_array($this->curl, array(
            CURLOPT_HEADER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_BINARYTRANSFER => true,
            CURLINFO_HEADER_OUT => true,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.97 Safari/537.22'
        ));
    }

    /**
     * Завершает сеанс cURL
     *
     */
    private function close() {
        if (!is_null($this->curl)) {
            curl_close($this->curl);
        }
    }

}