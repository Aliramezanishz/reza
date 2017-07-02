<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Customer
 *@JMS\ExclusionPolicy("All")
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @var int
     *@JMS\Expose
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *@JMS\Expose
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *@JMS\Expose
     * @ORM\Column(name="family", type="string", length=255)
     */
    private $family;

    /**
     * @var string
     *@JMS\Expose
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *@JMS\Expose
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var string
     *@JMS\Expose
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     *@JMS\Expose
     * @ORM\Column(name="subscribe", type="string", length=255)
     */
    private $subscribe;
    
   /**
     * @ORM\OneToMany(targetEntity="orders", mappedBy="customer")
     */
    private $orderss;
    
    
          /**
     * @var string
     * @JMS\Expose
     */
    private $massage;
    
      /**
     * Set massage
     *
     * @param string $massage
     *
     * @return Admin
     */
    public function setMassage($massage) {
        $this->massage = $massage;

        return $this;
    }
    
    /**
     * Get massage
     *
     * @return string
     */
    public function getMassage() {
        return $this->massage;
    }


     public function __toString() {
        return (string) $this->id;
       
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
     * Set name
     *
     * @param string $name
     *
     * @return Customer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set family
     *
     * @param string $family
     *
     * @return Customer
     */
    public function setFamily($family)
    {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Customer
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Customer
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Customer
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set subscribe
     *
     * @param string $subscribe
     *
     * @return Customer
     */
    public function setSubscribe($subscribe)
    {
        $this->subscribe = $subscribe;

        return $this;
    }

    /**
     * Get subscribe
     *
     * @return string
     */
    public function getSubscribe()
    {
        return $this->subscribe;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orderss = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add orderss
     *
     * @param \AppBundle\Entity\orders $orderss
     *
     * @return Customer
     */
    public function addOrderss(\AppBundle\Entity\orders $orderss)
    {
        $this->orderss[] = $orderss;

        return $this;
    }

    /**
     * Remove orderss
     *
     * @param \AppBundle\Entity\orders $orderss
     */
    public function removeOrderss(\AppBundle\Entity\orders $orderss)
    {
        $this->orderss->removeElement($orderss);
    }

    /**
     * Get orderss
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderss()
    {
        return $this->orderss;
    }
}
