<?php

namespace Valadanchik\BlockChain\Payments;
use anlutro\cURL\cURL;

use Valadanchik\BlockChain\Payments\Abstracts\AbstractBlockChain;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/09/2017
 * Time: 17:48
 */
class BlockChain extends AbstractBlockChain
{
    /***
     * BlockChain constructor.
     * @param cURL $cURL
     */
    public function __construct(cURL $cURL)
    {
        parent::__construct($cURL);
        $this->url = config('blockchain.url');
        $this->apiKey = config('blockchain.api_key');
    }

    /***
     * @param $url
     * @return mixed
     */
    public function setUrl($url){
        $this->url = $url;
        return $this;
    }

    /***
     * @param $apiKey
     * @return mixed
     */
    public function setApiKey($apiKey){
        $this->apiKey = $apiKey;
        return $this;
    }

}