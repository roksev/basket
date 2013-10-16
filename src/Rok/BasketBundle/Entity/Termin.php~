<?php

namespace Rok\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Rok\BasketBundle\Entity;

/**
 * Termin
 *
 * @ORM\Table(name="termin")
 * @ORM\Entity(repositoryClass="Rok\BasketBundle\Entity\TerminRepository")
 */
class Termin
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
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date", nullable=true)
     */
    private $datum;



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
     * Set datum
     *
     * @param \DateTime $datum
     * @return Termin
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    
        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime 
     */
    public function getDatum()
    {
        return $this->datum;
    }
    
    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="termin")
     * @ORM\JoinTable(name="obisk_termina")
     **/
    private $users;
    
    public function __construct() {
    	$this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \Rok\BasketBundle\Entity\User $users
     * @return Termin
     */
    public function addUser(\Rok\BasketBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Rok\BasketBundle\Entity\User $users
     */
    public function removeUser(\Rok\BasketBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}