<?php

namespace DreamlifeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DreamlifePartnerSale
 *
 * @ORM\Table(name="dreamlife_partner_sale", indexes={@ORM\Index(name="partner_uid", columns={"partner_uid"})})
 * @ORM\Entity
 */
class DreamlifePartnerSale
{
    /**
     * @var integer
     *
     * @ORM\Column(name="partner_uid", type="integer", nullable=false)
     */
    private $partnerUid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deleted_at", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=false)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=false)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="partner_code", type="string", length=255, nullable=true)
     */
    private $partnerCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="paid_date", type="datetime", nullable=true)
     */
    private $paidDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;


}

