<?php

namespace Intrix\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Intrix\BackendBundle\Entity\Categoria;
use Intrix\BackendBundle\Form\CategoriaType;

/**
 * Categoria controller.
 *
 */
class CategoriaController extends Controller {

    /**
     * Lists all Categoria entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BackendBundle:Categoria')->findAll();

        return $this->render('BackendBundle:Categoria:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Displays a form to create a new Categoria entity.
     *
     */
    public function newAction() {
        $entity = new Categoria();
        $form = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Categoria:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Categoria entity.
     *
     * @param Categoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Categoria $entity) {
        $form = $this->createForm(new CategoriaType(), $entity, array(
            'action' => $this->generateUrl('categoria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a new Categoria entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Categoria();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                    'notice', 'Categoria salva com sucesso!'
            );
            return $this->redirect($this->generateUrl('categoria_new'));
        }

        return $this->render('BackendBundle:Categoria:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categoria entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar essa categoria.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BackendBundle:Categoria:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Categoria entity.
     *
     * @param Categoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Categoria $entity) {
        $form = $this->createForm(new CategoriaType(), $entity, array(
            'action' => $this->generateUrl('categoria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Categoria entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar essa categoria.');
        }

        
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                    'notice', 'Produto salvo com sucesso!'
            );
            return $this->redirect($this->generateUrl('categoria_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Categoria:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

}
