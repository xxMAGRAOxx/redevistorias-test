<?php
/**
 * Created by Carlos Magno
 * User: Carlos Magno
 * Contact: cmagnosoares@gmail.com
 * Github: https://github.com/xxMAGRAOxx
 *
 */

namespace ClientSide\Server;

/**
 * Class Request
 * Used to handle the connection with the server using cURL methods.
 * It`s HIGHLY RECOMMENDED that you DO NOT change this file.
 * @package BBM\Server
 */
class Request
{

    /**
     * @var
     */
    protected $_url;
    /**
     * @var bool
     */
    protected $_followlocation;
    /**
     * @var int
     */
    protected $_timeout;
    /**
     * @var int
     */
    protected $_maxRedirects;
    /**
     * @var
     */
    protected $_post;
    /**
     * @var
     */
    protected $_postFields;

    /**
     * @var
     */
    protected $_session;
    /**
     * @var
     */
    protected $_return;
    /**
     * @var
     */
    protected $_readableReturn;
    /**
     * @var bool
     */
    protected $_includeHeader;
    /**
     * @var bool
     */
    protected $_noBody;
    /**
     * @var
     */
    protected $_status;
    /**
     * @var bool
     */
    protected $_binaryTransfer;
    /**
     * @var
     */
    private $curlHandler;
    /**
     * @var int
     */
    private $authentication = 0;
    /**
     * @var string
     */
    private $auth_name      = '';
    /**
     * @var string
     */
    private $auth_pass      = '';

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->auth_name = $name;
    }

    /**
     * @param $pass
     */
    public function setPass($pass)
    {
        $this->auth_pass = $pass;
    }

    /**
     * @param      $url
     * @param bool $verbose
     * @param bool $followlocation
     * @param int  $timeOut
     * @param int  $maxRedirecs
     * @param bool $binaryTransfer
     * @param bool $includeHeader
     * @param bool $noBody
     */
    public function __construct($url, $verbose = false,$followlocation = true,$timeOut = 30,$maxRedirecs = 4,$binaryTransfer = false,$includeHeader = false,$noBody = false)
    {
        $this->_url = $url;
        $this->_followlocation = $followlocation;
        $this->_timeout = $timeOut;
        $this->_maxRedirects = $maxRedirecs;
        $this->_noBody = $noBody;
        $this->_includeHeader = $includeHeader;
        $this->_binaryTransfer = $binaryTransfer;
        $this->verbose = $verbose;
    }

    /**
     * @param $postFields
     */
    public function setPost($postFields)
    {
        $post = '';
        $this->_post = 1;
        $this->_postFields = $postFields;

        if($this->verbose)
            var_dump("POST FIELDS: ", $postFields);

        foreach($this->_postFields as $field => $value)
        {
            if(is_array($value))
                continue;

            $post[] = "$field=$value";
        }

        curl_setopt($this->curlHandler, CURLOPT_POST, $this->_post);
        curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, http_build_query($this->_postFields));
    }

    /**
     *
     */
    public function create()
    {
        $this->curlHandler = curl_init();

        curl_setopt($this->curlHandler,CURLOPT_URL,$this->_url);
        curl_setopt($this->curlHandler,CURLOPT_HTTPHEADER,array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($this->curlHandler,CURLOPT_TIMEOUT,$this->_timeout);
        curl_setopt($this->curlHandler,CURLOPT_MAXREDIRS,$this->_maxRedirects);
        curl_setopt($this->curlHandler,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->curlHandler,CURLOPT_FOLLOWLOCATION,$this->_followlocation);

        if($this->authentication)
        {
            curl_setopt($this->curlHandler, CURLOPT_USERPWD, $this->auth_name.':'.$this->auth_pass);
        }

        if($this->_includeHeader)
        {
            curl_setopt($this->curlHandler,CURLOPT_HEADER,true);
        }

        if($this->_noBody)
        {
            curl_setopt($this->curlHandler,CURLOPT_NOBODY,true);
        }

        if($this->_binaryTransfer)
        {
            curl_setopt($this->curlHandler,CURLOPT_BINARYTRANSFER,true);
        }

        curl_setopt($this->curlHandler,CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($this->curlHandler,CURLOPT_REFERER, $_SERVER['SERVER_NAME']);
    }

    /**
     *
     */
    public function execute()
    {
        if($this->verbose)
            var_dump("SENDING REQUEST TO: ", $this->_url);

        $this->_return = curl_exec($this->curlHandler);
        $this->_readableReturn = json_decode($this->_return, true);

        var_dump($this->_return);exit;

        $this->_status = curl_getinfo($this->curlHandler,CURLINFO_HTTP_CODE);
        curl_close($this->curlHandler);

        if($this->verbose)
            var_dump("RETURN: ", $this->_return);

        if($this->isSuccessfullRequest())
            return $this->_return;
        else
            throw new Exception($this->getResponse(), $this->getHttpStatus());
    }

    private function isSuccessfullRequest()
    {
        return ((in_array($this->_status, [200, 201]) && $this->getHttpStatus() === null) || in_array($this->getHttpStatus(), [200, 201]));
    }

    /**
     * @return mixed
     */
    public function getHttpStatus()
    {
        return @$this->_readableReturn['code'];
    }

    /**
     * @return mixed
     */
    public function getHttpTitle()
    {
        return @$this->_readableReturn['http_title'];
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return @$this->_readableReturn;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getResponse();
    }
}