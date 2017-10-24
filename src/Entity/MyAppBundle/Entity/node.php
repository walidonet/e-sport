<?php

namespace MyAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * node
 *
 * @ORM\Table(name="node")
 * @ORM\Entity(repositoryClass="MyAppBundle\Repository\nodeRepository")
 */
class node
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

