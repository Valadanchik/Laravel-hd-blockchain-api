<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28/09/2017
 * Time: 19:09
 */
namespace Valadanchik\BlockChain\Payments\Interfaces;

interface IBlockChain{
    /***
     * Create wallet
     *
     * @param $password
     * @param string $label
     * @param string $email
     * @return mixed
     */
    public function createWallet($password, $email = '', $label = 'BuySell'  );

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
    public function makePayment($guid, $password, $to, $amount, $fee = 10);

    /***
     * set callback on address
     * @param $address
     * @param $callback
     * @param $key
     * @param $onNotification
     * @param $confs
     * @param $op
     * @return mixed
     */

    public function balance_update($address, $callback, $onNotification, $confs = '', $op= '' );


    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function fetchingWalletBalance($guid,$password);

     /***
     * @param $address
     * @param $confs
     * @return mixed
     */
    public function addressConfirmedBalance($address, $confs);

    /***
     * List all active addresses in a wallet. Also includes a 0 confirmation balance which should be used as an estimate only and will include unconfirmed transactions and possibly double spends.
     *
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function listingAddresses($guid,$password);

    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function listingActiveHDAccounts($guid,$password);

    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function enableHDFunction($guid,$password);
}