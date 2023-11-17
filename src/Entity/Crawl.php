<?php

namespace App\Entity;

use App\Repository\CrawlRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CrawlRepository::class)]
class Crawl
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $idSite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $resCrawl = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSite(): ?int
    {
        return $this->idSite;
    }

    public function setIdSite(int $idSite): static
    {
        $this->idSite = $idSite;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getResCrawl(): ?string
    {
        return $this->resCrawl;
    }

    public function setResCrawl(string $resCrawl): static
    {
        $this->resCrawl = $resCrawl;

        return $this;
    }
}
