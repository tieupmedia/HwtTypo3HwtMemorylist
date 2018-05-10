<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$extensionKey = 'hwt_memorylist';


/*
 * Register plugin
 */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Hwt.' . $extensionKey, 'Memorylist', 'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_be.xlf:plugin_memorylist'
);

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($extensionKey);
$pluginSignature = strtolower($extensionName) . '_memorylist';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $extensionKey . '/Configuration/FlexForms/Memorylist.xml');