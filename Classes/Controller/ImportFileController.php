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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use \DateTime;
use CODEMASCHINE\CmLosungen\Domain\Model\Losung;
use TYPO3\CMS\Core\Utility\File\BasicFileUtility;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use CODEMASCHINE\CmLosungen\Domain\Repository\LosungRepository;

/**
 *
 *
 * @package cm_losungen
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ImportFileController extends ActionController {

  public function __construct(
    private readonly LosungRepository $losungRepository
  ) {}

  /**
   * action new
   *
   */
  public function newAction() {
    $importFile = new \CODEMASCHINE\CmLosungen\Domain\Model\ImportFile();
    $this->moduleTemplate->assign('importFile', $importFile);

    return $this->moduleTemplate->renderResponse();
  }

  /**
   * action create
   *
   * @return void
   */
  public function createAction() {
    $filename = $this->saveFile();
    $xml = simplexml_load_file($filename);

    $existingLosungen = $this->losungRepository->findAll();
    $existingLosungenHash = array();

    foreach ($existingLosungen as $l) {
      $existingLosungenHash[(string) $l->getDatum()->getTimestamp()] = $l;
    }

    foreach ($xml->Losungen as $l) {

      $datum = new Datetime($l->Datum);
      if (isset($existingLosungenHash[$datum->getTimestamp()]))
        $losung = $existingLosungenHash[$datum->getTimestamp()];
      else {
        $losung = new Losung();
        $losung->setDatum($datum);
      }
      $losung->setWtag(strval($l->Wtag));  // this is still an object and must be cast to string, otherwise an empty value is saved to database!!!
      $losung->setSonntag(strval($l->Sonntag));  // --> same as above!!
      $losung->setLosungstext(str_replace('/', '', $l->Losungstext));
      $losung->setLosungsvers(strval($l->Losungsvers));  // --> same as above!!

      $losung->setLehrtext(str_replace('/', '', $l->Lehrtext));
      $losung->setLehrvers(strval($l->Lehrtextvers));  // --> same as above!!

      if ($losung->getUid())
        $this->losungRepository->update($losung);
      else
        $this->losungRepository->add($losung);
    }



    $this->addFlashMessage('XML-Losungen importiert.');
    return $this->redirect('list', 'Losung');
  }


  /**
   * Helper for upload functions
   *
   */
  protected function saveFile() {
    if (is_array($_FILES)) {
      foreach ($_FILES as $formName => $file) {
        if ($file['name']['src']) {
          $basicFileFunctions = new BasicFileUtility();

          if (!file_exists(GeneralUtility::getFileAbsFileName('uploads/tx_cmlosungen')))
            mkdir(GeneralUtility::getFileAbsFileName('uploads/tx_cmlosungen'));

          $fileName = $basicFileFunctions->getUniqueName(
            $file['name']['src'],
            GeneralUtility::getFileAbsFileName('uploads/tx_cmlosungen/')
          );

          GeneralUtility::upload_copy_move(
            $file['tmp_name']['src'],
            $fileName
          );

          return $fileName;
        }
      }
    }
  }
}
