<?php
/**
 * Created by JetBrains PhpStorm.
 * User: kudenv
 * Date: 9/16/13
 * Time: 4:22 PM
 * To change this template use File | Settings | File Templates.
 */

#namespace token;


class Vktoken {
    /**
     * Vktoken
     *
     * Methos auth to vk
     * @param $code (string) response code
     *
     */

    protected $client_id;
    protected $redirect_uri;
    protected $client_secret;
    protected $code;
    protected  $res = array();


    public  function __construct($client_id,$redirect_uri,$client_secret)
    {
        /**
         * @params $client_id (int) which set app config on vk app set
         * @params $redirect_uei (string) redirect url like $client_id
         * @params $client_secret (string) secret code
         */

        $this->client_id = $client_id;
        $this->redirect_uri = $redirect_uri;
        $this->client_secret = $client_secret;
    }


    public function getAuthUrl ()
    {
        /**
         * getCode
         * Method to get access code to generate accasse_token
         * scope level access to account data
         *return $url
        */

        $url = 'https://oauth.vk.com/authorize?client_id='.$this->client_id.'&scope=photos,friends&redirect_uri='.$this->redirect_uri.'&response_type=code&v=5.0';
        return $url;
    }
    public function getCode()
    {
        /**
         * getCode
         * Method to get response AuthUrl method
         * @params $code from $_GET['code']
         * return $code
        */
        $this->code = $_GET['code'];
        return $this->code;

    }

    public function getToken()
    {
        /**
         * getToken
         * Method to get access_token key return key
        */
        $params = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $this->code,
            'redirect_uri' => $this->redirect_uri
        );
        $res = $this->getRequest('oauth/access_token',$params);
        //$token  = $res['access_token'];
        return $this->res = $res;


    }
    public function  getRequest($method,$params) {
        /*
        *
         * getRequest
         * Method to get response from VK API
         * @param $method (string) method to VK API 'oauth/access_token'
         * @param $params (array) arrays of params for request
         *
        */
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_URL,'https://api.vk.com/'.$method.'?'. urldecode(http_build_query($params)));
        $rs= json_decode(curl_exec($ch),true);
        curl_close($ch);

        return $rs;
    }
}