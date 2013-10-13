<?php

namespace Rok\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObiskTermina
 *
 * @ORM\Table(name="obisk_termina")
 * @ORM\Entity
 */
class ObiskTermina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Rok\BasketBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="Rok\BasketBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Rok\BasketBundle\Entity\Termin
     *
     * @ORM\ManyToOne(targetEntity="Rok\BasketBundle\Entity\Termin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="termin", referencedColumnName="id")
     * })
     */
    private $termin;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \Rok\BasketBundle\Entity\User $user
     * @return ObiskTermina
     */
    public function setUser(\Rok\BasketBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Rok\BasketBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set termin
     *
     * @param \Rok\BasketBundle\Entity\Termin $termin
     * @return ObiskTermina
     */
    public function setTermin(\Rok\BasketBundle\Entity\Termin $termin = null)
    {
        $this->termin = $termin;
    
        return $this;
    }

    /**
     * Get termin
     *
     * @return \Rok\BasketBundle\Entity\Termin 
     */
    public function getTermin()
    {
        return $this->termin;
    }
}