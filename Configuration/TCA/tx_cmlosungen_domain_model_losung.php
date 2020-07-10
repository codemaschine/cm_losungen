<?php
return array(
        'ctrl' => array(
            'title'	=> 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung',
            'label' => 'datum',
            'tstamp' => 'tstamp',
            'crdate' => 'crdate',
            'cruser_id' => 'cruser_id',
            'dividers2tabs' => TRUE,
            'sortby' => 'sorting',
            'versioningWS' => 2,
            'versioning_followPages' => TRUE,
            'origUid' => 't3_origuid',
            'languageField' => 'sys_language_uid',
            'transOrigPointerField' => 'l10n_parent',
            'transOrigDiffSourceField' => 'l10n_diffsource',
            'delete' => 'deleted',
            'enablecolumns' => array(
                'disabled' => 'hidden',
                'starttime' => 'starttime',
                'endtime' => 'endtime',
            ),
            'searchFields' => 'datum,wtag,sonntag,losungstext,losungsvers,lehrtext,lehrvers,',
            'iconfile' => 'EXT:cm_losungen/Resources/Public/Icons/tx_cmlosungen_domain_model_losung.gif'
        ),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, datum, wtag, sonntag, losungstext, losungsvers, lehrtext, lehrvers',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, datum, wtag, sonntag, losungstext, losungsvers, lehrtext, lehrvers,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_cmlosungen_domain_model_losung',
				'foreign_table_where' => 'AND tx_cmlosungen_domain_model_losung.pid=###CURRENT_PID### AND tx_cmlosungen_domain_model_losung.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				
			),
		),
		'datum' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.datum',
			'config' => array(
				'type' => 'input',
				'size' => 7,
				'eval' => 'date,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'wtag' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.wtag',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'sonntag' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.sonntag',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'losungstext' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.losungstext',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required'
			),
		),
		'losungsvers' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.losungsvers',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'lehrtext' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.lehrtext',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'lehrvers' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.lehrvers',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	    'btv_text' => array(
	        'exclude' => 0,
	        'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.btv_text',
	        'config' => array(
	            'type' => 'text',
	            'cols' => 40,
	            'rows' => 15,
	            'eval' => 'trim'
	        ),
	    ),
	    'btv_vers' => array(
	        'exclude' => 0,
	        'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.btv_vers',
	        'config' => array(
	            'type' => 'input',
	            'size' => 30,
	            'eval' => 'trim'
	        ),
	    ),
	    'btv_translation' => array(
	        'exclude' => 0,
	        'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.btv_translation',
	        'config' => array(
	            'type' => 'input',
	            'size' => 30,
	            'eval' => 'trim'
	        ),
	    ),
	    'oeab_text' => array(
	        'exclude' => 0,
	        'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.oeab_text',
	        'config' => array(
	            'type' => 'text',
	            'cols' => 40,
	            'rows' => 15,
	            'eval' => 'trim'
	        ),
	    ),
	    'oeab_vers' => array(
	        'exclude' => 0,
	        'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.oeab_vers',
	        'config' => array(
	            'type' => 'input',
	            'size' => 30,
	            'eval' => 'trim'
	        ),
	    ),
	    'oeab_translation' => array(
	        'exclude' => 0,
	        'label' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_db.xlf:tx_cmlosungen_domain_model_losung.oeab_translation',
	        'config' => array(
	            'type' => 'input',
	            'size' => 30,
	            'eval' => 'trim'
	        ),
	    ),
	),
);

?>