<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RepController extends AbstractController
{
    /**
     * @Route("/rep", name="rep")
     */
    public function game()
    {
        $content = json_decode(file_get_contents('../public/gameslist.json'));
        return $this->json($content);
    }
}
