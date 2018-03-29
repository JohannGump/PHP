<?php
/**
 * Created by PhpStorm.
 * User: Formation
 * Date: 19/03/2018
 * Time: 12:24
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AppController extends Controller
{

    /**
     * @Route("/inscription", name="inscription")
     */

    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('app/app.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
