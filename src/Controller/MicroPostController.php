<?php
/**
 * Created by PhpStorm.
 * User: esterfano
 * Date: 22/11/18
 * Time: 15:24
 */

namespace App\Controller;


use App\Repository\MicroPostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MicroPostController
 * @package App\Controller
 * @Route("/micro-post")
 */
class MicroPostController
{
    private $twig;

    private $microPostRepository;

    public function __construct(\Twig_Environment $twig, MicroPostRepository $microPostRepository)
    {
        $this->twig = $twig;
        $this->microPostRepository = $microPostRepository;
    }

    /**
     * @Route("/", name="micro_post_index")
     */
    public function index()
    {
        $html = $this->twig->render('micro-post/index.html.twig', [
            'posts' => $this->microPostRepository->findAll()
        ]);

        return new Response($html);
    }
}