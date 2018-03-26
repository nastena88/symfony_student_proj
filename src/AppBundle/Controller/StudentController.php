<?php
namespace AppBundle\Controller;  

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route; 
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;  
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

use AppBundle\Entity\Student;
use AppBundle\Entity\StudentForm;
use AppBundle\Form\FormValidationType;
use AppBundle\Entity\FormValidation;

use Symfony\Component\Form\Extension\Core\Type\TextType; 
use Symfony\Component\Form\Extension\Core\Type\DateType; 
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Component\Form\Extension\Core\Type\ChoiceType; 
use Symfony\Component\Form\Extension\Core\Type\PasswordType; 
use Symfony\Component\Form\Extension\Core\Type\RangeType; 
use Symfony\Component\Form\Extension\Core\Type\EmailType; 
use Symfony\Component\Form\Extension\Core\Type\CheckboxType; 
use Symfony\Component\Form\Extension\Core\Type\ButtonType; 
use Symfony\Component\Form\Extension\Core\Type\TextareaType; 
use Symfony\Component\Form\Extension\Core\Type\PercentType; 
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


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

	/**
		* @Route("/student/new")
	*/
	public function newAction(Request $request) {
		$stud = new StudentForm();
		$form = $this->createFormBuilder($stud)
			->add('studentName', TextType::class)
			->add('studentId', TextType::class)
			->add('password', RepeatedType::class, array(
				'type' => PasswordType::class,
				'invalid_message' => 'The password fields must match',
				'options' => array('attr' => array('class'=>'password-field')),
				'required' => true,
				'first_options' => array('label' => 'Password'),
				'second_options' => array('label' => 'Re-enter'),
			))
			->add('address', TextareaType::class)
			->add('joined', DateType::class, array(
				'widget' => 'choice',
			))

			->add('gender', ChoiceType::class, array(
				'choices' => array(
					'Male' => true,
					'Female' => false
				),
			))

			->add('email', EmailType::class)
			->add('marks', PercentType::class)
			->add('sports', CheckboxType::class, array(
				'label' => 'Are you interested in sports?',
				'required' => false,
			))

			->add('save', SubmitType::class, array('label' => 'Submit'))
			->getForm();

			return $this->render('student/new.html.twig', array('form' => $form->createView()));
	}

	/**
		* @Route("/student/validate")
	*/
	public function validateAction(Request $request) {
		$validate = new FormValidation();
		$form = $this->createFormBuilder($validate)
		->add('name', TextType::class)
		->add('id', TextType::class)
		->add('age', TextType::class)
		->add('address', TextType::class)
		->add('email', TextType::class)
		->add('save', SubmitType::class, array('label'=> 'Submit'))
		->getForm();

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$validate = $form->getData();
			return new Response('Form is validated');
		}
		return $this->render('student/validate.html.twig', array(
			'form' => $form->createView(),
		));
	}

}