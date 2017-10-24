<?php

namespace MyAppBundle\Controller;

use Doctrine\DBAL\Types\JsonArrayType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use MyAppBundle\Entity\Neud;

class NeudController extends Controller
{
    public function indexAction()
    {
        $number = mt_rand(0, 100);
        //$this->getNeudsAction();
        return $this->render('@MyApp/test/index.html.twig', array(
            'number' => $number,
        ));
    }
    public function  getmychield( $i){
        $neuds = $this->get('doctrine.orm.entity_manager')
            ->getRepository('MyAppBundle:Neud')
            ->findAll();
        $t = array();
    foreach ($neuds as $neud) {

        if($neud->getParentId()==$i){
            array_push($t, $neud);

        }
}
return $t;
}
    /**
     * @Route("/neuds", name="neud_list")
     * @Method({"GET"})
     */

    public function getNeudsAction(Request $request)
    {
        $neuds = $this->get('doctrine.orm.entity_manager')
            ->getRepository('MyAppBundle:Neud')
            ->findAll();
        $i=0;
        foreach ($neuds as $neud) {
            $i++;
        }
        /* @var $places Place[] */

        $formatted = [];
        $s = [];
        int : $i=1;
        foreach ($neuds as $neud) {
            if($i==1){
           $t = array();
            foreach ($neuds as $neut) {
                if($neud->getId()==$neut->getParentId()){
                  /* $t[]=[
                    'name' => $neut->getId(),
                //'title' => $neut->getParentId(),
                'title' => $neut->getDescription(),];
                  //$t=array($neut);*/
                    array_push($t, $neut);
                }
            }
           /* $formatted[] = [
                'name' => $neud->getId(),
                //'parent' => $neud->getParentId(),
                'title' => $neud->getDescription(),
                'children' => json_encode($t, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                //'children' => new JsonResponse($s),
            ];*/
                $formatted = [
                    'name' => $neud->getId(),
                    //'parent' => $neud->getParentId(),
                    'title' => $neud->getDescription(),
                    //'children' => json_encode($t, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                    'children' =>[ ['name' =>$t[0]->getId(),
                        'title' => $t[0]->getDescription(),],
                       [ 'name' =>$t[1]->getId(),
                        'title' => $t[1]->getDescription(),
                        ]],
                    //'children' => new JsonResponse($s),
                ];
            }
            $i++;

        }

      /*  $formatted = [];


                $formatted[] = [
                    'id' => $neud->getId(),
                    'parent' => $neud->getParentId(),
                    'description' => $neud->getDescription(),
                    'children' => json_encode($this->getmychield($neuds,1), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
                    //'children' => new JsonResponse($s),
                ];*/


        return new JsonResponse($formatted);

      /*  function getchildren($neuds, $id){
            foreach ($neuds as $neut) {
                if($neut->getId()==$id){
                    $t[]=[
                        'id' => $neut->getId(),
                        'parent' => $neut->getParentId(),
                        'description' => $neut->getDescription(),];
                }
            }
        }*/

    }
    /**
     * @Route("/neuds", name="neud_list")
     * @Method({"GET"})
     */

    /**
     * @Route("/neuds/{neud_id}", name="neud_one")
     * @Method({"GET"})
     */
    public function getNeudByIdAction(Request $request)
    {
        $neud = $this->get('doctrine.orm.entity_manager')
            ->getRepository('MyAppBundle:Neud')
            ->find($request->get('neud_id'));
        /* @var $place Place */
        $formatted = [
            'name' => $neud->getId(),
            //'parent' => $neud->getParentId(),
            'title' => $neud->getDescription(),
            //'children' => json_encode($t, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            'children' =>[ ['name' =>$this->getmychield($neud->getId())[0]->getId(),
                'title' => $this->getmychield($neud->getId())[0]->getDescription(),],
                [ 'name' =>$this->getmychield($neud->getId())[1]->getId(),
                    'title' => $this->getmychield($neud->getId())[1]->getDescription(),],

                ],
            //'children' => new JsonResponse($s),
        ];

        return new JsonResponse($formatted);
    }
    public function TreebyidAction()
    {
        $number = mt_rand(0, 100);
        //$this->getNeudsAction();
        return $this->render('@MyApp/treepartner.html.twig', array(
            'number' => $number,
        ));
    }
}
