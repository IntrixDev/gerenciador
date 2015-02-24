<?php

namespace Intrix\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Intrix\BackendBundle\Entity\CategoriaRepository")
 */
class Categoria {

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
     * @ORM\Column(type="string", columnDefinition="ENUM('0', '1')", options={"comment" = "0 = Inativo, 1 = Ativo"})
     * 
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="Produto", mappedBy="categoria")
     */
    private $produtos;

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
     * @return Categoria
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
     * Set descricao
     *
     * @param string $descricao
     * @return Categoria
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
     * Constructor
     */
    public function __construct() {
        $this->produtos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add produtos
     *
     * @param \Intrix\BackendBundle\Entity\Produto $produtos
     * @return Categoria
     */
    public function addProduto(\Intrix\BackendBundle\Entity\Produto $produtos) {
        $this->produtos[] = $produtos;

        return $this;
    }

    /**
     * Remove produtos
     *
     * @param \Intrix\BackendBundle\Entity\Produto $produtos
     */
    public function removeProduto(\Intrix\BackendBundle\Entity\Produto $produtos) {
        $this->produtos->removeElement($produtos);
    }

    /**
     * Get produtos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProdutos() {
        return $this->produtos;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Categoria
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

    public function getStatusFormated() {
        switch ($this->status) {
            case '0':
                return 'Inativo';
            case '1':
                return 'Ativo';
            default :
                return $this->status;
        }
    }

}
