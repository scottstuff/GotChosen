<?php
// src/GotChosen/BlogBundle/Entity/AuthorManager.php
namespace GotChosen\BlogBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class AuthorManager
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
     * @return Author
     */
    public function createAuthor()
    {
        $class = $this->class;
        $author = new $class();

        return $author;
    }

    public function saveAuthor(Author $author)
    {

        $this->em->persist($author);
        $this->em->flush();

    }

    /**
    * @return Author
    */
    public function find($id)
    {
       return $this->repo->find($id);
    }
}
