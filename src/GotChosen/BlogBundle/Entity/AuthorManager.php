<?php
// src/GotChosen/BlogBundle/Entity/AuthorManager.php
namespace GotChosen\BlogBundle\Entity;

//use Doctrine\ORM\Mapping as ORM;
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
        // Even though we have three properties, we only need two constructor arguments...
        $this->em = $em;
        $this->class = $class;
        $this->repo = $em->getRepository($class);
        // ... because we can find the repo using those two
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
//        $author->setFirstName($firstName) setPost($author);
        $this->em->persist($author);
        $this->em->flush();
//        $this->dispatcher->dispatch('foo_bundle.post.comment_added', new CommentEvent($post, $comment));
    }

}
