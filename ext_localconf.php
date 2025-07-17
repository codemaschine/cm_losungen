<?php
defined('TYPO3') or die();

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

// $GLOBALS['TYPO3_CONF_VARS']['BE']['stylesheets']['cm_losungen'] = 'EXT:cm_losungen/Resources/Public/Stylesheets/be_styles.css';
