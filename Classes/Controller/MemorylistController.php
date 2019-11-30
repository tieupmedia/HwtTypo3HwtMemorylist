<?php

declare(strict_types = 1);

namespace Hwt\HwtMemorylist\Controller;

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
 * Controller of memorylist
 *
 * @package TYPO3
 * @subpackage tx_hwtmemorylist
 * @author Heiko Westermann <hwt3@gmx.de>
 */
class MemorylistController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    protected function _init() {
        if ( !empty($this->settings['recordTypes']) ) {
            $this->recordtypes = $this->settings['recordTypes'];
        }
    }



    /**
     * Output a list view of items on the memorylist
     */
    public function listAction() {
        $this->_init();

        $records = new \ArrayObject();

        // get session data
        $memorylistList = $GLOBALS['TSFE']->fe_user->getKey('ses', 'HwtMemorylistList');

        // get list of items, if memory list exists
        if ( !empty($memorylistList) ) {
            // decode list from session data
            $memorylistList = json_decode($memorylistList, true);

            // get record for each list item
            foreach($memorylistList as $item) {
                $item = explode('_', $item);

                // load record, if repository exists
                if ( isset($this->recordtypes[$item[0]]['repository']) ) {
                    $repository = $this->objectManager->get($this->recordtypes[$item[0]]['repository']);

                    $records->append($repository->findByUid($item[1]));
                }
            }
        }
        $this->view->assign('records', $records);


        // if request is done with ajax, return json response directly
        if ( $GLOBALS['TSFE']->type == $this->settings['ajax']['typeNum'] ) {
            $this->view->assign('ajax', 1);
            $data = array(
                'status' => 'success',
                'content' => $this->view->render()
            );
            return json_encode($data);
        }
    }



    /**
     * Clear all items on the memorylist
     */
    public function clearAction() {
        $this->_init();

        // get session data
        $memorylistList = $GLOBALS['TSFE']->fe_user->getKey('ses', 'HwtMemorylistList');

        // clear memory list, if it exists
        if ( !empty($memorylistList) ) {
            $memorylistList = array();
            $GLOBALS['TSFE']->fe_user->setKey('ses', 'HwtMemorylistList', json_encode($memorylistList));
        }


        /*
         *  Forward to get updated list
         */
        $this->forward('list');


        /*
         * If the normal flow is corrupeted, we get here and can do special/error handling
         */

        // if request is done with ajax, return json response directly
        if ( $GLOBALS['TSFE']->type == $this->settings['ajax']['typeNum'] ) {
            $this->view->assign('ajax', 1);
            $data = array(
                'status' => 'success',
                'content' => $this->view->render()
            );
            return json_encode($data);
        }
    }



    /**
     * Adds an item to the memorylist
     *
     * @param string $model
     * @param string $id
     *
     * @return string
     */
    public function addAction($model, $id) {
        $this->_init();

        $data = false;
        $data['item'] = $model . '_' . $id;
        $data['recordtypes'] = $this->recordtypes;


        if ( isset($this->recordtypes[$model]) ) {
            // get session data
            $memorylistList = $GLOBALS['TSFE']->fe_user->getKey('ses', 'HwtMemorylistList');

            // get list or create empty one
            if (!empty($memorylistList)) {
                    // get list, if leflet exists
                $memorylistList = json_decode($memorylistList, true);
            } else {
                    // create empty memorylist, if memorylist not exists
                $memorylistList = [];
            }
            $data['before'] = $memorylistList;

            // add item, if it isn't already on the list
            $item = $model . '_' . $id;
            if ( !in_array($item, $memorylistList) ) {
                $memorylistList[] = $item;
                $GLOBALS['TSFE']->fe_user->setKey('ses', 'HwtMemorylistList', json_encode($memorylistList));

                $data['after'] = $memorylistList;
                $data['mymessage'] = 'OK!';


                /*
                 *  Forward to get updated list
                 */
                $this->forward('list');
            }
        }


        /*
         * If the normal flow is corrupeted, we get here and can do special/error handling
         */

        // if request is done with ajax, return json response directly
        if ( $GLOBALS['TSFE']->type == $this->settings['ajax']['typeNum'] ) {
                // if ajax request, return json data

            $data = array(
                'status' => 'bypass'
            );
            return json_encode($data);
        }
    }



    /**
     * Removes an item from the memorylist
     *
     * @param string $model
     * @param string $id
     *
     * @return string
     */
    public function removeAction($model, $id) {
        $this->_init();

        $data = false;
        $data['item'] = $model . '_' . $id;
        $data['recordtypes'] = $this->recordtypes;


        if (isset($this->recordtypes[$model])) {
            // get session data
            $memorylistList = $GLOBALS['TSFE']->fe_user->getKey('ses', 'HwtMemorylistList');

            // get list, if exists
            if (!empty($memorylistList)) {
                // get list, if leflet exists
                $memorylistList = json_decode($memorylistList, true);
                $data['before'] = $memorylistList;

                // remove item, if it is on the list
                $item = $model . '_' . $id;
                if (($key = array_search($item, $memorylistList)) !== false) {
                    unset($memorylistList[$key]);
                    $memorylistList = array_values($memorylistList); // keep order
                    $GLOBALS['TSFE']->fe_user->setKey('ses', 'HwtMemorylistList', json_encode($memorylistList));

                    $data['after'] = $memorylistList;
                    $data['mymessage'] = 'OK!';


                    /*
                     *  Forward to get updated list
                     */
                    $this->forward('list');
                }
            }
        }


        /*
         * If the normal flow is corrupeted, we get here and can do special/error handling
         */

        // if request is done with ajax, return json response directly
        //if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {}
        if ( $GLOBALS['TSFE']->type == $this->settings['ajax']['typeNum'] ) {
                // if ajax request, return json data

            $data = array(
                'status' => 'bypass'
            );
            return json_encode($data);
        }
    }
}