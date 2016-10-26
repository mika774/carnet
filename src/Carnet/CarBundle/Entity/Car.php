<?php

namespace Carnet\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="Carnet\CarBundle\Repository\CarRepository")
 */
class Car
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mark", type="string", length=255)
     */
    private $mark;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="Carnet\CarBundle\Entity\Vidange", mappedBy="car")
     */
    private $vidanges;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mark
     *
     * @param string $mark
     *
     * @return Car
     */
    public function setMark($mark)
    {
        $this->mark = $mark;

        return $this;
    }

    /**
     * Get mark
     *
     * @return string
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Car
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vidanges = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add vidange
     *
     * @param \Carnet\CarBundle\Entity\Vidange $vidange
     *
     * @return Car
     */
    public function addVidange(\Carnet\CarBundle\Entity\Vidange $vidange)
    {
        $this->vidanges[] = $vidange;

        return $this;
    }

    /**
     * Remove vidange
     *
     * @param \Carnet\CarBundle\Entity\Vidange $vidange
     */
    public function removeVidange(\Carnet\CarBundle\Entity\Vidange $vidange)
    {
        $this->vidanges->removeElement($vidange);
    }

    /**
     * Get vidanges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVidanges()
    {
        return $this->vidanges;
    }
}
