<?php

namespace GotChosen\BlogBundle\Controller;

use GotChosen\BlogBundle\Entity\Posting;
use GotChosen\BlogBundle\Form\Type\PostingType;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/splash")
     * @Template()
     */
    public function indexAction()
    {
        
/*        $person = new Author();
        $person->setFirstName('Sally')
            ->setLastName('Jones')
            ->setUserType('Blogger')
            ->setUserName('sjones')
            ->setPassword('sjones');

        $em = $this->getDoctrine()->getManager();
        $em->persist($person);
        $em->flush();

        $postings = array(
            array('id' => 1, 'post_title' => 'Posting 1', 'created_at' => '04/01/2014 11:14 AM'),
            array('id' => 2, 'post_title' => 'Posting 2', 'created_at' => '04/01/2014 11:41 AM'),
            array('id' => 3, 'post_title' => 'Posting 133', 'created_at' => '04/01/2014 12:13 PM'),
                );
 */       
        $postingRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Posting');
        $postings = $postingRepository->findAllOrderedByDate();

        if (!$postings) {
            throw $this->createNotFoundException(
                'No Posts found'
            );
        }


//        $postingRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Posting');
//        $postings = $postingRepository->find(1); /** @var $posting \GotChosen\BlogBundle\Entity\Posting */

//        $postings = $postingRepository->findAll();
//        exit(\Doctrine\Common\Util\Debug::dump($postings->getPoster()->getFirstName()));
//        exit(\Doctrine\Common\Util\Debug::dump($postings));

        return $this->render('GotChosenBlogBundle:Default:index.html.twig', array('postings' => $postings));
    }
    
    /**
     * @Route("/one_post_view")
     * @Template()
     */
    public function one_post_viewAction($id = 1)
    {
        $postingRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Posting');
        $posting = $postingRepository->find($id);

        if (!$posting) {
            throw $this->createNotFoundException(
                'No posting found for id '.$id
            );
        }

//        exit(\Doctrine\Common\Util\Debug::dump($posting));
        
//        $posting = array('id' => 1, 'post_title' => 'Posting 1',
//            'post_body' => 'This is the first post!', 
//            'created_at' => '04/01/2014 11:14 AM', );
//        return $this->render('GotChosenBlogBundle:Default:one_post_view.html.twig',
//                array('posting' => $posting));
        return $this->render('GotChosenBlogBundle:Admin:user_view.html.twig',
                array('user' => $posting));
    }
        
}
