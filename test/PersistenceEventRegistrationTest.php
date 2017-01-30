<?php

require_once __DIR__.'\..\persistence\PersistenceEventRegistration.php';
require_once __DIR__.'\..\model\RegistrationManager.php';
require_once __DIR__.'\..\model\Participant.php';

class PersistenceEventRegistrationTest extends PHPUnit_Framework_TestCase {
	protected $pm;
		
	protected function setUp() {
		$this->pm = new PersistenceEventRegistration();
	}
		
	protected function tearDown() {
	}
	
	public function testPersistence() {
		//1. Create test data
		$rm = new RegistrationManager();//::getInstance();
		$participant = new Participant("Frank");
		$rm->addParticipant($participant);
		
		//2. Write all of the data
		$this->pm->writeDataToStore($rm);
		
		//3. Clear the data from memory
		$rm->delete();
		
		$this->assertEquals(0, count($rm->getParticipants()));
		
		// 4. Load it back in
		$rm = $this->pm->loadDataFromStore();
		
		//5. Check that we got it back
		$this->assertEquals(1, count($rm->getParticipants()));
		$myParticipant = $rm->getParticipant_index(0);
		$this->assertEquals("Frank", $myParticipant->getName());
	}
}
?>