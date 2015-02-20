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
        $aOperacoes = array(
            '0' => 'Selecione...',
            'Entradas' => array(
                '1' => 'Vendas',
                '2' => 'Serviço',
            ),
            'Saídas' => array(
                '3' => 'Saída em dinheiro',
                '4' => 'Saída em serviços',
                '5' => 'Saída para compra de produto',
            )
        );

        $aPagamentos = array(
            '0' => 'Selecione...',
            '1' => 'Dinheiro',
            '2' => 'Cheque',
            'Cartão' => array(
                '3' => 'Débito',
                '4' => 'Crédito',
            )
        );

        $builder
                ->add('operacao', 'choice', array(
                    'attr' => array(
                        'data-placeholder' => 'Escolha a operação...',
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Operação',
                    'choices' => $aOperacoes,
                ))
                ->add('produto', 'entity', array(
                    'empty_value' => 'Selecione...',
                    'class' => 'BackendBundle:Produto',
                    'property' => 'nome',
                    'query_builder' => function(ProdutoRepository $er) {
                        return $er->getAllAtivos();
                    },
                    'attr' => array(
                        'placeholder' => 'Escolha um produto...',
                        'class' => 'minimum-select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Produto / Servico',
                ))
                ->add('valor', 'money', array(
                    'attr' => array('class' => 'form-control'),
                    'label' => 'Valor',
                    'divisor' => 100
                ))
                ->add('formaPagamento', 'choice', array(
                    'attr' => array(
                        'data-placeholder' => 'Escolha a forma de pagamento...',
                        'class' => 'select',
                        'tabindex' => '2'
                    ),
                    'label' => 'Forma de pagamento',
                    'choices' => $aPagamentos,
                ))
                ->add('vezes', 'text', array(
                    'label' => 'Vezes',
                    'attr' => array('class' => 'form-control'))
                )
                //<textarea rows="5" cols="5" class="form-control"></textarea>
                ->add('observacao', 'textarea', array(
                    'label' => 'Observação',
                    'attr' => array(
                        'rows' => '5',
                        'cols' => '5',
                        'class' => 'form-control'
                    )
                ))
        ;
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
                'titulo' => 'Vendas / Serviços / Saídas'
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
