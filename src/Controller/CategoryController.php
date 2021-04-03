<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="selectedCategory", methods={"GET"})
     */
    public function getCategory(CategoryRepository $categoryRepository, $id): JsonResponse
    {

        $game = $categoryRepository->find($id);

        return $this->json($game->getGames());
    }

    
}
