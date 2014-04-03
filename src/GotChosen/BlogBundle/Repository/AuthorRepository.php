<?php
// src/GotChosen/BlogBundle/Repository/AuthorRepository.php
namespace GotChosen\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AuthorRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT user FROM GotChosenBlogBundle:Author user 
                    ORDER BY user.lastName, user.firstName ASC'
            )
            ->getResult();
    }
}