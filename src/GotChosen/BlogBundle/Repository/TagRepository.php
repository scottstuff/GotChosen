<?php
// src/GotChosen/BlogBundle/Repository/TagRepository.php
namespace GotChosen\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    public function findAllOrderedByTagName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT tag FROM GotChosenBlogBundle:Tag tag 
                    ORDER BY tag.name ASC'
            )
            ->getResult();
    }
        
}