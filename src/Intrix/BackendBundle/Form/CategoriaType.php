<?php

namespace Intrix\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriaType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nome', 'text', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Categoria',
                ))
                ->add('status', 'choice', array(
                    'attr' => array(
                        'data-placeholder' => 'Escolha...',
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Status',
                    'choices' => array(
                        '' => 'Selecione...',
                        '0' => 'Inativo',
                        '1' => 'Ativo',
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
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Intrix\BackendBundle\Entity\Categoria',
            'attr' => array(
                'class' => 'form-horizontal',
                'role' => 'form',
                'titulo' => 'Categoria'
            ),
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'intrix_backendbundle_categoria';
    }

}
