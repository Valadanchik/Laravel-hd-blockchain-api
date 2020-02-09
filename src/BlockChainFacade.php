<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 02/06/2017
 * Time: 17:45
 */

namespace Valadanchik\BlockChain;

use Valadanchik\BlockChain\Payments\BlockChain;
use Illuminate\Support\Facades\Facade;

class BlockChainFacade extends Facade
{

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return BlockChain::class; // the IoC binding.
    }

}