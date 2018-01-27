<?php namespace Own\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 *  @ORM\Table(name="trips")
 * @ORM\HasLifecycleCallbacks()
 **/
class Trip
{
    /** @ORM\Id 
     * @ORM\Column(type="integer")
     *  @ORM\GeneratedValue **/
    protected $id;

    /** @ORM\ManyToOne(targetEntity="Location", inversedBy="froms")**/
    protected $from;

    /** @ORM\ManyToOne(targetEntity="Location", inversedBy="tos")) **/
    protected $to;
      /** @ORM\Column(type="datetime") */
      private $time;
    /** @ORM\Column(type="datetime", name="created_at") */
    private $createdAt;
    /**  @ORM\Column( type="integer", options={"default" : 0}) **/
    protected $seats;
    /** @ORM\Column(type="datetime", name="updated_at") */
    private $updatedAt;
     /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="trips")
     */
    protected $users;
    
    public function __construct()
    {
        $this->users = new ArrayCollection();  
       
    }
    public function getId()
    {
        return $this->id;
    }

    public function getFrom(){
		return $this->from;
	}

	public function setFrom($from){
		$this->from = $from;
	}

	public function getTo(){
		return $this->to;
	}

	public function setTo($to){
		$this->to = $to;
	}
	public function getTime(){
		return $this->time;
	}

	public function setTime($time){
		$this->time = $time;
    }
    
    public function getSeats(){
		return $this->seats;
	}

	public function setSeats($seats){
		$this->seats= $seats;
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

	public function getUsers(){
		return $this->users;
	}

	public function setUsers($user){
		$this->user = $users;
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