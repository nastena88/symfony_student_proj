<?php

namespace Tests\AppBundle\Libs;
use AppBundle\Libs\Student;

class StudentTest extends \PHPUnit_Framework_TestCase {
	public function testShow() {
		$stud = new Student();
		$assign = $stud->show('stud 1');
		$check = "stud 1, Student name is tested!";
		$this->assertEquals($check, $assign);
	}
}