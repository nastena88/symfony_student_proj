<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
        * @Route("/{_locale}/translation/sample", name="translation_sample")
    */
    public function translationSample() {
        $translated = $this->get('translator')->trans('I love Symfony');
        return new Response($translated);
    }

    /**
        * @Route("/{_locale}/translation/twigsample", name="translation_twig_sample")
    */
    public function translationTwigSample() {
        return $this->render('translate/index.html.twig');
    }

    /**
        * @Route("/mailsample/send", name="mail_sample_send")
    */
    public function MailerSample() {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('someone@gmail.com')
            ->setTo('a.klyuk@demis.ru')
            ->setBody(
                $this->renderView('Emails/sample.html.twig'), 'text/html'
            );
        $this->get('mailer')->send($message);
        return new Response("Mail send");
    }
    /** 
       * @Route("/admin") 
    */ 
    public function adminLandingAction() { 
       return new Response('<html><body>This is admin section.</body></html>'); 
    } 
}
