<?php

namespace AppBundle\Entity;

class StudentForm {
	private $studentName;
	private $studentId;
	public $password;
	private $address;
	public $joined;
	public $gender;
	private $email;
	private $marks;
	public $sports;

	public function getStudentName() {
		$this->studentName;
	}

	public function setStudentName($studentName) {
		$this->studentName = $studentName;
	}
	public function getStudentId() { 
		return $this->studentId; 
	}  
	public function setStudentId($studentid) { 
		$this->studentid = $studentid; 
	}
	public function getAddress() { 
		return $this->address; 
	}  
	public function setAddress($address) { 
		$this->address = $address; 
	}  
	public function getEmail() { 
		return $this->email; 
	}  
	public function setEmail($email) { 
		$this->email = $email; 
	}  
	public function getMarks() { 
		return $this->marks; 
	}  
	public function setMarks($marks) { 
		$this->marks = $marks; 
	}
}