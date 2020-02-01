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
    public function createWallet($password,$label = '', $email = '' ){
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
     * @param string $secondPassword
     * @param $to
     * @param $amount
     * @param string $from
     * @param string $fee
     * @return mixed
     */
    public function makePayment($guid, $password, $secondPassword = '',$to,$amount,$from='',$fee = ''){
        $fullUrl = sprintf("{$this->url}{$this->urlMakePayment}",$guid);
        $postData = [
            'password' => $password,
            'second_password' => $secondPassword,
            'to' => $to,
            'amount' => $amount,
            'from' => $from,
            'fee' => $fee,
        ];


        if(empty($secondPassword)){
            array_forget($postData,'second_password');
        }
        if(empty($from)){
            array_forget($postData,'from');
        }
        if(empty($fee)){
            array_forget($postData,'fee');
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