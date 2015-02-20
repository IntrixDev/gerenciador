<?php

namespace Intrix\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Intrix\BackendBundle\Entity\ProdutoRepository;

class MovimentacaoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('produto', 'entity', array(
                    'empty_value' => 'Selecione...',
                    'class' => 'BackendBundle:Produto',
                    'property' => 'nome',
                    'query_builder' => function(ProdutoRepository $er) {
                        return $er->getAllAtivos();
                    },
                    'attr' => array(
                        'placeholder' => 'Escolha um produto...',
                        'class' => 'produto_preco',
                        'tabindex' => '2'
                    ),
                    'label' => 'Produto',
                ))
                ->add('valor', 'money', array(
                    'attr' => array('class' => 'form-control preco'),
                    'label' => 'Valor',
                    'currency' => 'BRL',
                    'grouping' => true
                ))
                ->add('descricao', 'textarea', array(
                    'label' => 'Observação',
                    'attr' => array(
                        'rows' => '5',
                        'cols' => '5',
                        'class' => 'form-control'
                    )
                ))
                ->add('tipo', 'choice', array(
                    'attr' => array(
                        'data-placeholder' => 'Escolha...',
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Status',
                    'choices' => array(
                        '0' => 'Escolha...',
                        '1' => 'Entrada',
                        '2' => 'Saída',
                        '3' => 'Serviço',
                    )
                ))
                ->add('descricao', 'textarea', array(
                    'label' => 'Observação',
                    'attr' => array(
                        'rows' => '5',
                        'cols' => '5',
                        'class' => 'form-control'
                    )
        ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Intrix\BackendBundle\Entity\Movimentacao',
            'attr' => array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'titulo' => 'Movimentação'
            ),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'intrix_backendbundle_movimentacao';
    }

}
