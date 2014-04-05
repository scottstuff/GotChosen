<?php
// src/GotChosen/BlogBundle/Entity/PostingManager.php
namespace GotChosen\BlogBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class PostingManager
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
     * @return Posting
     */
    public function createPosting()
    {
        $class = $this->class;
        $posting = new $class();

        return $posting;
    }

    public function savePosting(Author $author, Posting $posting)
    {

        $posting->setPoster($author);
        $this->em->persist($posting);
        $this->em->flush();

    }

    /**
    * @return Posting
    */
    public function find($id)
    {
       return $this->repo->find($id);
    }

}
