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

    ///api/v2/receive/balance_update
    protected $urlUPdateBalance = '/v2/receive/balance_update';

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
        $this->api_url = config('blockchain.api_url');
        $this->apiKey = config('blockchain.api_key');
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
        $data['api_code'] = $this->apiKey;
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
        $responseArray['body'] = \GuzzleHttp\json_decode($response->body);
        $responseArray['status'] = $response->statusCode;
        $responseArray['message'] = $response->statusText;
        return $responseArray;
    }

}