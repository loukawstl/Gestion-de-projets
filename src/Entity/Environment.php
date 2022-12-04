<?php

namespace App\Entity;

use App\Repository\ContactRepostory;
use App\Repository\EnvironmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Project;

#[ORM\Entity(repositoryClass: EnvironmentRepository::class)]
class Environment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column(length: 255)]
    private ?string $ipAdress = null;

    #[ORM\Column(length: 255)]
    private ?string $ssPort = null;

    #[ORM\Column(length: 255)]
    private ?string $sshUsername = null;

    #[ORM\Column(length: 255)]
    private ?string $phpmyadminLink = null;

    #[ORM\Column]
    private ?bool $ipRestriction = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'project')]
    private ?self $environment = null;

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

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getIpAdress(): ?string
    {
        return $this->ipAdress;
    }

    public function setIpAdress(string $ipAdress): self
    {
        $this->ipAdress = $ipAdress;

        return $this;
    }

    public function getSsPort(): ?string
    {
        return $this->ssPort;
    }

    public function setSsPort(string $ssPort): self
    {
        $this->ssPort = $ssPort;

        return $this;
    }

    public function getSshUsername(): ?string
    {
        return $this->sshUsername;
    }

    public function setSshUsername(string $sshUsername): self
    {
        $this->sshUsername = $sshUsername;

        return $this;
    }

    public function getPhpmyadminLink(): ?string
    {
        return $this->phpmyadminLink;
    }

    public function setPhpmyadminLink(string $phpmyadminLink): self
    {
        $this->phpmyadminLink = $phpmyadminLink;

        return $this;
    }

    public function isIpRestriction(): ?bool
    {
        return $this->ipRestriction;
    }

    public function getEnvironment(): ?self
    {
        return $this->environment;
    }

    public function setEnvironment(?self $environment): self
    {
        $this->environment = $environment;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getProject(): Collection
    {
        return $this->project;
    }

    public function addProject(self $project): self
    {
        if (!$this->project->contains($project)) {
            $this->project->add($project);
            $project->setEnvironment($this);
        }

        return $this;
    }

    public function removeProject(self $project): self
    {
        if ($this->project->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getEnvironment() === $this) {
                $project->setEnvironment(null);
            }
        }

        return $this;
    }
}
