<?php

namespace App\Invoice\Entity;

use App\Invoice\Repository\InvoiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $number;

    /**
     * @ORM\Column(type="date_immutable")
     */
    private $issueDate;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $grossTotal;

    /**
     * @var Collection|InvoiceItem[]
     *
     * @ORM\OneToMany(targetEntity="App\Invoice\Entity\InvoiceItem", mappedBy="invoice")
     */
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getIssueDate(): ?\DateTimeImmutable
    {
        return $this->issueDate;
    }

    public function setIssueDate(\DateTimeImmutable $issueDate): self
    {
        $this->issueDate = $issueDate;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeImmutable
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeImmutable $createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getGrossTotal(): ?int
    {
        return $this->grossTotal;
    }

    public function setGrossTotal(int $grossTotal): self
    {
        $this->grossTotal = $grossTotal;

        return $this;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items): self
    {
        $this->items = $items;

        return $this;
    }
}
