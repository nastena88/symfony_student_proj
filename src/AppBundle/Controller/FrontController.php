<?php
namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FrontController {
	public function __construct() {
		$request = Request::createFromGlobals();
		$path = $request->getPathInfo();

		if(in_array($path, array('','/'))) {
			$response = new Response('Student home page.');
		} elseif ('/about' == $path) {
			$response = new Response('Student details page');
		} else {
			$response = new Response ('Page not found', Response::HTTP_NOTFOUND);
		}
		$response->send();
	}
}
