<?php

namespace Rok\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Rok\BasketBundle\Entity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Rok\BasketBundle\Entity\UserRepository")
 */
class User
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
     * @var string
     *
     * @ORM\Column(name="ime_priim", type="string", length=30, nullable=false)
     */
    private $imePriim;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=10, nullable=false)
     */
    private $role;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;



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
     * Set imePriim
     *
     * @param string $imePriim
     * @return User
     */
    public function setImePriim($imePriim)
    {
        $this->imePriim = $imePriim;
    
        return $this;
    }

    /**
     * Get imePriim
     *
     * @return string 
     */
    public function getImePriim()
    {
        return $this->imePriim;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
    
    /**
     * @ORM\ManyToMany(targetEntity="Termin", mappedBy="user")
     * @ORM\JoinTable(name="obisk_termina")
     **/
    private $termini;

    public function __construct() {
        $this->termini = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add termini
     *
     * @param \Rok\BasketBundle\Entity\Termin $termini
     * @return User
     */
    public function addTermini(\Rok\BasketBundle\Entity\Termin $termini)
    {
        $this->termini[] = $termini;
    
        return $this;
    }

    /**
     * Remove termini
     *
     * @param \Rok\BasketBundle\Entity\Termin $termini
     */
    public function removeTermini(\Rok\BasketBundle\Entity\Termin $termini)
    {
        $this->termini->removeElement($termini);
    }

    /**
     * Get termini
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTermini()
    {
        return $this->termini;
    }
}