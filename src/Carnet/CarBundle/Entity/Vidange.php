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
     * @ORM\ManyToOne(targetEntity="Carnet\CarBundle\Entity\Car", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $car;


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
}
