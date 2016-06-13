<?php
require_once(dirname(__FILE__) . '/../vendor/autoload.php');

class SimpleTestCase extends TestCase {

	function testSimpleScenario(){
		$this->assertTrue(true);

	}

}
