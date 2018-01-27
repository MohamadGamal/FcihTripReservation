<?php namespace Own\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 *  @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 **/
class User
{
    /** @ORM\Id 
     * @ORM\Column(type="integer")
     *  @ORM\GeneratedValue **/
    protected $id;

    /** @ORM\Column(type="string",length=50) **/
    protected $name;
    /** @ORM\Column(type="string",unique=true,length=50)
     **/
    protected $email;
    /** @ORM\Column(type="string")
     **/
    protected $password;
    /** @ORM\Column(type="datetime", name="created_at") */
    private $createdAt;
    /** @ORM\Column(type="datetime", name="updated_at") */
    private $updatedAt;
     /**
     * @ORM\ManyToMany(targetEntity="Trip", inversedBy="users")
     * @ORM\JoinTable(name="users_trips")
     */
    protected $trips;
    
    public function __construct()
    {
        $this->trips = new ArrayCollection();  
       
    }
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
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

	public function getTrips(){
		return $this->trips;
	}

	public function setTrips($trips){
		$this->trips = $trips;
    }
    public function addTrip($trip){

        $this->trips->add($trip);
    }
    public function removeTrip($trip){

        $this->trips->removeElement($trip);
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
