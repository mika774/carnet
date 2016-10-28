<?php

namespace Carnet\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vidange
 *
 * @ORM\Table(name="vidange")
 * @ORM\Entity(repositoryClass="Carnet\CarBundle\Repository\VidangeRepository")
 */
class Vidange
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="nbKm", type="integer")
     */
    private $nbKm;

    /**
     * @ORM\ManyToOne(targetEntity="Carnet\CarBundle\Entity\Car", inversedBy="vidanges")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car;

    /**
     * @ORM\ManyToMany(targetEntity="Carnet\CarBundle\Entity\Reparation", cascade={"persist"})
     */
    private $reparations;


    public function __construct()
    {
        $this->date = new \Datetime();
    }


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Vidange
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nbKm
     *
     * @param integer $nbKm
     *
     * @return Vidange
     */
    public function setNbKm($nbKm)
    {
        $this->nbKm = $nbKm;

        return $this;
    }

    /**
     * Get nbKm
     *
     * @return integer
     */
    public function getNbKm()
    {
        return $this->nbKm;
    }

    /**
     * Set car
     *
     * @param \Carnet\CarBundle\Entity\Car $car
     *
     * @return Vidange
     */
    public function setCar(\Carnet\CarBundle\Entity\Car $car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Get car
     *
     * @return \Carnet\CarBundle\Entity\Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Add reparation
     *
     * @param \Carnet\CarBundle\Entity\Reparation $reparation
     *
     * @return Vidange
     */
    public function addReparation(\Carnet\CarBundle\Entity\Reparation $reparation)
    {
        $this->reparations[] = $reparation;

        return $this;
    }

    /**
     * Remove reparation
     *
     * @param \Carnet\CarBundle\Entity\Reparation $reparation
     */
    public function removeReparation(\Carnet\CarBundle\Entity\Reparation $reparation)
    {
        $this->reparations->removeElement($reparation);
    }

    /**
     * Get reparations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReparations()
    {
        return $this->reparations;
    }
}
