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
	 * @validate NotEmpty
	 */
	protected $datum;

	/**
	 * wtag
	 *
	 * @var \string
	 */
	protected $wtag;

	/**
	 * sonntag
	 *
	 * @var \string
	 */
	protected $sonntag;

	/**
	 * losungstext
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $losungstext;

	/**
	 * losungsvers
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $losungsvers;

	/**
	 * lehrtext
	 *
	 * @var \string
	 */
	protected $lehrtext;

	/**
	 * lehrvers
	 *
	 * @var \string
	 */
	protected $lehrvers;

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
	 * @return \string $wtag
	 */
	public function getWtag() {
		return $this->wtag;
	}

	/**
	 * Sets the wtag
	 *
	 * @param \string $wtag
	 * @return void
	 */
	public function setWtag($wtag) {
		$this->wtag = $wtag;
	}

	/**
	 * Returns the sonntag
	 *
	 * @return \string $sonntag
	 */
	public function getSonntag() {
		return $this->sonntag;
	}

	/**
	 * Sets the sonntag
	 *
	 * @param \string $sonntag
	 * @return void
	 */
	public function setSonntag($sonntag) {
		$this->sonntag = $sonntag;
	}

	/**
	 * Returns the losungstext
	 *
	 * @return \string $losungstext
	 */
	public function getLosungstext() {
		return $this->losungstext;
	}

	/**
	 * Sets the losungstext
	 *
	 * @param \string $losungstext
	 * @return void
	 */
	public function setLosungstext($losungstext) {
		$this->losungstext = $losungstext;
	}

	/**
	 * Returns the losungsvers
	 *
	 * @return \string $losungsvers
	 */
	public function getLosungsvers() {
		return $this->losungsvers;
	}

	/**
	 * Sets the losungsvers
	 *
	 * @param \string $losungsvers
	 * @return void
	 */
	public function setLosungsvers($losungsvers) {
		$this->losungsvers = $losungsvers;
	}

	/**
	 * Returns the lehrtext
	 *
	 * @return \string $lehrtext
	 */
	public function getLehrtext() {
		return $this->lehrtext;
	}

	/**
	 * Sets the lehrtext
	 *
	 * @param \string $lehrtext
	 * @return void
	 */
	public function setLehrtext($lehrtext) {
		$this->lehrtext = $lehrtext;
	}

	/**
	 * Returns the lehrvers
	 *
	 * @return \string $lehrvers
	 */
	public function getLehrvers() {
		return $this->lehrvers;
	}

	/**
	 * Sets the lehrvers
	 *
	 * @param \string $lehrvers
	 * @return void
	 */
	public function setLehrvers($lehrvers) {
		$this->lehrvers = $lehrvers;
	}

}
?>