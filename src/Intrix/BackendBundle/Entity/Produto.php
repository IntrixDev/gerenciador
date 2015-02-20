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
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(type="string", columnDefinition="ENUM('1', '2', '3')", options={"comment" = "1 = Em estoque, 2 = Em falta, 3 = Inativo"})
     * 
     */
    private $status;

    /**
     * @var float $preco
     *
     * @ORM\Column(type="float")
     * 
     */
    private $preco;

    /**
     *
     * @var text
     * @ORM\Column(type="text")
     * 
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="Movimentacao", mappedBy="produto")
     */
    private $movimentacoes;

    /**
     * Constructor
     */
    public function __construct() {
        $this->movimentacoes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set preco
     *
     * @param float $preco
     * @return Produto
     */
    public function setPreco($preco) {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Get preco
     *
     * @return float 
     */
    public function getPreco() {
        return $this->preco;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return Produto
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

    public function getStatusFormated() {
        switch ($this->status) {
            case '1':
                return 'Em estoque';
            case '2':
                return 'Em falta';
            case '3':
                return 'Inativo';
            default :
                return $this->status;
        }
    }

    /**
     * Add movimentacoes
     *
     * @param \Intrix\BackendBundle\Entity\Movimentacao $movimentacoes
     * @return Produto
     */
    public function addMovimentaco(\Intrix\BackendBundle\Entity\Movimentacao $movimentacoes) {
        $this->movimentacoes[] = $movimentacoes;

        return $this;
    }

    /**
     * Remove movimentacoes
     *
     * @param \Intrix\BackendBundle\Entity\Movimentacao $movimentacoes
     */
    public function removeMovimentaco(\Intrix\BackendBundle\Entity\Movimentacao $movimentacoes) {
        $this->movimentacoes->removeElement($movimentacoes);
    }

    /**
     * Get movimentacoes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMovimentacoes() {
        return $this->movimentacoes;
    }

    public function __toString() {
        return $this->nome;
    }

}
