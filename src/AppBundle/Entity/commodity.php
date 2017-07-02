<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * commodity
 *
 * @ORM\Table(name="commodity")
 * @JMS\ExclusionPolicy("All")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\commodityRepository")
 */
class commodity
{
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
     * @ORM\Column(name="count", type="string", length=255)
     * @JMS\Expose
     */
    private $count;

    /**
     * @var string
     *
     * @ORM\Column(name="fie", type="string", length=255)
     * @JMS\Expose
     */
    private $fie;

    /**
     * @var string
     *
     * @ORM\Column(name="barcode", type="string", length=255)
     * @JMS\Expose
     */
    private $barcode;

    /**
     * @var string
     *
     * @ORM\Column(name="pic", type="string", length=255)
     * @JMS\Expose
     */
    private $pic;

    /**
     * @var string
     *
     * @ORM\Column(name="buy", type="string", length=255)
     * @JMS\Expose
     */
    private $buy;

    /**
     * @var string
     *
     * @ORM\Column(name="sale", type="string", length=255)
     * @JMS\Expose
     */
    private $sale;
    
    /**
     * @ORM\ManyToOne(targetEntity="Admin", inversedBy="commodities")
     * @ORM\JoinColumn(name="admin_id", referencedColumnName="id")
     */
    private $Admin;


    
    /**
     * @ORM\OneToMany(targetEntity="orders", mappedBy="commodity")
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
     * @return commodity
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
     * Set count
     *
     * @param string $count
     *
     * @return commodity
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set fie
     *
     * @param string $fie
     *
     * @return commodity
     */
    public function setFie($fie)
    {
        $this->fie = $fie;

        return $this;
    }

    /**
     * Get fie
     *
     * @return string
     */
    public function getFie()
    {
        return $this->fie;
    }

    /**
     * Set barcode
     *
     * @param string $barcode
     *
     * @return commodity
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;

        return $this;
    }

    /**
     * Get barcode
     *
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * Set pic
     *
     * @param string $pic
     *
     * @return commodity
     */
    public function setPic($pic)
    {
        $this->pic = $pic;

        return $this;
    }

    /**
     * Get pic
     *
     * @return string
     */
    public function getPic()
    {
        return $this->pic;
    }

    /**
     * Set buy
     *
     * @param string $buy
     *
     * @return commodity
     */
    public function setBuy($buy)
    {
        $this->buy = $buy;

        return $this;
    }

    /**
     * Get buy
     *
     * @return string
     */
    public function getBuy()
    {
        return $this->buy;
    }

    /**
     * Set sale
     *
     * @param string $sale
     *
     * @return commodity
     */
    public function setSale($sale)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return string
     */
    public function getSale()
    {
        return $this->sale;
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
}

