<?php

namespace BlockCypher\Test\Validation;

use BlockCypher\Core\BlockCypherCoinSymbolConstants;
use BlockCypher\Crypto\CoinSymbolNetworkMapping;

class CoinSymbolNetworkMappingTest extends \PHPUnit_Framework_TestCase
{
    public static function positiveProvider()
    {
        BlockCypherCoinSymbolConstants::COIN_SYMBOL_LIST();

        $positiveValues = array();
        foreach (BlockCypherCoinSymbolConstants::COIN_SYMBOL_LIST() as $coinSymbol) {
            $positiveValues[] = array($coinSymbol);
        }

        return array(
            array('btc'),
            array('btc-testnet'),
            array('ltc'),
            //array('doge'),
            //array('uro'),
            //array('bcy'),
        );
    }

    public static function invalidProvider()
    {
        return array(
            array(null),
            array(''),
            array('     '),
            array('INVALID COIN SYMBOL'),
            array(1),
            array(1.0),
            array(true),
            array('doge'),
            array('uro'),
            array('bcy'),
        );
    }

    /**
     *
     * @dataProvider positiveProvider
     */
    public function testGetNetwork($coinSymbol)
    {
        $this->assertInstanceOf('\BitWasp\Bitcoin\Network\NetworkInterface', CoinSymbolNetworkMapping::getNetwork($coinSymbol));
    }

    /**
     * @dataProvider invalidProvider
     * @expectedException \Exception
     */
    public function testInvalidDataValidate($coinSymbol)
    {
        $this->assertInstanceOf('\BitWasp\Bitcoin\Network\NetworkInterface', CoinSymbolNetworkMapping::getNetwork($coinSymbol));
    }

}