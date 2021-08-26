<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TrickRepository::class)
 */
class Trick
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="tricks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trickGroup;


    /**
     * @ORM\OneToMany(targetEntity=Media::class, mappedBy="trick")
     * @ORM\OrderBy({"displayOrder" = "ASC"})
     */
    private $trickMedia;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="trick")
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Video::class, mappedBy="trick")
     */
    private $videos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->videos = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTrickGroup(): ?Group
    {
        return $this->trickGroup;
    }

    public function setTrickGroup(?Group $trickGroup): self
    {
        $this->trickGroup = $trickGroup;

        return $this;
    }


    /**
     * @return Collection|Media[]
     */
    public function getTrickMedia(): Collection
    {
        return $this->trickMedia;
    }

    public function addTrickMedium(Media $trickMedium): self
    {
        if (!$this->trickMedia->contains($trickMedium)) {
            $this->trickMedia[] = $trickMedium;
            $trickMedium->setTrick($this);
        }

        return $this;
    }

    public function removeTrickMedium(Media $trickMedium): self
    {
        if ($this->trickMedia->removeElement($trickMedium)) {
            // set the owning side to null (unless already changed)
            if ($trickMedium->getTrick() === $this) {
                $trickMedium->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setTrick($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getTrick() === $this) {
                $comment->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setTrick($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getTrick() === $this) {
                $video->setTrick(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
