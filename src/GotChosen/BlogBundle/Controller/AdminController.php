<?php

namespace GotChosen\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use GotChosen\BlogBundle\Entity\AuthorManager;
use GotChosen\BlogBundle\Form\Type\AuthorType;
use GotChosen\BlogBundle\Form\Type\PostingType;
use GotChosen\BlogBundle\Entity\TagManager;


/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    
    /**
     * @Route("/")
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

        $postingRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Posting');
        $postings = $postingRepository->findAllOrderedByTitle();

        $tagRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Tag');
        $taggings = $tagRepository->findAllOrderedByTagName();

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
        
        return $this->render('GotChosenBlogBundle:Admin:add_user.html.twig', array(
            'userForm' => $form->createView(),
            ));
        
    }

    /**
     * @Route("/add_tagging", name="add_tagging")
     * @Template()
     */
    public function add_taggingAction(Request $request)
    {
        $tagging = $this->getTaggingManager()->createTagging();

        $form = $this->createForm(new TaggingType(), $tagging, array(
            'action' => $this->generateUrl('add_tagging'),
            'method' => 'POST',
        ));
        
        if ('POST' === $request->getMethod()) {

            $form->handleRequest($request);
            if ($form->isValid()) {
                $this->getTaggingManager()->saveTagging($tagging);

               return $this->forward('GotChosenBlogBundle:Admin:tagging_success',
                       array( 'tagging' => $tagging));
            }
        }
        
        return $this->render('GotChosenBlogBundle:Admin:add_tagging.html.twig', array(
            'taggingForm' => $form->createView(),
            ));
        
    }

    /**
     * @Route("/add_posting", name="add_posting")
     * @Template()
     */
    public function add_postingAction(Request $request)
    {

        $posting = $this->getPostingManager()->createPosting();

        $form = $this->createForm(new PostingType(), $posting, array(
            'action' => $this->generateUrl('add_posting'),
            'method' => 'POST',
        ));
        
        if ('POST' === $request->getMethod()) {

            $form->handleRequest($request);
            if ($form->isValid()) {
               
                $author = $this->getAuthorManager()->find($form['poster']->getData());
                $tags = $form['tags']->getData();

                $this->getPostingManager()->savePosting($author, $posting);

               return $this->forward('GotChosenBlogBundle:Admin:posting_success',
                       array( 'posting' => $posting));
            }
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
     * @Route("/author_success", name="author_success")
     * @Method({"POST"})
     * @Template()
     */
    public function author_successAction($user)
    {
        
        $message2 = "Author: " . $user->getFirstName() . ' ' . $user->getLastName() . ' was added.';
        return $this->render('GotChosenBlogBundle:Admin:success.html.twig',
                array('message1' => 'Success!', 
                      'message2' => $message2,
                      'record_type' => 'Posting')
                );
    }
    
     /**
     * @Route("/posting_success", name="posting_success")
     * @Method({"POST"})
     * @Template()
     */
    public function posting_successAction($posting)
    {
        
        $message2 = "Post Title: " . $posting->getPostTitle() . ' was added.';
        return $this->render('GotChosenBlogBundle:Admin:success.html.twig',
                array('message1' => 'Success!', 
                      'message2' => $message2,
                      'record_type' => 'Posting')
                );
    }
    
     /**
     * @Route("/tagging_success", name="tagging_success")
     * @Method({"POST"})
     * @Template()
     */
    public function tagging_successAction($tagging)
    {
        
        $message2 = "Tag Name: " . $tagging->getName() . ' was added.';
        return $this->render('GotChosenBlogBundle:Admin:success.html.twig',
                array('message1' => 'Success!', 
                      'message2' => $message2,
                      'record_type' => 'Tag')
                );
    }
    
    /**
     * @return AuthorManager
     */
    protected function getAuthorManager()
    {
       return $this->container->get('getchosen.blog.manager.author');
    }
    
    /**
     * @return PostingManager
     */
    protected function getPostingManager()
    {
       return $this->container->get('getchosen.blog.manager.posting');
    }

    /**
     * @return TaggingManager
     */
    protected function getTaggingManager()
    {
       return $this->container->get('getchosen.blog.manager.tagging');
    }

    /**
     * @return TagManager
     */
    protected function getTagManager()
    {
       return $this->container->get('getchosen.blog.manager.tag');
    }

}
