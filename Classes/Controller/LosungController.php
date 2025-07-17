<?php

namespace CODEMASCHINE\CmLosungen\Controller;


/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Jannes Dinse <jdinse@codemaschine.de>, CODE MASCHINE GbR
 *  Sebastian Tobies <stobies@codemaschine.de>, CODE MASCHINE GbR
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Pagination\ArrayPaginator;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3Fluid\Fluid\View\ViewInterface;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use CODEMASCHINE\CmLosungen\Domain\Repository\LosungRepository;

/**
 *
 *
 * @package cm_losungen
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LosungController extends ActionController {

  /**
   * The current view, as resolved by resolveView()
   *
   * @var ViewInterface|JsonView
   */
  protected $view;

  public function __construct(
    private readonly LosungRepository $losungRepository
  ) {}

  protected function initializeAction() {
    parent::initializeAction();
    if (!empty($this->settings['format']) && $this->settings['format'] == 'json') {
      $this->defaultViewObjectName = \TYPO3\CMS\Extbase\Mvc\View\JsonView::class;
    }
  }

  /**
   * action list
   *
   */
  public function listAction(int $currentPage = 1) {
    $losungs = $this->losungRepository->findAll();
    $arrayPaginator = new ArrayPaginator($losungs->toArray(), $currentPage, 50);
    $paging = new SimplePagination($arrayPaginator);
    $this->moduleTemplate->assignMultiple([
      'losungs' => $losungs,
      'paginator' => $arrayPaginator,
      'paging' => $paging,
      'pages' => range(1, $paging->getLastPageNumber()),
    ]);

    return $this->moduleTemplate->renderResponse();
  }

  /**
   * action show
   *
   */
  public function showAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
    $this->moduleTemplate->assign('losung', $losung);

    return $this->moduleTemplate->renderResponse();
  }

  /**
   * action tageslosung
   *
   */
  public function tageslosungAction(?string $datum = null) {
    if ($datum && preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $datum)) {
      $losungen = $this->losungRepository->findByDatum(date_create($datum)->getTimestamp());
    } else
      $losungen = $this->losungRepository->findByDatum(strtotime("today"));

    $response = $this->responseFactory->createResponse();

    if (!empty($this->settings['format']) && $this->settings['format'] == 'json') {
      $this->view->setVariablesToRender(['losung']);
      $response = $response->withHeader('Content-Type', 'application/json; charset=utf-8');
    } else {
      $response = $response->withHeader('Content-Type', 'text/html; charset=utf-8');
    }

    $this->view->assign('wochenversanzeigen', $this->settings['wochenversanzeigen'] ?? null);
    $this->view->assign('lehrtextanzeigen', $this->settings['lehrtextanzeigen'] ?? null);

    $this->view->assign('losung', count($losungen) ? $losungen[0] : NULL);

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    return $response->withBody($this->streamFactory->createStream($this->view->render()));
  }

  /**
   * action new
   *
   */
  public function newAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung = null) {
    $this->moduleTemplate->assign('losung', $losung);

    return $this->moduleTemplate->renderResponse();
  }

  /**
   * action create
   *
   */
  public function createAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
    $this->losungRepository->add($losung);
    $this->addFlashMessage('Neue Losung angelegt.');
    return $this->redirect('list');
  }

  /**
   * action edit
   *
   */
  public function editAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
    $this->moduleTemplate->assign('losung', $losung);

    return $this->moduleTemplate->renderResponse();
  }

  /**
   * action update
   *
   */
  public function updateAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
    $this->losungRepository->update($losung);
    $this->addFlashMessage('Losung bearbeitet.');
    return $this->redirect('list');
  }

  /**
   * action delete
   *
   */
  public function deleteAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
    $this->losungRepository->remove($losung);
    $this->addFlashMessage('Losung gelöscht.');
    return $this->redirect('list');
  }
}
