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
    'state' => 'beta',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.2.0',
    'constraints' => array(
        'depends' => array(
            'typo3' => '9.5.0-10.2.99',
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