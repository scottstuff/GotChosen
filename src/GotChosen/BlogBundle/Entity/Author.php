<?php
// src/GotChosen/BlogBundle/Entity/Author.php
namespace GotChosen\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="GotChosen\BlogBundle\Repository\AuthorRepository")
 * @ORM\Table(name="author")
 */
class Author
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Posting", mappedBy="poster")
     */
    protected $postings;
    
    /**
     * @ORM\Column(name="first_name", type="string", length=100)
     */
    protected $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", length=100)
     */
    protected $lastName;
    

    /**
     * @ORM\Column(name="user_type", type="string", length=100)
     */
    protected $userType;

    /**
     * @ORM\Column(name="user_name", type="string", length=100)
     */
    protected $userName;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $password;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return Author
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * @return Author
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * @return Author
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getUserType()
    {
        return $this->userType;
    }
    
    /**
     * @return Author
     */
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }
    
    /**
     * @return Author
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @return Author
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->postings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add postings
     *
     * @param \GotChosen\BlogBundle\Entity\Posting $postings
     * @return Author
     */
    public function addPosting(\GotChosen\BlogBundle\Entity\Posting $postings)
    {
        $this->postings[] = $postings;

        return $this;
    }

    /**
     * Remove postings
     *
     * @param \GotChosen\BlogBundle\Entity\Posting $postings
     */
    public function removePosting(\GotChosen\BlogBundle\Entity\Posting $postings)
    {
        $this->postings->removeElement($postings);
    }

    /**
     * Get postings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostings()
    {
        return $this->postings;
    }

    public function getFullName() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }   
}

