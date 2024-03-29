<?php
namespace CODEMASCHINE\CmLosungen\Domain\Model;

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

use TYPO3\CMS\Extbase\Annotation\Validate;

/**
 *
 *
 * @package cm_losungen
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Losung extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * datum
	 *
	 * @var \DateTime
	 * @Validate("NotEmpty")
	 */
	protected $datum;

	/**
	 * wtag
	 *
	 * @var string
	 */
	protected $wtag;

	/**
	 * sonntag
	 *
	 * @var string
	 */
	protected $sonntag;

	/**
	 * losungstext
	 *
	 * @var string
	 * @Validate("NotEmpty")
	 */
	protected $losungstext;

	/**
	 * losungsvers
	 *
	 * @var string
	 * @Validate("NotEmpty")
	 */
	protected $losungsvers;

	/**
	 * lehrtext
	 *
	 * @var string
	 */
	protected $lehrtext;

	/**
	 * lehrvers
	 *
	 * @var string
	 */
	protected $lehrvers;

	/**
	 * btv Vers-Text
	 *
	 * @var string
	 */
	protected $btvText;

	/**
	 * Btv Versangabe
	 *
	 * @var string
	 */
	protected $btvVers;

	/**
	 * Btv Bibelübersetzung zum Text
	 *
	 * @var string
	 */
	protected $btvTranslation;

	/**
	 * ÖAB Vers-Text
	 *
	 * @var string
	 */
	protected $oeabText;

	/**
	 * ÖAB Versangabe
	 *
	 * @var string
	 */
	protected $oeabVers;

	/**
	 * ÖAB Bibelübersetzung zum Text
	 *
	 * @var string
	 */
	protected $oeabTranslation;

	/**
	 * Returns the datum
	 *
	 * @return \DateTime $datum
	 */
	public function getDatum() {
		return $this->datum;
	}

	/**
	 * Sets the datum
	 *
	 * @param \DateTime $datum
	 * @return void
	 */
	public function setDatum($datum) {
		if (is_object($datum))
			$datum->setTime(0,0,0);
		$this->datum = $datum;
	}

	/**
	 * Returns the wtag
	 *
	 * @return string $wtag
	 */
	public function getWtag() {
		return $this->wtag;
	}

	/**
	 * Sets the wtag
	 *
	 * @param string $wtag
	 * @return void
	 */
	public function setWtag($wtag) {
		$this->wtag = $wtag;
	}

	/**
	 * Returns the sonntag
	 *
	 * @return string $sonntag
	 */
	public function getSonntag() {
		return $this->sonntag;
	}

	/**
	 * Sets the sonntag
	 *
	 * @param string $sonntag
	 * @return void
	 */
	public function setSonntag($sonntag) {
		$this->sonntag = $sonntag;
	}

	/**
	 * Returns the losungstext
	 *
	 * @return string $losungstext
	 */
	public function getLosungstext() {
		return $this->losungstext;
	}

	/**
	 * Sets the losungstext
	 *
	 * @param string $losungstext
	 * @return void
	 */
	public function setLosungstext($losungstext) {
		$this->losungstext = $losungstext;
	}

	/**
	 * Returns the losungsvers
	 *
	 * @return string $losungsvers
	 */
	public function getLosungsvers() {
		return $this->losungsvers;
	}

	/**
	 * Sets the losungsvers
	 *
	 * @param string $losungsvers
	 * @return void
	 */
	public function setLosungsvers($losungsvers) {
		$this->losungsvers = $losungsvers;
	}

	/**
	 * Returns the lehrtext
	 *
	 * @return string $lehrtext
	 */
	public function getLehrtext() {
		return $this->lehrtext;
	}

	/**
	 * Sets the lehrtext
	 *
	 * @param string $lehrtext
	 * @return void
	 */
	public function setLehrtext($lehrtext) {
		$this->lehrtext = $lehrtext;
	}

	/**
	 * Returns the lehrvers
	 *
	 * @return string $lehrvers
	 */
	public function getLehrvers() {
		return $this->lehrvers;
	}

	/**
	 * Sets the lehrvers
	 *
	 * @param string $lehrvers
	 * @return void
	 */
	public function setLehrvers($lehrvers) {
		$this->lehrvers = $lehrvers;
	}
	
  /**
   * @return string
   */
  public function getBtvText() {
      return $this->btvText;
  }

  /**
   * @return string
   */
  public function getBtvVers() {
      return $this->btvVers;
  }

  /**
   * @return string
   */
  public function getBtvTranslation() {
      return $this->btvTranslation;
  }
  
  /**
   * @return string
   */
  public function getOeabText() {
      return $this->oeabText;
  }
  
  /**
   * @return string
   */
  public function getOeabVers() {
      return $this->oeabVers;
  }
  
  /**
   * @param string $btvText
   */
  public function setBtvText($btvText) {
      $this->btvText = $btvText;
  }
  
  /**
   * @param string $btvVers
   */
  public function setBtvVers($btvVers) {
      $this->btvVers = $btvVers;
  }
  
  /**
   * @param string $btvTranslation
   */
  public function setBtvTranslation($btvTranslation) {
      $this->btvTranslation = $btvTranslation;
  }
  
  /**
   * @param string $oeabText
   */
  public function setOeabText($oeabText) {
      $this->oeabText = $oeabText;
  }
  
  /**
   * @param string $oeabVers
   */
  public function setOeabVers($oeabVers) {
      $this->oeabVers = $oeabVers;
  }
  
  /**
   * @return string
   */
  public function getOeabTranslation() {
      return $this->oeabTranslation;
  }
  
  /**
   * @param string $oeabTranslation
   */
  public function setOeabTranslation($oeabTranslation) {
      $this->oeabTranslation = $oeabTranslation;
  }

}
?>