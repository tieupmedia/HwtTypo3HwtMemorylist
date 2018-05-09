<?php

namespace Hwt\HwtMemorylist\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Heiko Westermann <hwt3@gmx.de>
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
 * Custom page repository with findByUid function
 *
 * @package TYPO3
 * @subpackage tx_hwtmemorylist
 * @author Heiko Westermann <hwt3@gmx.de>
 */
class PageRepository extends \TYPO3\CMS\Frontend\Page\PageRepository {

    /**
     * Redirect findByUid to parent getPage method
     *
     * @param int $uid
     * @return \stdClass
     */
    public function findByUid($uid) {
        // return stdClass with page properties, cause no page model exists in TYPO3 core
        $pageObject = (object)parent::getPage($uid);

        return $pageObject;
    }
}