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
class MovimentacaoController extends Controller {

    /**
     * Lists all Movimentacao entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BackendBundle:Movimentacao')->findAll();

        return $this->render('BackendBundle:Movimentacao:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Displays a form to create a new Movimentacao entity.
     *
     */
    public function newAction() {
        $entity = new Movimentacao();
        $form = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Movimentacao:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Movimentacao entity.
     *
     * @param Movimentacao $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Movimentacao $entity) {
        $form = $this->createForm(new MovimentacaoType(), $entity, array(
            'action' => $this->generateUrl('movimentacao_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Creates a new Movimentacao entity.
     *
     */
    public function createAction(Request $request) {
        $entity = new Movimentacao();
        $form = $this->createCreateForm($entity);
        $request = $this->savePreco($request);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add(
                    'notice', 'Movimentação salvo com sucesso!'
            );
            return $this->redirect($this->generateUrl('movimentacao_new'));
        }

        return $this->render('BackendBundle:Movimentacao:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    private function savePreco($request) {
        $aSave = array('', '.');
        $aMask = array('.', ',');
        $aPost = $request->request->all();
        $aPost['intrix_backendbundle_movimentacao']['valor'] = str_replace($aMask, $aSave, $aPost['intrix_backendbundle_movimentacao']['valor']);
        $request->request->replace($aPost);

        return $request;
    }

}
