<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 08/02/2017
 * Time: 20:27
 */

namespace MyAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="voiture")
 * @UniqueEntity(
 *     fields={"matricule"},
 *     message="cette matricule est déja utilisé . Veuillez vérifier la votre "
 * )
 */
class Voiture
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    public $id;
    /**
     * @ORM\Column(type="string",length=225)
     */
    public $matricule;

    /**
     * @ORM\Column(type="string",length=225)
     */
    public $modele;
    /**
     * @ORM\Column(type="string",length=225)
     */
    public $marque;
    /**
     * @ORM\Column(type="string",length=225,nullable=true)
     */
    public $photo;
    /**
     * @ORM\Column(type="integer")
     */
    public $nombreplaces;
    /**
     * @ORM\Column(type="string",length=225)
     */
    public $puissance;

    /**
     * @ORM\Column(type="array",nullable=true)
     */
    public $imagePath;


    /**
     * @ORM\Column(type="text",nullable=true)
     */
    public $description;

    /**
     * Vehicule constructor.
     */
    public function __construct()
    {
    }

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
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * @param mixed $matricule
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    }

    /**
     * @return mixed
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * @param mixed $modele
     */
    public function setModele($modele)
    {
        $this->modele = $modele;
    }

    /**
     * @return mixed
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param mixed $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getNombreplaces()
    {
        return $this->nombreplaces;
    }

    /**
     * @param mixed $nombreplaces
     */
    public function setNombreplaces($nombreplaces)
    {
        $this->nombreplaces = $nombreplaces;
    }

    /**
     * @return mixed
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * @param mixed $puissance
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;
    }

    /**
     * @return mixed
     */
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * @param mixed $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }



    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }







}