<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'cm_losungen',
	'Losung',
	array(
		\CODEMASCHINE\CmLosungen\Controller\LosungController::class => 'tageslosung, list, show',
		\CODEMASCHINE\CmLosungen\Controller\ImportFileController::class => '',
		
	),
	// non-cacheable actions
	array(
		\CODEMASCHINE\CmLosungen\Controller\LosungController::class => '',  // JB: activated Caching for Varnish Cache.
		\CODEMASCHINE\CmLosungen\Controller\ImportFileController::class => '',
		
	)
);

?>