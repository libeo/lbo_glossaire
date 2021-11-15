<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Libeo.lbo_glossaire',
    'Glossary',
    'LLL:EXT:lbo_glossaire/Resources/Private/Language/locallang_db.xlf:tx_lboglossaire_glossary_plugin'
);

$TCA['tt_content']['types']['list']['subtypes_addlist']['lboglossaire_glossary'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'lboglossaire_glossary',
    'FILE:EXT:lbo_glossaire/Configuration/FlexForms/glossary.xml'
);
