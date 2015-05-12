<?php

namespace Intrix\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Intrix\BackendBundle\Entity\CategoriaRepository;

class ProdutoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('categoria', 'entity', array(
                    'empty_value' => 'Selecione...',
                    'class' => 'BackendBundle:Categoria',
                    'property' => 'nome',
                    'query_builder' => function(CategoriaRepository $er) {
                        return $er->getAllAtivos();
                    },
                    'attr' => array(
                        'placeholder' => 'Escolha uma categoria...',
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Categoria',
                ))
                ->add('nome', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Produto',
                ))
                ->add('preco', 'money', array(
                    'attr' => array('class' => 'form-control preco'),
                    'label' => 'Valor',
                    'currency' => 'BRL',
                    'grouping' => true
                ))
                ->add('status', 'choice', array(
                    'attr' => array(
                        'data-placeholder' => 'Escolha...',
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Status',
                    'choices' => array(
                        '0' => 'Escolha...',
                        '1' => 'Em estoque',
                        '2' => 'Em falta',
                        '3' => 'Inativo',
                    )
                ))
                ->add('descricao', 'textarea', array(
                    'label' => 'Observação',
                    'attr' => array(
                        'rows' => '5',
                        'cols' => '5',
                        'class' => 'form-control'
                    )
                ))
                ->add('codigo', 'hidden');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Intrix\BackendBundle\Entity\Produto',
            'attr' => array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'titulo' => 'Produto'
            ),
            'validation_groups' => array('registro')
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'intrix_backendbundle_produto';
    }

}
