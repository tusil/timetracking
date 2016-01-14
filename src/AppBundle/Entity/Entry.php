<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entry
 *
 * @ORM\Table(name="entry")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EntryRepository")
 */
class Entry
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
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="entries")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    private $project;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="entries")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;        

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="issued_at", type="date")
     */
    private $issuedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var float
     *
     * @ORM\Column(name="hours", type="float")
     */
    private $hours;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_paid", type="boolean")
     */
    private $isPaid = true;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Entry
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set hours
     *
     * @param float $hours
     *
     * @return Entry
     */
    public function setHours($hours)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours
     *
     * @return float
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Entry
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isPaid
     *
     * @param boolean $isPaid
     *
     * @return Entry
     */
    public function setIsPaid($isPaid)
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    /**
     * Get isPaid
     *
     * @return bool
     */
    public function getIsPaid()
    {
        return $this->isPaid;
    }

    /**
     * Set issuedAt
     *
     * @param \DateTime $issuedAt
     *
     * @return Entry
     */
    public function setIssuedAt($issuedAt)
    {
        $this->issuedAt = $issuedAt;

        return $this;
    }

    /**
     * Get issuedAt
     *
     * @return \DateTime
     */
    public function getIssuedAt()
    {
        return $this->issuedAt;
    }

    /**
     * Set project
     *
     * @param \AppBundle\Entity\Project $project
     *
     * @return Entry
     */
    public function setProject(\AppBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \AppBundle\Entity\Project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Entry
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
