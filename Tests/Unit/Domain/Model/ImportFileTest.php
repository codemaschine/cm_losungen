<?php

namespace CODEMASCHINE\CmLosungen\Tests;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Jannes Dinse <jdinse@codemaschine.de>, CODE MASCHINE GbR
 *  			Sebastian Tobies <stobies@codemaschine.de>, CODE MASCHINE GbR
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \CODEMASCHINE\CmLosungen\Domain\Model\ImportFile.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Losungen
 *
 * @author Jannes Dinse <jdinse@codemaschine.de>
 * @author Sebastian Tobies <stobies@codemaschine.de>
 */
class ImportFileTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \CODEMASCHINE\CmLosungen\Domain\Model\ImportFile
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \CODEMASCHINE\CmLosungen\Domain\Model\ImportFile();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getSrcReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setSrcForStringSetsSrc() { 
		$this->fixture->setSrc('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getSrc()
		);
	}
	
}
?>