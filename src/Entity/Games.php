<?php

namespace App\Entity;

use App\Repository\GamesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GamesRepository::class)
 */
class Games implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $img;

    /**
     * @ORM\Column(type="integer")
     */
    private $releaseAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plateformes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $copiesSold;

    /**
     * @ORM\Column(type="integer")
     */
    private $rank;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rate;

    /**
     * @ORM\ManyToOne(targetEntity=Studio::class, inversedBy="games")
     */
    private $studioId;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="games")
     */
    private $categoryId;

    /**
     * @ORM\OneToMany(targetEntity=Comments::class, mappedBy="gameId")
     */
    private $comments;

    public function __construct()
    {
        $this->categoryId = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getReleaseAt(): ?int
    {
        return $this->releaseAt;
    }

    public function setReleaseAt(int $releaseAt): self
    {
        $this->releaseAt = $releaseAt;

        return $this;
    }

    public function getPlateformes(): ?string
    {
        return $this->plateformes;
    }

    public function setPlateformes(string $plateformes): self
    {
        $this->plateformes = $plateformes;

        return $this;
    }

    public function getCopiesSold(): ?string
    {
        return $this->copiesSold;
    }

    public function setCopiesSold(?string $copiesSold): self
    {
        $this->copiesSold = $copiesSold;

        return $this;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(?int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function jsonserialize() {

        return ["id" => $this->getId(),
                "name" => $this->getName(),
                "img" => $this->getImg(),
                "plateformes" => $this->getPlateformes(),
                "releaseAt" => $this->getReleaseAt(),
                "copiesSold" => $this->getCopiesSold(),
                "rank" => $this->getRank(),
                "rate" => $this->getRate(),
                "studio" => $this->getStudioId(),
                "category" => $this->getCategoryId()];
    }

    public function getStudioId(): ?studio
    {
        return $this->studioId;
    }

    public function setStudioId(?studio $studioId): self
    {
        $this->studioId = $studioId;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategoryId(): Collection
    {
        return $this->categoryId;
    }

    public function addCategoryId(Category $categoryId): self
    {
        if (!$this->categoryId->contains($categoryId)) {
            $this->categoryId[] = $categoryId;
        }

        return $this;
    }

    public function removeCategoryId(Category $categoryId): self
    {
        if ($this->categoryId->contains($categoryId)) {
            $this->categoryId->removeElement($categoryId);
        }

        return $this;
    }

    /**
     * @return Collection|Comments[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setGameId($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getGameId() === $this) {
                $comment->setGameId(null);
            }
        }

        return $this;
    }

}
