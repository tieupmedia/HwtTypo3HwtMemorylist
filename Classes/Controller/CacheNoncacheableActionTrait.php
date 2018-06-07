<?php

namespace Hwt\HwtMemorylist\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2018 Heiko Westermann <hwt3@gmx.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * Trat to cache actions, which are not cacheable by default in plugin configuration.
 * E.g. necessary for plugin output in powermail mails.
 *
 * @package TYPO3
 * @subpackage tx_hwtmemorylist
 * @author Heiko Westermann <hwt3@gmx.de>
 */
trait CacheNoncacheableActionTrait {

    /**
     * Cache action
     *
     * @param string $action action to call
     */
    public function cacheAction($action='list') {
        if ( !empty($this->settings['actionToCache']) ) {
            $this->forward($action);   
        } else {
            $msg = sprintf('If "cache" action is used, "%s" key must be set in plugin settings.', 'actionToCache');
            throw new \InvalidArgumentException($msg);
        }
    }
}