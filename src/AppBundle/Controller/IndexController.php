<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Drink;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    /**
     * @Route("/like/{id}", name="like")
     */
    public function likeAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $drink = $this->getDoctrine()
            ->getRepository('AppBundle:Drink')
            ->find($id);


        /** @var Drink $drink */
        $drink->setLike($drink->getLike() + 1);

        $em->flush();
        return new JsonResponse(['status' => 'ok']);
    }
}
