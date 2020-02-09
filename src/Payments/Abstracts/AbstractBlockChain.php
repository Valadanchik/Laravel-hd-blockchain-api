<?php

namespace Valadanchik\BlockChain\Payments\Abstracts;
use Valadanchik\BlockChain\Payments\Interfaces\IBlockChain;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/09/2017
 * Time: 17:48
 */
abstract class AbstractBlockChain extends GlobalFunctions implements IBlockChain
{
    protected $local_url = 'http://127.0.0.1:3000';
    /**
     * 1BTC = 100000000;
     * @var  integer
     */
    const SATOSHI = 100000000;
    /***
     * @param $url
     * @return mixed
     */
    public abstract function setUrl($url);

    /***
     * @param $apiKey
     * @return mixed
     */
    public abstract function setApiKey($apiKey);

    /***
     * Create wallet
     *
     * @param $password
     * @param string $label
     * @param string $email
     * @return mixed
     */
    public function createWallet($password, $email = '', $label = 'BuySell'){
        $fullUrl = "{$this->url}{$this->urlCreateWallet}";
        return   $this->postRequest($fullUrl,[
            'password' => $password,
            'email' => $email,
            'label' => $label,
        ]);
    }
    /***
     * Make single payment
     *
     * @param $guid
     * @param $password
     * @param $to
     * @param $amount
     * @param string $fee
     * @return mixed
     */
    public function makePayment($guid, $password, $to, $amount, $fee = '10'){
        $fullUrl = sprintf("{$this->url}{$this->urlMakePayment}",$guid);
        $options = json_encode(array(
            'password' => $password,
            'amount' => $amount,
            'to' => $to,
            'api_code' => $this->apiKey,
            'from' => 0,
            'fee_per_byte' => $fee,
        ));
        $curl = curl_init($fullUrl);
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $options );
        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array('Content-Type: application/json',
                'Content-Length: ' . strlen($options))
        );
        $response = curl_exec( $curl );
        $response = json_decode($response, true);
        return   $response;
    }

    /**
     * @param float amount
     * @param string guid
     * @param string password
     * @param string to_address
     * @param optional string from_address
     * @return array of the result
     */


    public function makeOutgoingPayment($guid, $amount, $password, $to_address, $from_address = '') {
        //convert btc amount to satoshi by multiplying by 100000000
        //make api calls
        $params = array(
            'password' => $password,
            // 'second_password ' => our second Blockchain Wallet password if double encryption is enabled,
            'api_code' => '6f306855-fcc7-4157-93ac-5ca19ef332a4',
            'to' => $to_address,
            'amount' => $amount,
            'from' => $from_address,
            // 'fee' => $fee,
        );
        $local_url = $this->local_url;
        $url = "$local_url/merchant/$guid/payment?".http_build_query($params);
        $json_data = file_get_contents($url);
        $json_feed = json_decode($json_data, true);
        return $json_feed;
    }


    /***
     * @param $address
     * @param $callback
     * @param $key
     * @param $onNotification
     * @param $confs
     * @param $op
     * @return mixed
     */

    public function balance_update($address, $callback, $onNotification,$confs = '', $op= '' ){
        $fullUrl = sprintf("{$this->api_url}{$this->urlUPdateBalance}");
        $postData = [
            'address' => $address,
            'callback' => $callback,
            'confs' => $confs,
            'onNotification' => $onNotification,
            'op' => $op,
        ];

        if(empty($confs)){
            unset($postData["confs"]);
        }
        if(empty($onNotification)){
            unset($postData["onNotification"]);
        }
        if(empty($op)){
            unset($postData["op"]);
        }

        return   $this->postRequest($fullUrl,$postData);
    }

    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function fetchingWalletBalance($guid,$password){
        $fullUrl = sprintf("{$this->url}{$this->urlFetchBalance}",$guid);
        return   $this->postRequest($fullUrl,[
            'password' => $password
        ]);
    }

    /***
     * List all active addresses in a wallet. Also includes a 0 confirmation balance which should be used as an estimate only and will include unconfirmed transactions and possibly double spends.
     *
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function listingAddresses($guid,$password){
        $fullUrl = sprintf("{$this->url}{$this->urlListAddresses}",$guid);
        return   $this->postRequest($fullUrl,[
            'password' => $password
        ]);
    }

    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function listingActiveHDAccounts($guid,$password){
        $fullUrl = sprintf("{$this->url}{$this->urlListActiveHDAccounts}",$guid);
        return   $this->postRequest($fullUrl,[
            'password' => $password
        ]);
    }

    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function enableHDFunction($guid,$password){
        $fullUrl = sprintf("{$this->url}{$this->urlEnableHDFunctionality}",$guid);
        return   $this->postRequest($fullUrl,[
            'password' => $password
        ]);
    }
}