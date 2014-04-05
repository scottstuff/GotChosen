<?php

namespace GotChosen\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        return $this->render('GotChosenBlogBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/showMyLog", name="showMyLog")
     * @Template()
     */
    public function showMyLogAction(Request $request)
    {
        return $this->render('GotChosenBlogBundle:Default:my_log.html.twig');
    }
    
    /**
     * @Route("/readme", name="readme")
     * @Template()
     */
    public function showReadmeAction(Request $request)
    {
        return $this->render('GotChosenBlogBundle:Default:readme.html.twig');
    }
    
    /**
     * @Route("/show", name="show")
     * @Template()
     */
    public function showAction(Request $request)
    {
        
        $postingRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Posting');
        $postings = $postingRepository->findAllOrderedByDate();

        if (!$postings) {
            throw $this->createNotFoundException(
                'No Posts found'
            );
        }

        return $this->render('GotChosenBlogBundle:Default:show.html.twig');
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

        return $this->render('GotChosenBlogBundle:Admin:user_view.html.twig',
                array('user' => $posting));
    }
        
    /**
    * Return a ajax response
    * @Route("/show_posts", name="show_posts")
    */
    public function showPostsAction(){
        
        
        $postingRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Posting');
        $postings = $postingRepository->findAllOrderedByDate();

        if (!$postings) {
            throw $this->createNotFoundException(
                'No Posts found'
            );
        }

        $posting_array = array();
        foreach ($postings as $posting) {
            $posting_array[$posting->getId()] = $posting->getPostTitle();
        }
        
        $return = json_encode($posting_array);
        return new Response($return,200,array('Content-Type'=>'application/json'));//make sure it has the correct content type

    } 
    
    /**
     * @Route("/one_post_json/getJSON/{id}", name="one_post")
     * @Template()
     */
    public function showOnePostAction($id)
    {

        $postingRepository = $this->getDoctrine()->getRepository('GotChosenBlogBundle:Posting');
        $posting = $postingRepository->find($id);

        // I did it this way as I could not get the serialization to work
        $posting_array = array();

        $posting_array['id'] = $posting->getId();
        $posting_array['postTitle'] = $posting->getPostTitle();
        $posting_array['postBody'] = $posting->getPostBody();
        $posting_array['createdAt'] = $posting->getCreatedAt();
        $posting_array['poster'] = array('firstName' => $posting->getPoster()->getFirstName(), 'lastName' => $posting->getPoster()->getLastName());
        
        foreach ($posting->getTags() as $tag) {
            $tag_array[] = $tag->getName();
        }

        if (empty($tag_array)) {
            $tag_array[] = 'No Tags' ;
        }
        $posting_array['tags'] = $tag_array;

        $return = json_encode($posting_array);

        return new Response($return,200,array('Content-Type'=>'application/json'));//make sure it has the correct content type

    }

    /**
     * @Route("/one_post_json/{id}", name="one_post_json")
     * @Template()
     */
    public function showOnePostJSONAction($id)
    {
        return $this->render('GotChosenBlogBundle:Default:show_one_post_json.html.twig',
                array('id' => $id));
    }
    

}
