<?php

namespace Intrix\BackendBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Intrix\BackendBundle\Entity\ProdutoRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Assert\UniqueEntity(fields="nome", message="Esse produto já foi cadastrado.", groups={"registro"})
 * @Assert\UniqueEntity(fields="codigo", message="Ouve um erro ao cadastrar o código do produto.", groups={"registro"})
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
     * @ORM\Column(type="string", length=255, nullable=false, unique=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(type="string", columnDefinition="ENUM('1', '2', '3')", options={"comment" = "1 = Em estoque, 2 = Em falta, 3 = Inativo"}, nullable=false)
     * 
     */
    private $status;

    /**
     * @var float $preco
     *
     * @ORM\Column(type="float", nullable=false)
     * 
     */
    private $preco;

    /**
     *
     * @var text
     * @ORM\Column(type="text", nullable=true)
     * 
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="produtos")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     */
    private $categoria;

    /**
     * @ORM\OneToMany(targetEntity="Venda", mappedBy="produto")
     */
    private $vendas;

    /**
     *
     * @var text
     * @ORM\Column(type="string", nullable=false, unique=true)
     *  
     */
    private $codigo;

    /**
     * Constructor
     */
    public function __construct() {
        $this->vendas = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set categoria
     *
     * @param \Intrix\BackendBundle\Entity\Categoria $categoria
     * @return Produto
     */
    public function setCategoria(\Intrix\BackendBundle\Entity\Categoria $categoria = null) {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Intrix\BackendBundle\Entity\Categoria 
     */
    public function getCategoria() {
        return $this->categoria;
    }

    /**
     * Add vendas
     *
     * @param \Intrix\BackendBundle\Entity\Venda $vendas
     * @return Produto
     */
    public function addVenda(\Intrix\BackendBundle\Entity\Venda $vendas) {
        $this->vendas[] = $vendas;

        return $this;
    }

    /**
     * Remove vendas
     *
     * @param \Intrix\BackendBundle\Entity\Venda $vendas
     */
    public function removeVenda(\Intrix\BackendBundle\Entity\Venda $vendas) {
        $this->vendas->removeElement($vendas);
    }

    /**
     * Get vendas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVendas() {
        return $this->vendas;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Produto
     */
    public function setCodigo($codigo) {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo() {
        return $this->codigo;
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
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function prePersist($em) {
        if (is_null($this->getId())) {
            $categoria = str_pad($this->getCategoria()->getId(), 3, "0", STR_PAD_LEFT);
            $produtos = $em->getEntityManager()->getRepository("BackendBundle:Produto")->findByCategoria($this->getCategoria()->getId());

            $produto = str_pad((count($produtos) + 1), 4, "0", STR_PAD_LEFT);
            $this->codigo = $categoria . "." . $produto;
        }
    }

}
