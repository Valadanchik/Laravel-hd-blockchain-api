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
    public function createWallet($password,$label = '', $email = '' );

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
    public function makePayment($guid, $password, $secondPassword = '',$to,$amount,$from='',$fee = '');

    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function fetchingWalletBalance($guid,$password);

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