<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RepController extends AbstractController
{
    /**
     * @Route("/rep", name="rep")
     */
    public function index()
    {
        $content = file_get_contents('../public/gameslist.json');
        $response = new Response();
        $response->setContent($content);
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
}
