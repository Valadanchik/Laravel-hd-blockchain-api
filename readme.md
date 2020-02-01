#### Installation
##### Composer

Update the composer.json file:

~~~~
"require": {
        "valadanchik/blockchain": "dev-master",
    },
    "repositories": [
         {
              "type": "vcs",
              "url": "https://github.com/Valadanchik/Laravel-hd-blockchain-api"
         }
    ]
~~~~

##### Add provider config

In  **config/app.php**  file, load package service provider into your app

~~~~
'providers' => [
    ...,

    Valadanchik\BlockChain\BlockChainServiceProvider::class,
    ...
]
~~~~

##### Public package

~~~~
php artisan vendor:publish --provider="Valadanchik\BlockChain\BlockChainServiceProvider"
~~~~


        ```


##### Call function

~~~~
use Valadanchik\BlockChain\BlockChainFacade;
~~~~


##### Interface
 ~~~~
    /***
     * Create wallet
     *
     * @param $password
     * @param string $label
     * @param string $email
     * @return mixed
     */
    public function createWallet($password,$label = '', $email = '' );
~~~~

~~~~
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
~~~~

~~~~
    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function fetchingWalletBalance($guid,$password);
~~~~

~~~~
    /***
     * List all active addresses in a wallet. Also includes a 0 confirmation balance which should be used as an estimate only and will include unconfirmed transactions and possibly double spends.
     *
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function listingAddresses($guid,$password);
~~~~

~~~~
    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function listingActiveAccounts($guid,$password);
~~~~

~~~~
    /***
     * @param $guid
     * @param $password
     * @return mixed
     */
    public function enableHDFunction($guid,$password);
~~~~