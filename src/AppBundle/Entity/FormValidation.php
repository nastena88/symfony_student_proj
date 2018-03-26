<?php
namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class FormValidation {
	/**
		* @Assert\NotBlank()
	*/
	protected $name;

	/**
		* @Assert\NotBlank()
	*/
	protected $id;
	protected $age;

	/**
		* @Assert\NotBlank()
	*/
	protected $address;
	public $password;

	/**
		* @Assert\Email(
			* message = "The email '{{ value }}' is not a valid email",
			* checkMX = true
		* )
	*/
	protected $email;

	public function getName() { 
		return $this->name; 
	}  
	public function setName($name) { 
		$this->name = $name; 
	}  
	public function getId() { 
		return $this->id; 
	} 
	public function setId($id) { 
		$this->id = $id; 
	}  
	public function getAge() { 
		return $this->age; 
	}  
	public function setAge($age) { 
		$this->age = $age;
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
}