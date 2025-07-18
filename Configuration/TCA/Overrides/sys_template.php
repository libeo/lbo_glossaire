<?php
if (!defined('TYPO3')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('lbo_glossaire', 'Configuration/TypoScript', 'Glossaire');
