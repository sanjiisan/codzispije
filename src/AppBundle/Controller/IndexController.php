<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Drink;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('@App/Page/index.html.twig');
    }

    /**
     * @Route("/random", name="random")
     */
    public function randomAction()
    {
        $manager = $this->get('doctrine.orm.entity_manager');

        $repo = $manager->getRepository(Drink::class);

        $drinks = $repo->findAll();

        return $this->render('@App/Page/random.html.twig',
            [
                'drink' => $drinks[rand(0, count($drinks) - 1)]
            ]
        );

    }
}
