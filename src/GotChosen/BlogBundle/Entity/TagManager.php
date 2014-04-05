<?php
// src/GotChosen/BlogBundle/Entity/TagManager.php
namespace GotChosen\BlogBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class TagManager
{
    /**
     * Holds the Doctrine entity manager for database interaction
     * @var EntityManager 
     */
    protected $em;

    /**
     * Entity-specific repo, useful for finding entities, for example
     * @var EntityRepository
     */
    protected $repo;

    /**
     * The Fully-Qualified Class Name for our entity
     * @var string
     */
    protected $class;

    public function __construct(EntityManager $em, $class)
    {

        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
    
    }

    /**
     * @return Tag
     */
    public function createTag()
    {
        $class = $this->class;
        $tag = new $class();

        return $tag;
    }

    public function saveTag(Tag $tag)
    {

        $this->em->persist($tag);
        $this->em->flush();

    }

    /**
     * @return Tag
     */
    public function find($id)
    {
       return $this->repo->find($id);
    }

}
