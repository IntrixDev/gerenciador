<?php

namespace Intrix\BackendBundle\Entity;

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
     * @var float $valor
     *
     * @ORM\Column(type="float")
     * 
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $descricao;

    /**
     * @var string $tipo
     *
     * @ORM\Column(type="string", columnDefinition="ENUM('1', '2', '3')", options={"comment" = "1 = Entrada, 2 = Saída, 3 = Serviço"})
     * 
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Produto", inversedBy="movimentacoes")
     * @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     */
    private $produto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="criado_em", type="datetime")
     */
    private $criado_em;

    /**
     * Constructor
     */
    public function __construct() {
        $this->criado_em = new \DateTime("now");
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
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
     * Set descricao
     *
     * @param string $descricao
     * @return Movimentacao
     */
    public function setDescricao($descricao) {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao() {
        return $this->descricao;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Movimentacao
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo() {
        return $this->tipo;
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

    public function getTipoFormated() {
        switch ($this->tipo) {
            case '1':
                return 'Entrada';
            case '2':
                return 'Saída';
            case '3':
                return 'Serviço';
            default :
                return $this->status;
        }
    }


    /**
     * Set criado_em
     *
     * @param \DateTime $criadoEm
     * @return Movimentacao
     */
    public function setCriadoEm(\DateTime $criadoEm)
    {
        $this->criado_em = $criadoEm;
    
        return $this;
    }

    /**
     * Get criado_em
     *
     * @return \DateTime 
     */
    public function getCriadoEm()
    {
        return $this->criado_em;
    }
}
