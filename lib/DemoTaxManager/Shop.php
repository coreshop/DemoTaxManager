<?php
/**
 * DemoTaxManager
 *
 * LICENSE
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015-2016 Dominik Pfaffenbauer (https://www.pfaffenbauer.at)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace DemoTaxManager;

use CoreShop\Model\Country;
use CoreShop\Model\Plugin\TaxManager;
use CoreShop\Model\Tax;
use CoreShop\Model\TaxCalculator;
use CoreShop\Model\User\Address;
use CoreShop\Plugin as CorePlugin;
use CoreShop\Tool;
use Pimcore\Model\Object\Fieldcollection\Data\CoreShopUserAddress;

/**
 * Class Shop
 * @package DemoTaxManager
 */
class Shop implements TaxManager
{
    /**
     * Attach Events for CoreShop
     *
     * @throws \Zend_EventManager_Exception_InvalidArgumentException
     */
    public function attachEvents()
    {
        \Pimcore::getEventManager()->attach("coreshop.tax.getTaxManager", function ($e) {
            return $this;
        });
    }

    /**
     * @param Address $address
     * @param string $type
     *
     * @return bool
     */
    public static function isAvailableForThisAddress(Address $address, $type)
    {
        if (intval($address->getCountry()->getId()) === 2) {
            return true;
        }

        return false;
    }

    /**
     * Return the tax calculator associated to this address
     *
     * @return TaxCalculator
     */
    public function getTaxCalculator()
    {
        $tax = new Tax();
        $tax->setRate(0);
        $tax->setName("Empty Rate");

        return new TaxCalculator(array($tax));
    }
}
