<?php
// src/GotChosen/BlogBundle/Repository/PostingRepository.php
namespace GotChosen\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostingRepository extends EntityRepository
{
    public function findAllOrderedByTitle()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT posting FROM GotChosenBlogBundle:Posting posting 
                    ORDER BY posting.postingTitle ASC'
            )
            ->getResult();
    }
    
    public function findAllOrderedByDate()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT posting FROM GotChosenBlogBundle:Posting posting 
                    ORDER BY posting.createdAt DESC'
            )
            ->getResult();
    }
    
}