<?php
namespace CODEMASCHINE\CmLosungen\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

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

/**
 *
 *
 * @package cm_losungen
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LosungController extends \TYPO3\CmAjax\Controller\ApplicationController {

	/**
	 * losungRepository
	 *
	 * @var \CODEMASCHINE\CmLosungen\Domain\Repository\LosungRepository
	 * @inject
	 */
	protected $losungRepository;
	
	protected function initializeAction() {
	  if ($this->settings['format'] == 'json') {
	    $this->defaultViewObjectName = \TYPO3\CMS\Extbase\Mvc\View\JsonView::class;
	  }
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$losungs = $this->losungRepository->findAll();
		$this->view->assign('losungs', $losungs);
	}

	/**
	 * action show
	 *
	 * @param \CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung
	 * @return void
	 */
	public function showAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
		$this->view->assign('losung', $losung);
	}

	/**
	 * action tageslosung
	 *
	 * @param string $datum
	 * @return void
	 */
	public function tageslosungAction($datum = NULL) {
	  //$logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Log\LogManager::class)->getLogger(__CLASS__);
	  //$logger->info('datum: '.$datum);
	  if ($datum && preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$datum)) {
	    $losungen = $this->losungRepository->findByDatum(date_create($datum)->getTimestamp());
	  }
	  else
	    $losungen = $this->losungRepository->findByDatum(strtotime("today"));
	  
    if ($this->settings['format'] == 'json') {
      $this->view->setVariablesToRender(['losung']);
    }
	  
	  $this->view->assign('wochenversanzeigen', $this->settings['wochenversanzeigen']);
	  $this->view->assign('lehrtextanzeigen', $this->settings['lehrtextanzeigen']);
	  
		$this->view->assign('losung', count($losungen) ? $losungen[0] : NULL);
	}

	/**
	 * action new
	 *
	 * @param \CODEMASCHINE\CmLosungen\Domain\Model\Losung $newLosung
	 * @ignorevalidation $newLosung
	 * @return void
	 */
	public function newAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $newLosung = NULL) {
		$this->view->assign('newLosung', $newLosung);
	}

	/**
	 * action create
	 *
	 * @param \CODEMASCHINE\CmLosungen\Domain\Model\Losung $newLosung
	 * @return void
	 */
	public function createAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $newLosung) {
		$this->losungRepository->add($newLosung);
		$this->addFlashMessage('Neue Losung angelegt.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung
	 * @return void
	 */
	public function editAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
	  $this->view->assign('losung', $losung);
	  
	  if ($this->isAjax())
	    $this->view->render('ajaxEdit');
	    
	}

	/**
	 * action update
	 *
	 * @param \CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung
	 * @return void
	 */
	public function updateAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
		$this->losungRepository->update($losung);
		if ($this->isAjax()) {
		  $this->view->assign('losung', $losung);
		  $this->view->render('ajaxShow');
		}
		else {
  		$this->addFlashMessage('Losung bearbeitet.');
  		$this->redirect('list');
		}
	}

	/**
	 * action delete
	 *
	 * @param \CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung
	 * @return void
	 */
	public function deleteAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
		$this->losungRepository->remove($losung);
		$this->addFlashMessage('Losung gelöscht.');
		$this->redirect('list');
	}

}
?>
