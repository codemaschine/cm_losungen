<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'cm_losungen',
	'Losung',
	'Losung'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'cm_losungen',
		'web',	 // Make module a submodule of 'tools'
		'losungmanager',	// Submodule key
		'',						// Position
		array(
			\CODEMASCHINE\CmLosungen\Controller\LosungController::class => 'list, show, new, create, edit, update, delete',
			\CODEMASCHINE\CmLosungen\Controller\ImportFileController::class => 'new, create',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:cm_losungen/ext_icon.gif',
			'labels' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_losungmanager.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('cm_losungen', 'Configuration/TypoScript', 'Losungen');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cmlosungen_domain_model_losung', 'EXT:cm_losungen/Resources/Private/Language/locallang_csh_tx_cmlosungen_domain_model_losung.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cmlosungen_domain_model_losung');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_cmlosungen_domain_model_importfile', 'EXT:cm_losungen/Resources/Private/Language/locallang_csh_tx_cmlosungen_domain_model_importfile.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_cmlosungen_domain_model_importfile');



//include_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('cm_losungen').'Configuration/FlexForms/class.tx_losungen_flexhelpers.php');

$extensionName = TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase('cm_losungen');
#
#$pluginSignature = strtolower($extensionName) . '_cartyshoppingcart';
#
#$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
#$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
#\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:cm_losungen/Configuration/FlexForms/plugin_options.xml');


// Options for Carty Product Widget
$pluginSignature = strtolower($extensionName) . '_losung';

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:cm_losungen/Configuration/FlexForms/tageslosung_plugin.xml');






?>