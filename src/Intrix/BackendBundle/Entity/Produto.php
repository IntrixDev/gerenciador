<?php

namespace Intrix\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Intrix\BackendBundle\Entity\ProdutoRepository")
 */
class Produto {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", columnDefinition="ENUM('Produto', 'Serviço')")
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", columnDefinition="ENUM('Ativo', 'Inativo', 'Em Estoque', 'Em Falta')")
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="Movimentacao", mappedBy="produto")
     */
    private $movimentacao;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Produto
     */
    public function setNome($nome) {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Produto
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
     * Set status
     *
     * @param string $status
     * @return Produto
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set movimentacao
     *
     * @param \Intrix\BackendBundle\Entity\Movimentacao $movimentacao
     * @return Produto
     */
    public function setMovimentacao(\Intrix\BackendBundle\Entity\Movimentacao $movimentacao = null) {
        $this->movimentacao = $movimentacao;

        return $this;
    }

    /**
     * Get movimentacao
     *
     * @return \Intrix\BackendBundle\Entity\Movimentacao 
     */
    public function getMovimentacao() {
        return $this->movimentacao;
    }

    public function __toString() {
        return $this->nome;
    }

}
