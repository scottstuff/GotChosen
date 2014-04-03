<?php

namespace GotChosen\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//use \Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


use GotChosen\BlogBundle\Entity\Author;
use GotChosen\BlogBundle\Entity\AuthorManager;
use GotChosen\BlogBundle\Form\Type\AuthorType;
use GotChosen\BlogBundle\Entity\Posting;
use GotChosen\BlogBundle\Form\Type\PostingType;
use GotChosen\BlogBundle\Entity\Tagging;


class AdminController extends Controller
{
    
    /**
     * @Route("/loginold")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('GotChosenBlogBundle:Admin:index.html.twig');
    }
            
    /**
     * @Route("/list_all", name="list_all")
     * @Template()
     */
    public function list_allAction()
    {
        
        $userRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Author');
        $users = $userRepository->findAllOrderedByName();

        if (!$users) {
            throw $this->createNotFoundException(
                'No Authors found'
            );
        }

//        exit(\Doctrine\Common\Util\Debug::dump($posting));
        
//        $posting = array('id' => 1, 'post_title' => 'Posting 1',
//            'post_body' => 'This is the first post!', 
//            'created_at' => '04/01/2014 11:14 AM', );
//        return $this->render('GotChosenBlogBundle:Default:one_post_view.html.twig',
//                array('posting' => $posting));
//        return $this->render('GotChosenBlogBundle:Admin:user_view.html.twig',
//                array('user' => $users));

//        $users = array(
//            array('id' => 1, 'first_name' => 'Bob', 'last_name' => 'Smith'),
//            array('id' => 2, 'first_name' => 'Sally', 'last_name' => 'Clark'),
//            array('id' => 3, 'first_name' => 'Sara', 'last_name' => 'Richards'),
//                );
        
        $postings = array(
            array('id' => 1, 'post_title' => 'Posting 1', 'created_at' => '04/01/2014 11:14 AM'),
            array('id' => 2, 'post_title' => 'Posting 2', 'created_at' => '04/01/2014 11:41 AM'),
            array('id' => 3, 'post_title' => 'Posting 133', 'created_at' => '04/01/2014 12:13 PM'),
                );
        
        $taggings = array(
            array('id' => 1, 'name' => 'Funny', 'description' => 'Funny and LOL'),
            array('id' => 2, 'name' => 'Sad', 'description' => 'Sad Posting'),
            array('id' => 3, 'name' => 'Must', 'description' => 'Must Read'),
                );
        
        return $this->render('GotChosenBlogBundle:Admin:list_all.html.twig',
                array('users' => $users, 'postings' => $postings, 'taggings' => $taggings));
    }
            
    /**
     * @Route("/user_view")
     * @Template()
     */
    public function user_viewAction()
    {
        return $this->render('GotChosenBlogBundle:Admin:user_view.html.twig');
    }
    
    /**
     * @Route("/add_user", name="add_user")
     * @Template()
     */
    public function add_userAction(Request $request)
    {
        $user = $this->getAuthorManager()->createAuthor();

//        $user = new Author();
//        $user->setFirstName('do');
        
        $form = $this->createForm(new AuthorType(), $user, array(
            'action' => $this->generateUrl('add_user'),
            'method' => 'POST',
        ));
        
        if ('POST' === $request->getMethod()) {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->getAuthorManager()->saveAuthor($user);

               return $this->forward('GotChosenBlogBundle:Admin:author_success',
                       array( 'user' => $user));
            }
        }
        
//        if ($form->isValid()) {
            
//           exit('form is valid');
//           return $this->forward('GotChosenBlogBundle:Admin:author_success',
//                   array( 'user' => $user));

//        }
        
        return $this->render('GotChosenBlogBundle:Admin:add_user.html.twig', array(
            'userForm' => $form->createView(),
            ));
        
    }

    /**
     * @Route("/add_posting", name="add_posting")
     * @Template()
     */
    public function add_postingAction(Request $request)
    {
        $posting = new Posting();
//        $posting->setPostingTitle('Wow');
        
        $form = $this->createForm(new PostingType(), $posting, array(
            'action' => $this->generateUrl('add_posting'),
            'method' => 'POST',
        ));
        
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            
//           exit('form is valid');
           return $this->forward('GotChosenBlogBundle:Admin:success',
                   array( 'posting' => $posting, 'record_type' => 'Posting', 'record_action' => 'added'));

        }
        
        return $this->render('GotChosenBlogBundle:Admin:add_posting.html.twig', array(
            'postForm' => $form->createView(),
            ));
        
    }

    /**
     * @Route("/posting_view")
     * @Template()
     */
    public function posting_viewAction()
    {
        return $this->render('GotChosenBlogBundle:Admin:posting_view.html.twig');
    }
    
     /**
     * @Route("/tagging_view")
     * @Template()
     */
    public function tagging_viewAction()
    {
        return $this->render('GotChosenBlogBundle:Admin:tagging_view.html.twig');
    }
            
     /**
     * @Route("/autor_success", name="author_success")
     * @Method({"POST"})
     * @Template()
     */
    public function author_successAction($user)
    {
        
        
        $message2 = $user->getFirstName();
        return $this->render('GotChosenBlogBundle:Admin:success.html.twig',
                array('message1' => 'Author was successfully added!', 'message2' => $message2));
    }
    
    /**
     * @return AuthorManager
     */
    protected function getAuthorManager()
    {
       return $this->container->get('getchosen.blog.manager.author');
    }
}
