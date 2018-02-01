<?php

namespace App\Controllers;
use \Core\View;



class Home extends \Core\Controller
{
	public function indexAction()
	{
		view::renderTemplate('index.html');
	
	}
	protected function before()
	{
		// echo "(before)";

	}

	protected function after()
	{
		// echo "(after)";
	}

	public function clickmeAction()
	{
		view::renderTemplate('afterclick.html');
	}
}