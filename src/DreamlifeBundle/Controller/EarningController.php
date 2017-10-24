<?php

namespace DreamlifeBundle\Controller;

use DreamlifeBundle\Entity\CoreUserUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EarningController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    /**
     * @Route("/earning/{neud_id}", name="neud_one")
     * @Method({"GET"})
     */
    public function getearnAction(Request $request,CoreUserUser $coreUserUser)
    {
        $neud = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:CoreUserUser')
            ->find($request->get('neud_id'));


        return $this->render('@MyApp/test/index.html.twig', array(
            'voiture' => $coreUserUser,
        ));
    }
}
