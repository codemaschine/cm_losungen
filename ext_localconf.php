<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'CODEMASCHINE.' . $_EXTKEY,
	'Losung',
	array(
		'Losung' => 'tageslosung, list, show',
		'ImportFile' => '',
		
	),
	// non-cacheable actions
	array(
		'Losung' => 'tageslosung',
		'ImportFile' => '',
		
	)
);

?>