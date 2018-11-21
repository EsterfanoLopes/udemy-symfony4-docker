<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\RedirectResponse;
use \Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class BlogController
 * @package App\Controller
 * @Route("/blog")
 */
class BlogController
{

    private $twig;

    public function __construct(
        \Twig_Environment $twig,
        SessionInterface $session,
        RouterInterface $router
    )
    {
        $this->twig = $twig;
        $this->session = $session;
        $this->router = $router;
    }

    /**
     * @Route("/", name="blog_index")
     */
    public function index()
    {
        $html = $this->twig->render(
            'blog/index.html.twig',
            [
                'posts' => $this->session->get('posts')
            ]
        );

        return new Response($html);
    }

    /**
     * @Route("/add", name="blog_add")
     */
    public function add()
    {
        $posts = $this->session->get('posts');
        $posts[uniqid()] = [
            'title' => 'A random title '.rand(1, 500),
            'text' => 'Some random text nr '.rand(1, 500),
            'date' => new \Datetime(),
        ];
        $this->session->set('posts', $posts);

        return new RedirectResponse($this->router->generate('blog_index'));
    }

    /**
     * @Route("/show/{id}", name="blog_show")
     */
    public function show($id)
    {
        $posts = $this->session->get('posts');

        if (!$posts || !isset($posts[$id])) {
            throw new NotFoundHttpException("Post not found");
        }

        $html = $this->twig->render(
            'blog/post.html.twig',
            [
                'id' => $id,
                'post' => $posts[$id],
            ]
        );

        return new Response($html);
    }
}
