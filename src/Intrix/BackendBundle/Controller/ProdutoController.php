<?php

namespace Intrix\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Intrix\BackendBundle\Entity\Produto;
use Intrix\BackendBundle\Form\ProdutoType;

/**
 * Produto controller.
 *
 */
class ProdutoController extends Controller {

    /**
     * Lists all Produto entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository('BackendBundle:Produto')->findAll();

        return $this->render('BackendBundle:Produto:index.html.twig', array(
                    'entities' => $produtos,
        ));
    }

    /**
     * Displays a form to create a new Produto entity.
     *
     */
    public function newAction() {
        $entity = new Produto();
        $form = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Produto:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Produto entity.
     *
     * @param Produto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Produto $entity) {
        $form = $this->createForm(new ProdutoType(), $entity, array(
            'action' => $this->generateUrl('produto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a new Produto entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Produto();
        $form = $this->createCreateForm($entity);
        $request = $this->savePreco($request);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                    'notice', 'Produto salvo com sucesso!'
            );
            return $this->redirect($this->generateUrl('produto_new'));
        }

        return $this->render('BackendBundle:Produto:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Produto entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Produto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse produto.');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('BackendBundle:Produto:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Produto entity.
     *
     * @param Produto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Produto $entity) {
        $form = $this->createForm(new ProdutoType(), $entity, array(
            'action' => $this->generateUrl('produto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Produto entity.
     *
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BackendBundle:Produto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Não foi possivel encontrar esse produto.');
        }

        $editForm = $this->createEditForm($entity);
        $request = $this->savePreco($request);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                    'notice', 'Produto salvo com sucesso!'
            );
            return $this->redirect($this->generateUrl('produto_edit', array('id' => $id)));
        }

        return $this->render('BackendBundle:Produto:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    private function savePreco($request) {
        $aSave = array('', '.');
        $aMask = array('.', ',');
        $aPost = $request->request->all();
        $aPost['intrix_backendbundle_produto']['preco'] = str_replace($aMask, $aSave, $aPost['intrix_backendbundle_produto']['preco']);
        $request->request->replace($aPost);

        return $request;
    }

}
