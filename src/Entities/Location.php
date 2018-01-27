<?php namespace Own\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 *  @ORM\Table(name="locations")
 * @ORM\HasLifecycleCallbacks()
 **/
class Location
{
    /** @ORM\Id 
     * @ORM\Column(type="integer")
     *  @ORM\GeneratedValue **/
    protected $id;

    /** @ORM\OneToMany(targetEntity="Trip", mappedBy="from") **/
    protected $froms;

    /**  @ORM\OneToMany(targetEntity="Trip", mappedBy="to") **/
    protected $tos;
      /** @ORM\Column(type="string",unique=true) */
      private $name;
    /** @ORM\Column(type="datetime", name="created_at") */
    private $createdAt;
    /** @ORM\Column(type="datetime", name="updated_at") */
    private $updatedAt;

    
    public function __construct()
    {
        $this->froms = new ArrayCollection();  
        $this->tos = new ArrayCollection();  
    }

    public function getId()
    {
        return $this->id;
    }
    public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

    public function getFroms(){
		return $this->froms;
	}

	public function getTos(){
		return $this->tos;
	}


	public function getCreatedAt(){
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt){
		$this->createdAt = $createdAt;
	}

	public function getUpdatedAt(){
		return $this->updatedAt;
	}

	public function setUpdatedAt($updatedAt){
		$this->updatedAt = $updatedAt;
	}

    /**
     * 
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->setCreatedAt( new \DateTime("now"));
        $this->setUpdatedAt( new \DateTime("now"));
    }
    /** 
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->setUpdatedAt( new \DateTime("now"));
    }

}