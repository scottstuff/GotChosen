<?php
// src/GotChosen/BlogBundle/Entity/Author.php
namespace GotChosen\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posting")
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Entity(repositoryClass="GotChosen\BlogBundle\Repository\PostingRepository")
 */
class Posting
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Author", inversedBy="postings")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $poster;
    
    /**
     * @ORM\Column(name="post_title", type="string", length=100)
     */
    protected $postTitle;

    /**
     * @ORM\Column(name="post_body", type="text")
     */
    protected $postBody;
    
    /** 
     * created Time/Date 
     * @var \DateTime 
     * @ORM\Column(name="created_at", type="datetime", nullable=false) 
     */  
    protected $createdAt;  
  
    /** 
     * updated Time/Date 
     * @var \DateTime 
     * @ORM\Column(name="updated_at", type="datetime", nullable=false) 
     */  
    protected $updatedAt;  

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return Posting
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    /**
     * @return mixed
     */
    public function getPoster()
    {
        return $this->poster;
    }
    
    /**
     * @return Posting
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPostTitle()
    {
        return $this->postTitle;
    }
    
    /**
     * @return Posting
     */
    public function setPostTitle($postTitle)
    {
        $this->postTitle = $postTitle;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getPostBody()
    {
        return $this->postBody;
    }
    
    /**
     * @return Posting
     */
    public function setPostBody($postBody)
    {
        $this->postBody = $postBody;

        return $this;
    }
      
    /** 
     * Set createdAt 
     * 
     * @ORM\PrePersist 
     */  
    public function setCreatedAt()  
    {  
        $this->createdAt = new \DateTime();  
        $this->updatedAt = new \DateTime();  
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
     * Set updatedAt 
     * 
     * @ORM\PreUpdate 
     */  
    public function setUpdatedAt()  
    {  
        $this->updatedAt = new \DateTime();  
    }  
  
    /** 
     * Get updatedAt 
     * 
     * @return \DateTime 
     */  
    public function getUpdatedAt()  
    {  
        return $this->updatedAt;  
    }  

}