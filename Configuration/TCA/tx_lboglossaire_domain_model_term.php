<?php
$ll = 'LLL:EXT:lbo_glossaire/Resources/Private/Language/locallang_db.xlf';

return array(
    'ctrl' => array(
        'title' => $ll . ':tx_lboglossaire_domain_model_term',
        'label' => 'term',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'versioningWS' => true,
        'default_sortby' => 'term',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'term,description,',
        'iconfile' => 'EXT:lbo_glossaire/Resources/Public/Icons/tx_lboglossaire_domain_model_term.gif'
    ),
    'interface' => array(
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, term, description',
    ),
    'types' => array(
        '1' => array(
            'showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, --palette--;;1, hide_in_glossary_page,'
                . 'term, description,'
                . '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, starttime, endtime'
        ),
    ),
    'palettes' => array(
        '1' => array('showitem' => ''),
    ),
    'columns' => array(
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_lboglossaire_domain_model_term',
                'foreign_table_where' => 'AND tx_lboglossaire_domain_model_term.pid=###CURRENT_PID### AND tx_lboglossaire_domain_model_term.sys_language_uid IN (-1,0)',
                'fieldWizard' => [
                    'selectIcons' => [
                        'disabled' => true,
                    ],
                ],
                'default' => 0,
            ]
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],
        'l10n_diffsource' => array(
            'config' => array(
                'type' => 'passthrough',
            ),
        ),

        'hidden' => array(
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => array(
                'type' => 'check',
            ),
        ),
        'starttime' => array(
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => array(
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
                'behaviour' => array(
                    'allowLanguageSynchronization' => true
                )
            ),
        ),
        'endtime' => array(
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => array(
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => array(
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ),
                'behaviour' => array(
                    'allowLanguageSynchronization' => true
                )
            ),
        ),

        'term' => array(
            'label' => $ll . ':tx_lboglossaire_domain_model_term.term',
            'config' => array(
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ),
        ),
        'description' => array(
            'label' => $ll . ':tx_lboglossaire_domain_model_term.description',
            'config' => array(
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'enableRichtext' => 1,
                'richtextConfiguration' => 'default',
                'softref' => 'typolink_tag,images,email[subst],url',
                'wizards' => array(
                    'RTE' => array(
                        'icon' => 'actions-wizard-rte',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'module' => array(
                            'name' => 'wizard_rich_text_editor',
                            'urlParameters' => array(
                                'mode' => 'wizard',
                                'act' => 'wizard_rte.php'
                            )
                        ),
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script'
                    )
                ),
            ),
        ),
        'hide_in_glossary_page' => array(
            'label' => $ll . ':tx_lboglossaire_domain_model_term.hide_in_glossary_page',
            'config' => array(
                'type' => 'check',
            ),
        ),

    ),
);
