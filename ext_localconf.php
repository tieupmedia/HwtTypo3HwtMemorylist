<?php

if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

$extensionKey = 'hwt_memorylist';


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Hwt.' . $extensionKey,
    'Memorylist',
    array(
        'Memorylist' => 'list, add, remove, clear',
    ),
    array(
        'Memorylist' => 'list, add, remove, clear',
    )
);