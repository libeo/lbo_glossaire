<?php

use Libeo\LboGlossaire\Controller\GlossaryController;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// Plugin de liste du glossaire
ExtensionUtility::configurePlugin(
    'Libeo.LboGlossaire',
    'Glossary',
    array(
        GlossaryController::class => 'list'
    ),
    // non-cacheable actions
    array(
        GlossaryController::class => 'list'
    )
);


// Configuration Linkvalidator
if (ExtensionManagementUtility::isLoaded('linkvalidator')) {
    ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:lbo_glossaire/Configuration/TsConfig/Page/linkvalidator.tsconfig">');
}
