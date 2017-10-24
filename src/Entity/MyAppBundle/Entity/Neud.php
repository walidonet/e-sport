<?php

namespace MyAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Neud
 *
 * @ORM\Table(name="neud")
 * @ORM\Entity(repositoryClass="MyAppBundle\Repository\NeudRepository")
 */
class Neud
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer")
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


}

