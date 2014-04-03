<?php
// src/GotChosen/BlogBundle/Entity/Author.php
namespace GotChosen\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tagging")
 */
class Tagging
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="tag_name", type="string", length=100)
     */
    protected $tagName;

    /**
     * @ORM\Column(name="tag_description", type="string", length=100)
     */
    protected $tagDescription;
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return Tagging
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getTagtName()
    {
        return $this->tagName;
    }
    
    /**
     * @return Tagging
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }
    
    /**
     * @return string
     */
    public function getTagDescription()
    {
        return $this->tagDescription;
    }
    
    /**
     * @return Tagging
     */
    public function setTagDescription($tagDescription)
    {
        $this->tagDescription = $tagDescription;

        return $this;
    }
    
}