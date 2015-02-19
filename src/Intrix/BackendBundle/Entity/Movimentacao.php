<?php

namespace Intrix\BackendBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Movimentacao
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Intrix\BackendBundle\Entity\MovimentacaoRepository")
 */
class Movimentacao {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="operacao", type="integer")
     */
    private $operacao;

    /**
     * @ORM\OneToOne(targetEntity="Produto", inversedBy="movimentacao")
     * @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     * */
    private $produto;

    /**
     * @var float
     * @Assert\Currency
     * @ORM\Column(name="valor", type="float")
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="forma_pagamento", type="integer")
     */
    private $formaPagamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="vezes", type="integer")
     */
    private $vezes;

    /**
     * @var string
     *
     * @ORM\Column(name="observacao", type="string", length=500)
     */
    private $observacao;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set operacao
     *
     * @param integer $operacao
     * @return Movimentacao
     */
    public function setOperacao($operacao) {
        $this->operacao = $operacao;

        return $this;
    }

    /**
     * Get operacao
     *
     * @return integer 
     */
    public function getOperacao() {
        switch ($this->operacao) {
            case 1:
                return 'Vendas';
                break;
            case 2:
                return 'Serviço';
                break;
            case 3:
                return 'Saída em dinheiro';
                break;
            case 4:
                return 'Saída em serviços';
                break;
            case 5:
                return 'Compra de produto';
                break;
        }
    }

    /**
     * Set valor
     *
     * @param float $valor
     * @return Movimentacao
     */
    public function setValor($valor) {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor() {
        return $this->valor;
    }

    /**
     * Set formaPagamento
     *
     * @param integer $formaPagamento
     * @return Movimentacao
     */
    public function setFormaPagamento($formaPagamento) {
        $this->formaPagamento = $formaPagamento;

        return $this;
    }

    /**
     * Get formaPagamento
     *
     * @return integer 
     */
    public function getFormaPagamento() {

        switch ($this->formaPagamento) {
            case 1:
                return 'Dinheiro';
                break;
            case 2:
                return 'Cheque';
                break;
            case 3:
                return 'Cartão de débito';
                break;
            case 4:
                return 'Cartão de Crédito';
                break;
        }
    }

    /**
     * Set vezes
     *
     * @param integer $vezes
     * @return Movimentacao
     */
    public function setVezes($vezes) {
        $this->vezes = $vezes;

        return $this;
    }

    /**
     * Get vezes
     *
     * @return integer 
     */
    public function getVezes() {
        return $this->vezes;
    }

    /**
     * Set observacao
     *
     * @param string $observacao
     * @return Movimentacao
     */
    public function setObservacao($observacao) {
        $this->observacao = $observacao;

        return $this;
    }

    /**
     * Get observacao
     *
     * @return string 
     */
    public function getObservacao() {
        return $this->observacao;
    }

    /**
     * Set produto
     *
     * @param \Intrix\BackendBundle\Entity\Produto $produto
     * @return Movimentacao
     */
    public function setProduto(\Intrix\BackendBundle\Entity\Produto $produto = null) {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto
     *
     * @return \Intrix\BackendBundle\Entity\Produto 
     */
    public function getProduto() {
        return $this->produto;
    }

}
