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
 * @copyright  Copyright (c) 2015 Dominik Pfaffenbauer (http://dominik.pfaffenbauer.at)
 * @license    http://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace DemoTaxManager;

use CoreShop\Model\Country;
use CoreShop\Model\Plugin\TaxManager;
use CoreShop\Model\Tax;
use CoreShop\Model\TaxCalculator;
use CoreShop\Plugin as CorePlugin;
use CoreShop\Tool;

class Shop implements TaxManager
{
    /**
     * Attach Events for CoreShop
     *
     * @throws \Zend_EventManager_Exception_InvalidArgumentException
     */
    public function attachEvents()
    {
        CorePlugin::getEventManager()->attach("tax.getTaxManager", function ($e) {
            return $this;
        });
    }

    /**
     * @param Country $country
     * @param string $type
     *
     * @return bool
     */
    public static function isAvailableForCountry(Country $country, $type)
    {
        if (intval($country->getId()) === 2) {
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