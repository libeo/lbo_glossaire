<?php

use Libeo\LboGlossaire\Controller\GlossaryController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}

// Plugin de liste du glossaire
ExtensionUtility::configurePlugin(
    'LboGlossaire',
    'Glossary',
    array(
        GlossaryController::class => 'list'
    ),
    // non-cacheable actions
    array(
        GlossaryController::class => 'list'
    ),
    ExtensionUtility::PLUGIN_TYPE_PLUGIN
);
