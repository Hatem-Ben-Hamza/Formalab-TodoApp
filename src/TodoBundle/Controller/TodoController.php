<?php

namespace TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TodoBundle\Entity\Todo;

class TodoController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $todos = $em->getRepository('TodoBundle:Todo')->findAll();

        return $this->render('TodoBundle:Todo:index.html.twig',array(
            'todos' => $todos
        ));
    }

    public function createAction()
    {
        /* 1) déclaration de l'entité manager */
        $em = $this->getDoctrine()->getEntityManager();
        
        /* création de l'instance Todo et remplissage des champs */
        $todo = new Todo();
        $todo->setName('House cleaning');
        $todo->setDescription('...');
        $todo->setPriority('High');
        $todo->setDueDate(new\DateTime('2018/11/28'));
        $todo->setCreatedDate(new\DateTime('now'));

        /*Préparation du doctrine et sauvegarde de la nouvelle Todo dans la base de données */
        $em->persist($todo);
        $em->flush();


        return $this->render('TodoBundle:Todo:create.html.twig');
    }

    public function updateAction($id)
    {
        return $this->render('TodoBundle:Todo:update.html.twig');
    }

    public function deleteAction($id)
    {
         /* 1) déclaration de l'entité manager */
         $em = $this->getDoctrine()->getEntityManager();
         
         /* appel de l'instance Todo auquel on veut la supprimer /*
         /* NB: L'appel peut se faire à travers 
          ->find() 
          ->findByName() , findByDescription() ...
          ->find(array(
              'id' => 4,
               'name' => House cleaning 
                ....,
                .....
          ));
          */
         $todo = $em->getRepository('TodoBundle:Todo')->find(5);
        /* 5 est un exemple ensuite ce sera $id dynamiquement*/
        
         /*Préparation du doctrine et supression de Todo de la base de données */
        $em->remove($todo);
        $em->flush();

        return $this->render('TodoBundle:Todo:delete.html.twig');
    }
}
