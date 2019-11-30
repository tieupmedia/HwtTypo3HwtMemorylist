<?php

########################################################################
# Extension Manager/Repository config file for ext "hwt_memorylist".
#
# Auto generated 23-11-2012 14:26
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Flexible Memory List',
    'description' => 'Memory list plugin for TYPO3 >= 7.6',
    'category' => 'plugin',
    'author' => 'Heiko Westermann',
    'author_email' => 'hwt3@gmx.de',
    'author_company' => 'tie-up media',
    'shy' => '',
    'dependencies' => 'cms',
    'conflicts' => '',
    'priority' => '',
    'module' => '',
    'state' => 'beta',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '0.0.6',
    'constraints' => array(
        'depends' => array(
            'typo3' => '7.6.0-9.5.99',
            'php' => '7.0.1-7.2.99',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
    'autoload' => [
        'psr-4' => array(
            "Hwt\\HwtMemorylist\\" => "Classes/"
        )
    ],
);