<?php

namespace App\Entity;

use App\Repository\MoodRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MoodRepository::class)
 */
class Mood
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
    private $feeling;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emoji;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=UserProfile::class, inversedBy="moods")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likesCount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeeling(): ?string
    {
        return $this->feeling;
    }

    public function setFeeling(string $feeling): self
    {
        $this->feeling = $feeling;

        return $this;
    }

    public function getEmoji(): ?string
    {
        return $this->emoji;
    }

    public function setEmoji(string $emoji): self
    {
        $this->emoji = $emoji;

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

    public function getUserId(): ?UserProfile
    {
        return $this->user_id;
    }

    public function setUserId(?UserProfile $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getLikesCount(): ?int
    {
        return $this->likesCount;
    }

    public function setLikesCount(?int $likesCount): self
    {
        $this->likesCount = $likesCount;

        return $this;
    }
}
