<?php

namespace DreamlifeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DreamlifePartnerPartner
 *
 * @ORM\Table(name="dreamlife_partner_partner", indexes={@ORM\Index(name="pack_id", columns={"pack_id"}), @ORM\Index(name="enroller_id", columns={"enroller_id"}), @ORM\Index(name="tree_parent_id", columns={"tree_parent_id"}), @ORM\Index(name="user_uid", columns={"user_uid"})})
 * @ORM\Entity
 */
class DreamlifePartnerPartner
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tree_parent_id", type="integer", nullable=true)
     */
    private $treeParentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="enroller_id", type="integer", nullable=true)
     */
    private $enrollerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="pack_id", type="integer", nullable=true)
     */
    private $packId;

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
     * @var string
     *
     * @ORM\Column(name="pack_code", type="string", length=255, nullable=true)
     */
    private $packCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="validate_date_for_user", type="datetime", nullable=true)
     */
    private $validateDateForUser;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\Column(name="tree_depth", type="integer", nullable=true)
     */
    private $treeDepth;

    /**
     * @var string
     *
     * @ORM\Column(name="tree_position", type="string", length=255, nullable=true)
     */
    private $treePosition;

    /**
     * @var string
     *
     * @ORM\Column(name="parent_code", type="string", length=255, nullable=true)
     */
    private $parentCode;

    /**
     * @var string
     *
     * @ORM\Column(name="qualification", type="string", length=255, nullable=true)
     */
    private $qualification = 'dreamlife_partner.qualification.client';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_placed", type="boolean", nullable=false)
     */
    private $isPlaced = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var \DreamlifeBundle\Entity\CoreUserUser
     *
     * @ORM\ManyToOne(targetEntity="DreamlifeBundle\Entity\CoreUserUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_uid", referencedColumnName="uid")
     * })
     */
    private $userUid;


}

