<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Admin
 * @JMS\ExclusionPolicy("All")
 * @ORM\Table(name="admin")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdminRepository")
 */
class Admin {

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
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @JMS\Expose
     */
    private $name;

    /**
     * @var string
     * @JMS\Expose
     * @ORM\Column(name="family", type="string", length=255)
     */
    private $family;

    /**
     * @var string
     * @JMS\Expose
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     * @JMS\Expose
     * @ORM\Column(name="tel", type="string", length=255)
     */
    private $tel;

    /**
     * @var string
     * @JMS\Expose
     * @ORM\Column(name="nc", type="string", length=255)
     */
    private $nc;

    /**
     * @var string
     * @JMS\Expose
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * @JMS\Expose
     * @ORM\Column(name="pass", type="string", length=255)
     */
    private $pass;

    /**
     * @var string
     * @JMS\Expose
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="Marketer", mappedBy="Admin")
     */
    private $marketers;

    /**
     * @ORM\OneToMany(targetEntity="commodity", mappedBy="Admin")
     */
    private $commodities;
    
      /**
     * @var string
     * @JMS\Expose
     */
    private $massage;
    
     /**
     * @var string
     * 
     * @ORM\Column(name="del", type="string", length=255)
     */
    private $del;

    /**
     * Set del
     *
     * @param string $del
     *
     * @return Admin
     */
    public function setDel($del) {
        $this->del = $del;

        return $this;
    }

    /**
     * Get del
     *
     * @return string
     */
    public function getDel() {
        return $this->del;
    }

    
    
    /**
     * Get id
     *
     * @return int
     */
    public function __toString() {
        return (string) $this->id;
    }

    public function getId() {
        return $this->id;
    }

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
    
    
    /**
     * Set name
     *
     * @param string $name
     *
     * @return Admin
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set family
     *
     * @param string $family
     *
     * @return Admin
     */
    public function setFamily($family) {
        $this->family = $family;

        return $this;
    }

    /**
     * Get family
     *
     * @return string
     */
    public function getFamily() {
        return $this->family;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Admin
     */
    public function setAddress($address) {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Admin
     */
    public function setTel($tel) {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel() {
        return $this->tel;
    }

    /**
     * Set nc
     *
     * @param string $nc
     *
     * @return Admin
     */
    public function setNc($nc) {
        $this->nc = $nc;

        return $this;
    }

    /**
     * Get nc
     *
     * @return string
     */
    public function getNc() {
        return $this->nc;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Admin
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return Admin
     */
    public function setPass($pass) {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass() {
        return $this->pass;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Admin
     */
    public function setRole($role) {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->marketers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->commodities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add marketer
     *
     * @param \AppBundle\Entity\Marketer $marketer
     *
     * @return Admin
     */
    public function addMarketer(\AppBundle\Entity\Marketer $marketer) {
        $this->marketers[] = $marketer;

        return $this;
    }

    /**
     * Remove marketer
     *
     * @param \AppBundle\Entity\Marketer $marketer
     */
    public function removeMarketer(\AppBundle\Entity\Marketer $marketer) {
        $this->marketers->removeElement($marketer);
    }

    /**
     * Get marketers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarketers() {
        return $this->marketers;
    }

    /**
     * Add commodity
     *
     * @param \AppBundle\Entity\commodity $commodity
     *
     * @return Admin
     */
    public function addCommodity(\AppBundle\Entity\commodity $commodity) {
        $this->commodities[] = $commodity;

        return $this;
    }

    /**
     * Remove commodity
     *
     * @param \AppBundle\Entity\commodity $commodity
     */
    public function removeCommodity(\AppBundle\Entity\commodity $commodity) {
        $this->commodities->removeElement($commodity);
    }

    /**
     * Get commodities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommodities() {
        return $this->commodities;
    }

}
