<?php
// src/GotChosen/BlogBundle/Entity/Tag.php
namespace GotChosen\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="GotChosen\BlogBundle\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=100)
     */
    public $name;

    /**
     * @ORM\ManyToMany(targetEntity="Posting", mappedBy="tags")
     **/
    protected $posts;


    /**
     * Collections of postings
     */
    public function __construct() {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return Tag
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }
    
    /**
     * @return Tag
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    
    /**
     * Add posts
     *
     * @param \GotChosen\BlogBundle\Entity\Posting $posts
     * @return Tag
     */
    public function addPosts(\GotChosen\BlogBundle\Entity\Posting $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \GotChosen\BlogBundle\Entity\Posting $posts
     */
    public function removePosts(\GotChosen\BlogBundle\Entity\Posting $posts)
    {
        $this->posts->removeElement($posts);
    }

}