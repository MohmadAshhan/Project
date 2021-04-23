<?php

namespace App\Entity;

use App\Repository\ContestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContestRepository::class)
 */
class Contest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $conditionContest;

    /**
     * @ORM\OneToMany(targetEntity=Prize::class, mappedBy="contest")
     */
    private $prize;

    public function __construct()
    {
        $this->prize = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getConditionContest(): ?string
    {
        return $this->conditionContest;
    }

    public function setConditionContest(string $conditionContest): self
    {
        $this->conditionContest = $conditionContest;

        return $this;
    }

    /**
     * @return Collection|Prize[]
     */
    public function getPrize(): Collection
    {
        return $this->prize;
    }

    public function addPrize(Prize $prize): self
    {
        if (!$this->prize->contains($prize)) {
            $this->prize[] = $prize;
            $prize->setContest($this);
        }

        return $this;
    }

    public function removePrize(Prize $prize): self
    {
        if ($this->prize->contains($prize)) {
            $this->prize->removeElement($prize);
            // set the owning side to null (unless already changed)
            if ($prize->getContest() === $this) {
                $prize->setContest(null);
            }
        }

        return $this;
    }
}
