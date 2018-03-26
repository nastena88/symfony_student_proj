<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
	* @ORM\Entity
	* @ORM\Table(name = "students")
*/

class Student {
	/**
		* @ORM\Column(type="integer")
		* @ORM\Id
		* @ORM\GeneratedValue(strategy = "AUTO")
	*/
	private $id;

	/**
		* @ORM\Column(type = "string", length = 50)
	*/
	private $name;

	/**
		* @ORM\Column(type="text")
	*/
	private $address;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Student
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}
