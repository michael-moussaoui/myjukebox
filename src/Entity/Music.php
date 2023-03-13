<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MusicRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\Entity(repositoryClass: MusicRepository::class)]
#[Vich\Uploadable]
class Music
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("music:read")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("music:read")]
    private ?string $genre = null;


    #[ORM\ManyToOne(inversedBy: 'music')]
    private ?Category $category = null;

    #[ORM\Column(length: 255)]
    #[Groups("music:read")]
    private ?string $artist = null;

    #[ORM\Column(length: 255)]
    #[Groups("music:read")]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("music:read")]
    private ?string $song = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("music:read")]
    private ?string $cover = null;


    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[Vich\UploadableField(mapping: 'music_songs', fileNameProperty: 'song', size: 'songSize')]
    private ?File $songFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $songName = null;

    #[ORM\Column(nullable: true)]
    private ?int $songSize = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $test = null;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'favoris')]
    private Collection $favoris;

    public function __toString()
    {
        return $this->getFavoris();
    }

    public function __construct()
    {
        $this->favoris = new ArrayCollection();
    }

    

    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSong(): ?string
    {
        return $this->song;
    }

    public function setSong(string $song): self
    {
        $this->song = $song;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

# getter / setter SONG

/**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $songFile
     */
    public function setSongFile(?File $song = null): void
    {
        $this->songFile = $song;

        if (null !== $song) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getSongFile(): ?File
    {
        return $this->songFile;
    }

    public function setSongName(?string $song): void
    {
        $this->songName = $songFile;
    }

    public function getSongName(): ?string
    {
        return $this->songName;
    }

    public function setSongSize(?int $songSize): void
    {
        $this->songSize = $songSize;
    }

    public function getSongSize(): ?int
    {
        return $this->songSize;
    }

    public function getTest(): ?string
    {
        return $this->test;
    }

    public function setTest(?string $test): self
    {
        $this->test = $test;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(User $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
        }

        return $this;
    }

    public function removeFavori(User $favori): self
    {
        $this->favoris->removeElement($favori);

        return $this;
    }

    

 
}
