<?php

namespace Rok\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Rok\BasketBundle\Entity;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Rok\BasketBundle\Entity\UserRepository")
 */
class User implements UserInterface, \Serializable
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
     * @ORM\Column(name="username", type="string", length=30, nullable=false)
     */
    private $username;
    
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
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=2000, nullable=false)
     */
    private $password;
    
    /**
     * @ORM\Column(name="email", unique=true, length=150)
     */
    
    private $email;
    
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
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }

    /**
     * Add termini
     *
     * @param \Rok\BasketBundle\Entity\Termin $termin
     * @return User
     */
    public function addTermini(\Rok\BasketBundle\Entity\Termin $termin)
    {
        $this->termin[] = $termin;
    
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
    
	/**
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
	 */
	public function getRoles() {
		return array('ROLE_USER');

	}

	/**
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getPassword()
	 */
	public function getPassword() {
		return $this->password;

	}

	/**
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
	 */
	public function getSalt() {
		return null;//$this->salt;

	}

	/**
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getUsername()
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
	 */
	public function eraseCredentials() {
		// TODO: Auto-generated method stub

	}
	
	/**
	 * @see \Serializable::serialize()
	 */
	public function serialize()
	{
		return serialize(array(
				$this->id,
		));
	}
	
	/**
	 * @see \Serializable::unserialize()
	 */
	public function unserialize($serialized)
	{
		list (
				$this->id,
		) = unserialize($serialized);
	}


    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }
}