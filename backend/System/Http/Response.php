<?php

/**
 *
 * This file is part of mvc-rest-api for PHP.
 *
 */
namespace Http;

/**
 * Class Response an Http response
 *
 * @author Mohammad Rahmani <rto1680@gmail.com>
 *
 * @package Http
 */
class Response {

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var array
     */
    protected $statusTexts = [

        200 => 'OK',
        201 => 'Created',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        500 => 'Internal Server Error',

    ];

    /**
     * @var
     */
    protected $version;

    /**
     * @var
     */
    protected $content;

    /**
     * Response constructor.
     */
    public function __construct () {
        $this->setVersion('1.1');
    }

    /**
     *  Set the Http protocol version
     *
     * @param string $version
     */
    public function setVersion(string $version) {
        $this->version = $version;
    }

    /**
     *  Get the Http protocol version
     *
     * @return string
     */
    public function getVersion() : string {
        return $this->version;
    }

    /**
     *  Get the status code text.
     *
     * @param int $code
     * @return string
     */
    public function getStatusCodeText(int $code) : string {
        return (string) isset($this->statusTexts[$code]) ? $this->statusTexts[$code] : 'unknown status';
    }

    /**
     *  Set the response Headers.
     *
     * @param $header
     */
    public function setHeader(String $header) {
        $this->headers[] = $header;
    }

    /**
     *  Get the response Headers.
     *
     * @return array
     */
    public function getHeader() {
        return $this->headers;
    }

    /**
     *  Set content response.
     *
     * @param $content
     */
    public function setContent($content) {
        $this->content = json_encode($content);
    }

    /**
     *  Get content response.
     *
     * @return mixed
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param $url
     */
    public function redirect($url) {
        if (empty($url)) {
            trigger_error('Cannot redirect to an empty URL.');
            exit;
        }

        header('Location: ' . str_replace(array('&amp;', "\n", "\r"), array('&','', ''), $url), true, 302);
        exit();
    }

    /**
     *  check status code is invalid
     *
     * @return bool
     */
    public function isInvalid(int $statusCode) : bool {
        return $statusCode < 100 || $statusCode >= 600;
    }

    public function sendStatus($code) {
        if (!$this->isInvalid($code)) {
            $this->setHeader(sprintf('HTTP/1.1 ' . $code . ' %s' , $this->getStatusCodeText($code)));
        }
    }

    /**
     *  Render Output
     */
    public function render() {
        if ($this->content) {
            $output = $this->content;

            // Headers
            if (!headers_sent()) {
                foreach ($this->headers as $header) {
                    header($header, true);
                }
            }
            
            echo $output;
        }
    }
}
