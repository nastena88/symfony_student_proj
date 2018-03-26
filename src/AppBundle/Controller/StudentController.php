<?php
namespace AppBundle\Controller;  
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;  
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Student;

class StudentController extends Controller{ 
	/** 
	   * @Route("/student/home") 
	*/ 
	public function homeAction() {
		return $this->render('student/home.html.twig');
	} 
	/**
		* @Route("/student/{page}", name = "student_about", requirements = {"page": "\d+"})
	*/
	public function aboutAction($page=1) {
		return new Response($page);
	}

	/**
		* @Route("/student/add")
	*/

	public function addAction() {
		$stud = new Student();
		$stud->setName('Adam');
		$stud->setAddress('12 north street');
		$doct = $this->getDoctrine()->getManager();

		//tells Doctrine you want to save the Product
		$doct->persist($stud);

		//executes the queries (i.e. the INSERT query)
		$doct->flush();

		return new Response('Saved new student with id '.$stud->getId());
	}

	/**
		* @Route("/student/display")
	*/

	public function displayAction() {
		$stud = $this->getDoctrine()
		->getRepository('AppBundle:Student')
		->findAll();
		return $this->render('student/display.html.twig', array('data' => $stud));
	}

	/**
		* @Route("/student/update/{id}")
	*/

	public function updateAction($id){
		$doct = $this->getDoctrine()->getManager();
		$stud = $doct->getRepository('AppBundle:Student')->find($id);

		if(!$stud) {
			throw $this->createNotFoundException(
				'No student found for id '.$id
			);
		}
		$stud->setAddress('7 south street');
		$doct->flush();
		return new Response('Changes updated');
	}

	/**
		* @Route("/student/delete/{id}")
	*/

	public function deleteAction($id) {
		$doct = $this->getDoctrine()->getManager();
		$stud = $doct->getRepository('AppBundle:Student')->find($id);

		if (!$stud) {
			throw $this->createNotFoundException('No student found for id '.$id);
		}

		$doct->remove($stud);
		$doct->flush();

		return new Response('Record deleted!');
	}

}