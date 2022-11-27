<?php

namespace App\Entity;

class Article{
    private $slug;
    private $title;
    private $desc;

    function __construct(string $slug, string $title, string $desc){
        $this->slug = $slug;
        $this->title = $title;
        $this->desc = $desc;
    }

    public function setSlug(string $slug): self{
        $this->slug = $slug;
        return $this;
    }

    public function setTitle(string $title): self{
        $this->title = $title;
        return $this;
    }

    public function setDesc(string $desc): self{
        $this->desc = $desc;
        return $this;
    }

    public function getSlug(): ?string{
        return $this->slug;
    }

    public function getTitle(): ?string{
        return $this->title;
    }

    public function getDesc(): ?string{
        return $this->desc;
    }

}