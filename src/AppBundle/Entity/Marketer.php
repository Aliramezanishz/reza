<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Marketer
 *
 * @JMS\ExclusionPolicy("All")
 * @ORM\Table(name="marketer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MarketerRepository")
 */
class Marketer {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @JMS\Expose
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
     *
     * @ORM\Column(name="family", type="string", length=255)
     * @JMS\Expose
     */
    private $family;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     * @JMS\Expose
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255)
     * @JMS\Expose
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="nc", type="string", length=255)
     * @JMS\Expose
     */
    private $nc;

    /**
     * @var string
     *
     * @ORM\Column(name="presenter", type="string", length=255)
     * @JMS\Expose
     */
    private $presenter;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @JMS\Expose
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=255)
     * @JMS\Expose
     */
    private $pass;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     * @JMS\Expose
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="Admin", inversedBy="marketers")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id")
     */
    private $Admin;

    /**
     * @ORM\OneToMany(targetEntity="orders", mappedBy="marketer")
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
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Marketer
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
     * @return Marketer
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
     * @return Marketer
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
     * @return Marketer
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
     * @return Marketer
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
     * Set presenter
     *
     * @param string $presenter
     *
     * @return Marketer
     */
    public function setPresenter($presenter) {
        $this->presenter = $presenter;

        return $this;
    }

    /**
     * Get presenter
     *
     * @return string
     */
    public function getPresenter() {
        return $this->presenter;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Marketer
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
     * @return Marketer
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
     * @return Marketer
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
    public function __construct()
    {
        $this->orderss = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set admin
     *
     * @param \AppBundle\Entity\Admin $admin
     *
     * @return Marketer
     */
    public function setAdmin(\AppBundle\Entity\Admin $admin = null)
    {
        $this->Admin = $admin;

        return $this;
    }

    /**
     * Get admin
     *
     * @return \AppBundle\Entity\Admin
     */
    public function getAdmin()
    {
        return $this->Admin;
    }

    /**
     * Add orderss
     *
     * @param \AppBundle\Entity\orders $orderss
     *
     * @return Marketer
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
