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
 * @copyright  Copyright (c) 2015-2017 Dominik Pfaffenbauer (https://www.pfaffenbauer.at)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

namespace DemoTaxManager;

use Pimcore\API\Plugin\AbstractPlugin;
use Pimcore\API\Plugin\PluginInterface;

/**
 * Class Plugin
 * @package DemoTaxManager
 */
class Plugin extends AbstractPlugin implements PluginInterface
{
    /**
     * @var Shop
     */
    private static $shop;

    /**
     * preDispatch Plugin
     *
     * @param $e
     */
    public function preDispatch($e)
    {
        parent::preDispatch();
        
        self::getShop()->attachEvents();
    }

    /**
     * @return \DemoTaxManager\Shop
     */
    public static function getShop()
    {
        if (!self::$shop) {
            self::$shop = new Shop();
        }
        return self::$shop;
    }

    /**
     * Check if plugin is installed
     *
     * @return bool
     */
    public static function isInstalled()
    {
        return true;
    }

    /**
     * install plugin
     */
    public static function install()
    {
    }

    /**
     * uninstall plugin
     */
    public static function uninstall()
    {
    }
}
