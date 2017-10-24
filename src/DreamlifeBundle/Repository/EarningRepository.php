<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 24/10/2017
 * Time: 03:17
 */
use Doctrine\ORM\EntityRepository;

class EarningRepository extends EntityRepository
{
    public function FindCount($i)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('count(*)');
        $qb->from('DreamlifeBundle:DreamlifePartnerSale','sale');
        $qb->where('sale.partnerUid = :name');
        $qb->setParameter('name', $i);
        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }
}