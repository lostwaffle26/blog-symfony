<?php

namespace App\Controller;

use App\Entity\Articles;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticlesController
 * @package App\Controller
 * @Route("/blog", name="blog")
 */
class ArticlesController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        // Ici on appelle la liste de tous les articles
        $donnees = $this->getDoctrine()->getRepository(Articles::class)->findBy([],
        ['created_at' => 'desc']);

        $articles = $paginator-> paginate(
            $donnees,
            $request->query->getInt('page', 1),// numéro de la page en cours, 1 par défaut
            4
        );
        return $this->render('articles/index.html.twig', [
            'articles' => $articles
        ]);
    }
}
