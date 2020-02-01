<?php

namespace Valadanchik\BlockChain\Payments\Abstracts;

use anlutro\cURL\cURL;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/09/2017
 * Time: 17:48
 */
abstract class GlobalFunctions
{
    protected $url;
    protected $apiKey;
    protected $curl;

    ///api/v2/create
    protected $urlCreateWallet = '/api/v2/create';

    //merchant/:guid/payment;
    protected $urlMakePayment = "/merchant/%s/payment";

    ///merchant/:guid/balance
    protected $urlFetchBalance =  '/merchant/%s/balance';

    //Enable HD Functionality: /merchant/:guid/enableHD
    protected $urlEnableHDFunctionality =  '/merchant/%s/enableHD';

    //List Active HD Accounts /merchant/:guid/accounts
    protected $urlListActiveHDAccounts=  '/merchant/%s/accounts';

    //List all active addresses in a wallet. Also includes a 0 confirmation balance which should be used as an estimate only and will include unconfirmed transactions and possibly double spends.
    protected $urlListAddresses =  '/merchant/%s/list';

    /***
     * AbstractBlockChain constructor.
     */
    public function __construct(cURL $cURL)
    {
        $this->url = config('blockchain.url');
        $this->apiKey = config('blockchain.blockchain_api');
        $this->curl = $cURL;
    }
    
    /***
     * Request has method = POST
     *
     * @param $url
     * @param $data
     * @return mixed
     */
    public function postRequest($url,$data){
        array_push($data,'api_code',$this->apiKey);
        return $this->getResponse($this->curl->post($url, $data));
    }

    /***
     * Request has method = GET
     *
     * @param $url
     * @param $data
     * @return mixed
     */
    public function getRequest($url,$data){
        return $this->getResponse($this->curl->get($this->url, $this->parameters));
    }

    /***
     * Get response from API
     *
     * @param $response
     * @return mixed
     */
    public function getResponse($response){
        $responseArray =  [];
        array_push($responseArray,'body',\GuzzleHttp\json_decode($response->body));
        array_push($responseArray,'status',$response->statusCode);
        array_push($responseArray,'message',$response->statusText);
        return $responseArray;
    }

}