<?php
if (!defined('TYPO3')) {
    die('Access denied.');
}

// TsConfig pour page de stockage
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'Libeo.lbo_glossaire',
    'Configuration/TsConfig/Page/storage.tsconfig',
    'Libeo : page de stockage - glossaire'
);
