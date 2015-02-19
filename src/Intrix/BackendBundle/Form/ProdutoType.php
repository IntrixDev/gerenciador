<?php

namespace Intrix\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProdutoType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
                ->add('nome', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Produto / Serviço',
                ))
                ->add('tipo', 'choice', array(
                    'attr' => array(
                        'data-placeholder' => 'Escolha...',
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Tipo',
                    'choices' => array(
                        '0' => 'Escolha...',
                        'Produto' => 'Produto',
                        'Serviço' => 'Serviço',
                    )
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
                        'Ativo' => 'Ativo',
                        'Inativo' => 'Inativo',
                        'Em Estoque' => 'Em Estoque',
                        'Em Falta' => 'Em Falta',
                    )
                ))
        ;
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
                'titulo' => 'Produto / Serviço'
            ),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'intrix_backendbundle_produto';
    }

}
