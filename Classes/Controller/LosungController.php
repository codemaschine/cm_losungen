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

/**
 *
 *
 * @package cm_losungen
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class LosungController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * losungRepository
	 *
	 * @var \CODEMASCHINE\CmLosungen\Domain\Repository\LosungRepository
	 * @inject
	 */
	protected $losungRepository;

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
	  //\t3lib_div::devLog("Losung für timestamp ".mktime(0,0,0), 'jdtest');
	  if ($datum && preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/',$datum))
	    $losungen = $this->losungRepository->findByDatum(DateTime($datum)->getTimestamp());
	  else
	    $losungen = $this->losungRepository->findByDatum(mktime(0,0,0));
	  
	  
	  //\t3lib_div::devLog("Losung".$losung->getLosungsvers(), 'jdtest');
	  
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
	}

	/**
	 * action update
	 *
	 * @param \CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung
	 * @return void
	 */
	public function updateAction(\CODEMASCHINE\CmLosungen\Domain\Model\Losung $losung) {
		$this->losungRepository->update($losung);
		$this->addFlashMessage('Losung bearbeitet.');
		$this->redirect('list');
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
