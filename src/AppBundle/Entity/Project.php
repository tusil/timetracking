<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 */
class Project
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
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="projects")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_billed", type="boolean")
     */
    private $isBilled = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_grouped", type="boolean")
     */
    private $isGrouped = false;

    /**
     * @var string
     *
     * @ORM\Column(name="group_name", type="string", length=255, nullable=true)
     */
    private $groupName;

    /**
     * @var string
     *
     * @ORM\Column(name="rate", type="string", length=255)
     */
    private $rate;

    /**
     * @var int
     *
     * @ORM\Column(name="min_hours", type="integer", nullable=true)
     */
    private $minHours;
    
    /**
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="project")
     */
    private $entries; 
    
    public function __toString()
    {
      return $this->getClient().' | '.$this->getName();
    }       

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
     * Set name
     *
     * @param string $name
     *
     * @return Project
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
     * Set isBilled
     *
     * @param boolean $isBilled
     *
     * @return Project
     */
    public function setIsBilled($isBilled)
    {
        $this->isBilled = $isBilled;

        return $this;
    }

    /**
     * Get isBilled
     *
     * @return boolean
     */
    public function getIsBilled()
    {
        return $this->isBilled;
    }

    /**
     * Set isGrouped
     *
     * @param boolean $isGrouped
     *
     * @return Project
     */
    public function setIsGrouped($isGrouped)
    {
        $this->isGrouped = $isGrouped;

        return $this;
    }

    /**
     * Get isGrouped
     *
     * @return boolean
     */
    public function getIsGrouped()
    {
        return $this->isGrouped;
    }

    /**
     * Set groupName
     *
     * @param string $groupName
     *
     * @return Project
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;

        return $this;
    }

    /**
     * Get groupName
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * Set rate
     *
     * @param string $rate
     *
     * @return Project
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set minHours
     *
     * @param integer $minHours
     *
     * @return Project
     */
    public function setMinHours($minHours)
    {
        $this->minHours = $minHours;

        return $this;
    }

    /**
     * Get minHours
     *
     * @return integer
     */
    public function getMinHours()
    {
        return $this->minHours;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Project
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->entries = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add entry
     *
     * @param \AppBundle\Entity\Entry $entry
     *
     * @return Project
     */
    public function addEntry(\AppBundle\Entity\Entry $entry)
    {
        $this->entries[] = $entry;

        return $this;
    }

    /**
     * Remove entry
     *
     * @param \AppBundle\Entity\Entry $entry
     */
    public function removeEntry(\AppBundle\Entity\Entry $entry)
    {
        $this->entries->removeElement($entry);
    }

    /**
     * Get entries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEntries()
    {
        return $this->entries;
    }
}
