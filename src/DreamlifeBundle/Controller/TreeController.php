<?php

namespace DreamlifeBundle\Controller;
use DreamlifeBundle\Entity\DreamlifePartnerSale;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DreamlifeBundle\Entity\CoreUserUser;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\ErrorHandler;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;
use DreamlifeBundle\Entity\DreamlifePartnerSale as dps;
use EarningRepository;

class TreeController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function getmychield($i)
    {

        $neuds = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:DreamlifePartnerPartner')
            ->findBytreeParentId($i);
        return $neuds;
    }
    public function getnature($i)
    {

        $neuds = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:DreamlifePartnerPartner')
            ->findBytreeParentId($i);
        $x=0;
        foreach ($neuds as $neut) {
            $x++;
        }
        return $x;
    }

    public function getmyinfo($i)
    {

        $neud = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:CoreUserUser')
            ->findOneByUid($i);
        return($neud);
    }
    public function getsale($i)
    {

        $neud = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:DreamlifePartnerSale')
            ->findOneBypartnerUid($i);
        return($neud);
    }
    public function verifsale($i)
    {

        $neud = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:DreamlifePartnerSale')
            ->FindCount($i);//chamsi;
        return($neud);
    }
    public function getsaledate($i)
    {

        $neud = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:DreamlifePartnerSale')
            ->findOneBypartnerUid($i);
        return($neud->getPaidDate());
    }


    /**
     * @Route("/tree/{neud_id}", name="neud_one")
     * @Method({"GET"})
     */
    public function getTreeByIdAction(Request $request)
    {
        $neud = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:CoreUserUser')
            ->find($request->get('neud_id'));
        //$this->getnature($neud->getUid()-1)
        /* @var $place Place */

        if($this->getnature($neud->getUid()-1)==2) {
            if ($this->getmychield($neud->getUid()-1 )[0]->getTreePosition()=="dreamlife_partner.tree_position.left") {
                $formatted = [
                    'name' => $neud->getUid(),
                    'title' => $neud->getLastName() . ' ' . $neud->getFirstName(),
                    'children' => [['name' => $this->getmychield($neud->getUid() - 1)[0]->getUserUid()->getUid(),
                        'title' => $this->getmyinfo($this->getmychield($neud->getUid() - 1)[0]->getUserUid()->getUid())->getFirstName() . ' ' . $this->getmyinfo($this->getmychield($neud->getUid() - 1)[0]->getUserUid()->getUid())->getLastName(),],
                        ['name' => $this->getmychield($neud->getUid() - 1)[1]->getUserUid()->getUid(),
                            'title' => $this->getmyinfo($this->getmychield($neud->getUid() - 1)[1]->getUserUid()->getUid())->getFirstName() . ' ' . $this->getmyinfo($this->getmychield($neud->getUid() - 1)[1]->getUserUid()->getUid())->getLastName(),
                        ]],
                ];
            }
            else{
                $formatted = [
                    'name' => $neud->getUid(),
                    'title' => $neud->getLastName() . ' ' . $neud->getFirstName(),
                    'children' => [['name' => $this->getmychield($neud->getUid() - 1)[1]->getUserUid()->getUid(),
                        'title' => $this->getmyinfo($this->getmychield($neud->getUid() - 1)[1]->getUserUid()->getUid())->getFirstName() . ' ' . $this->getmyinfo($this->getmychield($neud->getUid() - 1)[0]->getUserUid()->getUid())->getLastName(),],
                        ['name' => $this->getmychield($neud->getUid() - 1)[0]->getUserUid()->getUid(),
                            'title' => $this->getmyinfo($this->getmychield($neud->getUid() - 1)[0]->getUserUid()->getUid())->getFirstName() . ' ' . $this->getmyinfo($this->getmychield($neud->getUid() - 1)[1]->getUserUid()->getUid())->getLastName(),
                        ]],
                ];

            }
        }
        elseif ($this->getnature($neud->getUid()-1)==1)
        {
            $formatted = [
                'name' => $neud->getUid(),
                'title' => $neud->getLastName().' '. $neud->getFirstName(),
                'children' =>[ ['name' =>$this->getmychield($neud->getUid()-1 )[0]->getUserUid()->getUid(),
                    'title' => $this->getmyinfo($this->getmychield($neud->getUid()-1 )[0]->getUserUid()->getUid())->getFirstName().' '.$this->getmyinfo($this->getmychield($neud->getUid()-1 )[0]->getUserUid()->getUid())->getLastName(),],
                    ],
            ];

        }else{
            $formatted = [
                'name' => $neud->getUid(),
                'title' => $neud->getLastName().' '. $neud->getFirstName(),

            ];

        }

        return new JsonResponse($formatted);
    }
    public function TreebyidAction()
    {
        $number = mt_rand(0, 100);
        //$this->getNeudsAction();
        return $this->render('DreamlifeBundle::treepartner.html.twig', array(
            'number' => $number,
        ));
    }
    /***earning****/
    /**
     * @Route("/earning/{neud_id}", name="neud_one")
     * @Method({"GET"})
     */
    public function getearnAction(Request $request)
    {
        $neud = $this->get('doctrine.orm.entity_manager')
            ->getRepository('DreamlifeBundle:CoreUserUser')
            ->find($request->get('neud_id'));
        //array_push($t, $neut);
        $lchield = array();
        $rchield= array();
        $naturel = array();
        $naturer = array();
        $levelpl = array();
        $levelpr = array();
      //  if ($this->getmychield($neud->getUid()-1 )[0]->getTreePosition()=="dreamlife_partner.tree_position.left") {
            array_push($lchield, $this->getmyinfo($this->getmychield($neud->getUid() - 1)[0]->getUserUid()->getUid()));
            array_push($rchield, $this->getmyinfo($this->getmychield($neud->getUid() - 1)[1]->getUserUid()->getUid()));
      //  }

       $taille=1;
        $a=0;
        for($c=0;$c<$taille;$c++){
            array_push($naturel, $this->getnature($lchield[$c]->getUid()-1));
            $a++;
            if($this->getnature($lchield[$c]->getUid()-1)==2){
                array_push($lchield,$this->getmyinfo($this->getmychield($lchield[$c]->getUid() - 1)[0]->getUserUid()->getUid()));
                array_push($lchield,$this->getmyinfo($this->getmychield($lchield[$c]->getUid() - 1)[1]->getUserUid()->getUid()));
                $taille=$taille+2;
            }
            elseif ($this->getnature($lchield[$c]->getUid()-1)==1){
                array_push($lchield,$this->getmyinfo($this->getmychield($lchield[$c]->getUid() - 1)[0]->getUserUid()->getUid()));
                $taille++;
            }

        }
        $tailler=1;
        $ar=0;
        for($c=0;$c<$tailler;$c++){
            array_push($naturer, $this->getnature($rchield[$c]->getUid()-1));
            $ar++;
            if($this->getnature($rchield[$c]->getUid()-1)==2){
                array_push($rchield,$this->getmyinfo($this->getmychield($rchield[$c]->getUid() - 1)[0]->getUserUid()->getUid()));
                array_push($rchield,$this->getmyinfo($this->getmychield($rchield[$c]->getUid() - 1)[1]->getUserUid()->getUid()));
                $tailler=$tailler+2;
            }
            elseif ($this->getnature($rchield[$c]->getUid()-1)==1){
                array_push($rchield,$this->getmyinfo($this->getmychield($rchield[$c]->getUid() - 1)[0]->getUserUid()->getUid()));
                $tailler++;
            }

        }
        /*****getlvl**/

        array_push($levelpl,1);
        $nbtour=$naturel[0];
        $dep=1;
        $lvl=2;
        while ($nbtour>0){
            $x=$nbtour;
            $nbtour =0;
            for($c=$dep;$c<$dep+$x;$c++){
                $nbtour=$nbtour+$naturel[$c];
                $levelpl[$c]=$lvl;


            }
            $dep=$dep+$x;
            $lvl++;
        }
        /***right**/
        array_push($levelpr,1);
        $nbtour=$naturer[0];
        $dep=1;
        $lvl=2;
        while ($nbtour>0){
            $x=$nbtour;
            $nbtour =0;
            for($c=$dep;$c<$dep+$x;$c++){
                $nbtour=$nbtour+$naturer[$c];
                $levelpr[$c]=$lvl;


            }
            $dep=$dep+$x;
            $lvl++;
        }
       /****creditation partner***/
        $lcp = array();
        $lci=0;
        foreach ($naturel as $k) {
            if($k==2){
                $lcp[]=[
                    'partner' => $lchield[$lci]->getUid(),
                    'level' => $levelpl[$lci],];

            }
            $lci++;
        }


        $rcp = array();
        $rci=0;
        foreach ($naturer as $k) {
            if($k==2){
                $rcp[]=[
                    'partner' => $rchield[$rci]->getUid(),
                    //'title' => $neut->getParentId(),
                    'level' => $levelpr[$rci],];

            }
            $rci++;
        }
        /****max level ****/
        $tailletabl=0;
        foreach ($lcp as $k) {
            $tailletabl++;

        }
        $tailletabr=0;
        foreach ($rcp as $k) {
            $tailletabr++;


        }
        $startMonth = new \DateTime('2017'.'-'.'03'.'-31 23:59:59');//date end old pay plan
        $startMonth1 = new \DateTime('2016'.'-'.'03'.'-31 23:59:59');//date end old pay plan
        $dcommision =0.0;
       if ($this->verifsale($this->getmychield($neud->getUid()-1)[0]->getUserUid()->getUid()-1)>0&&
            $this->verifsale($this->getmychield($neud->getUid()-1)[1]->getUserUid()->getUid()-1)>0){
           if(($this->getsale($this->getmychield($neud->getUid())[0]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)&&
               ($this->getsale($this->getmychield($neud->getUid()-1)[0]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)){
               $dcommision=($this->getsale($this->getmychield($neud->getUid())[0]->getUserUid()->getUid()-1)->getAmount()+
                   $this->getsale($this->getmychield($neud->getUid())[1]->getUserUid()->getUid()-1)->getAmount())*0.1;
               $dcommision=($this->getsale($this->getmychield($neud->getUid())[0]->getUserUid()->getUid()-1)->getAmount()+
                       $this->getsale($this->getmychield($neud->getUid())[1]->getUserUid()->getUid()-1)->getAmount())*0.04;
           }else{
               $dcommision=($this->getsale($this->getmychield($neud->getUid())[0]->getUserUid()->getUid()-1)->getAmount()+
                       $this->getsale($this->getmychield($neud->getUid())[1]->getUserUid()->getUid()-1)->getAmount())*0.1;
               $dcommision=($this->getsale($this->getmychield($neud->getUid())[0]->getUserUid()->getUid()-1)->getAmount()+
                       $this->getsale($this->getmychield($neud->getUid())[1]->getUserUid()->getUid()-1)->getAmount())*0.14;
           }
       }

       if($tailletabl<$tailletabr){
           $commision =0.0;
            $fc=0;
            foreach ($lcp as $k) {

                $existe=0;
                $i=$fc;

                while (($i<$tailletabr) || ($existe==0)){
                    if($i==$tailletabr){
                        break;
                    }

                    if($k['level']==$rcp[$i]['level']&&($this->verifsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)>0&&
                            $this->verifsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)>0)){




                        if(($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)&& //deano
                            ($this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)&&
                        ($this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)&&
                            ($this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)){
                      // if($startMonth>$startMonth1){
                            if($k['level']==1){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.08;
                            }elseif ($k['level']==2){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.06;
                            }elseif ($k['level']==3){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.04;
                            }elseif ($k['level']==4){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.03;

                            }else{
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.02;
                               // $this->getsale($this->getmychield($rcp[88]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()
                            }
                        }
                        else{
                            if($k['level']==1){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.01;
                            }elseif ($k['level']==2){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.08;
                            }elseif ($k['level']==3){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.06;
                            }else{
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($rcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.05;
                            }
                        }

                        $fc=$i+1;
                        $existe=1;
                    }
                    $i++;
                }
            }

        }
        else{
            $commision =0.0;
            $fc=0;
            foreach ($rcp as $k) {
                $existe=0;
                $i=$fc;
                while (($i<$tailletabl) || ($existe==0)){
                    if($i==$tailletabl){
                        break;
                    }

                    if($k['level']==$lcp[$i]['level']&&($this->verifsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)>0&&
                            $this->verifsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)>0)){



                        if(($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)&& //deano
                            ($this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)&&
                            ($this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)&&
                            ($this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getPaidDate()<$startMonth)){
                            // if($startMonth>$startMonth1){
                            if($k['level']==1){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.08;
                            }elseif ($k['level']==2){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.06;
                            }elseif ($k['level']==3){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.04;
                            }elseif ($k['level']==4){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.03;

                            }else{
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.02;
                                // $this->getsale($this->getmychield($rcp[88]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()
                            }
                        }
                        else{
                            if($k['level']==1){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.01;
                            }elseif ($k['level']==2){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.08;
                            }elseif ($k['level']==3){
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.06;
                            }else{
                                $commision=$commision+($this->getsale($this->getmychield($k['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+ //deano
                                        $this->getsale($this->getmychield($k['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[0]->getUserUid()->getUid()-1)->getAmount()+
                                        $this->getsale($this->getmychield($lcp[$i]['partner']-1)[1]->getUserUid()->getUid()-1)->getAmount())*0.05;
                            }
                        }

                        $fc=$i+1;
                        $existe=1;
                    }

                    $i++;
                }
            }

        }





           $formatted[] = [
                'commission' => $commision+$dcommision,



            ];



        return new JsonResponse($formatted);





       /* return $this->render('@Dreamlife/Default/index.html.twig', array(
            'voiture' => $neud,
        ));*/
    }
    public  function firstoccurence($t=[],$lvl){
        
        foreach ($t as $k) {
            if($k['level']==$lvl){
                return ;
            }
        }

    }
   public  function triertab($t=[], $i,$j,$lvl){
        for($c=$i;$c<$j-1;$c++){
            $min=$c;
            for($k=$c+1;$k<$j;$k++){
                if($t[$min]['partner']<$t[$k]['partner']){
                    $min=$k;
                }
            }
            $intermd=$t[$min];
            $t[$min]=$t[$c];
            $t[$c]=$intermd;

        }
}
    public function finaliste($i){
        if($this->getsale($this->getmychield($i-1)[0]->getUid()-1)->getPaidDate()<
            $this->getsale($this->getmychield($i-1)[1]->getUid()-1)->getPaidDate() ){

            return $this->getsale($this->getmychield($i-1)[0]->getUid()-1)->getPaidDate();

        }else{
            return $this->getsale($this->getmychield($i-1)[1]->getUid()-1)->getPaidDate();
        }
    }

    public function akdem($i,$j){

        if($this->finaliste($i)<$this->finaliste($j)){
            return $i;
        }else{
            return $j;
        }


    }

    public function sommetab($i,$j,$nt = array()){
        $somme=0;
        for($c=$i;$c<=$j;$c++){
            $somme=$somme+$nt[c];
        }
        return $somme;
    }
}
