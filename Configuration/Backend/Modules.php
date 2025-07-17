<?php

return [
  'web_cm_losungenLosungmanager' => [
    'parent' => 'web',
    'position' => ['before' => '*'],
    'access' => 'user,group',
    'path' => '/module/web/cm_losungen',
    'icon' => 'EXT:cm_losungen/ext_icon.gif',
    'navigationComponent' => '',
    'inheritNavigationComponentFromMainModule' => false,
    'labels' => 'LLL:EXT:cm_losungen/Resources/Private/Language/locallang_losungmanager.xlf',
    'extensionName' => 'Losungmanager',
    'controllerActions' => [
      \CODEMASCHINE\CmLosungen\Controller\LosungController::class => [
        'list', 'show', 'new', 'create', 'edit', 'update', 'delete'
      ],
      \CODEMASCHINE\CmLosungen\Controller\ImportFileController::class => [
        'new', 'create'
      ]
    ],
  ],
];
