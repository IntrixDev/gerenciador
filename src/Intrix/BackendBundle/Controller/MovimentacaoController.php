<?php

namespace Intrix\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Intrix\BackendBundle\Entity\Movimentacao;
use Intrix\BackendBundle\Form\MovimentacaoType;

/**
 * Movimentacao controller.
 *
 */
class MovimentacaoController extends Controller
{

    /**
     * Lists all Movimentacao entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BackendBundle:Movimentacao')->findAll();

        return $this->render('BackendBundle:Movimentacao:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Movimentacao entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Movimentacao();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_movimentacao_show', array('id' => $entity->getId())));
        }

        return $this->render('BackendBundle:Movimentacao:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Movimentacao entity.
     *
     * @param Movimentacao $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Movimentacao $entity)
    {
        $form = $this->createForm(new MovimentacaoType(), $entity, array(
            'action' => $this->generateUrl('movimentacao_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Movimentacao entity.
     *
     */
    public function newAction()
    {
        $entity = new Movimentacao();
        $form   = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Movimentacao:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Movimentacao entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Movimentacao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movimentacao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Movimentacao:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Movimentacao entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Movimentacao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movimentacao entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BackendBundle:Movimentacao:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Movimentacao entity.
    *
    * @param Movimentacao $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Movimentacao $entity)
    {
        $form = $this->createForm(new MovimentacaoType(), $entity, array(
            'action' => $this->generateUrl('post_movimentacao_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Movimentacao entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Movimentacao')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movimentacao entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('post_movimentacao_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Movimentacao:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Movimentacao entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BackendBundle:Movimentacao')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Movimentacao entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post_movimentacao'));
    }

    /**
     * Creates a form to delete a Movimentacao entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_movimentacao_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
