<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * orders
 *
 * @JMS\ExclusionPolicy("All")
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ordersRepository")
 */
class orders {

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="count", type="string", length=255)
     * @JMS\Expose
     */
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity="Marketer", inversedBy="orderss")
     * @ORM\JoinColumn(name="marketer_id", referencedColumnName="id")
     * @JMS\Expose
     */
    private $marketer;

    /**
     * @ORM\ManyToOne(targetEntity="Customer", inversedBy="orderss")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * @JMS\Expose
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="commodity", inversedBy="orderss")
     * @ORM\JoinColumn(name="commodity_id", referencedColumnName="id")
     * @JMS\Expose
     */
    private $commodity;
    
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

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set count
     *
     * @param string $count
     *
     * @return orders
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
     * Set marketer
     *
     * @param \AppBundle\Entity\Marketer $marketer
     *
     * @return orders
     */
    public function setMarketer(\AppBundle\Entity\Marketer $marketer = null)
    {
        $this->marketer = $marketer;

        return $this;
    }

    /**
     * Get marketer
     *
     * @return \AppBundle\Entity\Marketer
     */
    public function getMarketer()
    {
        return $this->marketer;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return orders
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set commodity
     *
     * @param \AppBundle\Entity\commodity $commodity
     *
     * @return orders
     */
    public function setCommodity(\AppBundle\Entity\commodity $commodity = null)
    {
        $this->commodity = $commodity;

        return $this;
    }

    /**
     * Get commodity
     *
     * @return \AppBundle\Entity\commodity
     */
    public function getCommodity()
    {
        return $this->commodity;
    }
}
