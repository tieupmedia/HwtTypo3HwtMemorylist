<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$extensionKey = 'hwt_memorylist';


/*
 * Selectable default TypoScript
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extensionKey, 'Configuration/TypoScript', 'Flexible Memory List');