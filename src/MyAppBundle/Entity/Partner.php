<?php
/**
 * Created by PhpStorm.
 * User: walid
 * Date: 14/10/2017
 * Time: 17:31
 */

namespace MyAppBundle\Entity;

/**
 * @ORM\Entity
 * @ORM\Table(name="partner")
 */
class Partner
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    public $id;
    /**
     * @ORM\Column(type="integer")
     */
    public $parent_id;
    /**
     * @ORM\Column(type="integer")
     */
    public $desc;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }



}