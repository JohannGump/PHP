<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\PhpBridgeSessionStorage;



class AppController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('AppBundle:Article')->findAll();

        var_dump($articles);

        return $this->render('app/home.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/article/{id}", name="article_display")
     */
    public function displayAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('AppBundle:Article')->find($id);

        return $this->render('app/article.html.twig', ['article' => $article]);
    }

    /**
     * @Route("/delete/{id}", name="article_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('AppBundle:Article')->find($id);

        $em->remove($article);

        $em->flush();

        $this->addFlash('success', "L'article " . $id . " a bien été supprimé");

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/creationArticle", name="article_creation")
     */
    public function createAction(Request $request)
    {
        $article = new Article();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $article);
        // ajout des champs du formulaire
        $formBuilder->add('nom');
        $formBuilder->add('description');
        $formBuilder->add('prix');
        $formBuilder->add('stock');
        $formBuilder->add('valider', SubmitType::class);
        $article->setCreatedAt(new \DateTime());

        //on récupère l'objet form
        $form = $formBuilder->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                $this->addFlash('success', "l'article a bien été ajouté");
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('app/creationArticle.html.twig', ['formArticle' => $form->createView()]);
    }

    /**
     * @Route("/creationUtilisateur", name="utilisateur_creation")
     */
    public function createUerAction(Request $request)
    {
        $utilisateur = new Utilisateur();
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $utilisateur);
        // ajout des champs du formulaire
        $formBuilder->add('email');
        $formBuilder->add('nom');
        $formBuilder->add('prenom');
        $formBuilder->add('codePostal');
        $formBuilder->add('telephone');
        $formBuilder->add('username');
        $formBuilder->add('password');
        $formBuilder->add('valider', SubmitType::class);
        $utilisateur->setCreatedAt(new \DateTime());

        //on récupère l'objet form
        $form = $formBuilder->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($utilisateur);
                $em->flush();
                $this->addFlash('success', "l'utilisateur a bien été ajouté");
                return $this->redirectToRoute('homepage');
            }
        }

        return $this->render('app/creationUtilisateur.html.twig', ['formUser' => $form->createView()]);
    }

    /**
     * @Route("/ajoutPanier/{id}", name="ajout_panier")
     */
    public function ajoutAction(Request $request, $id)
    {
       // ini_set('session.save_handler', 'files');
       // ini_set('session.save_path', '/tmp');

        $session = new Session(new PhpBridgeSessionStorage());

        $session->start();

        $em = $this->getDoctrine()->getManager();

        $article = $em->getRepository('AppBundle:Article')->find($id);

        //set and get session attributes
        $session->set('nom',$article->getNom());
        $session->set('createdAt',$article->getCreatedAt());
        $session->set('description',$article->getDescription());
        $session->set('prix',$article->getPrix());
        $session->set('stock',$article->getStock());

        $commande[] = $session->get('nom');
        array_push($commande, $session->get('createdAt'));
        array_push($commande, $session->get('description'));
        array_push($commande, $session->get('prix'));
        array_push($commande, $session->get('stock'));

        var_dump($session);

        //return $this->redirectToRoute('homepage');
    }


}
