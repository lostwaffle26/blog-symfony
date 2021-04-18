<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 * @Vich\Uploadable
 */
class Articles
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
    private $titre;

    /**
     * @Gedmo\Slug(fields={"titre"})
     * @ORM\Column(length= 128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var \DateTime $ created_at
     * 
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTime $ update_at
     * 
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $featured_image;

    /**
     * @Vich\UploadableField(mapping="featured_images", fileNameProperty="featured_image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Commentary::class, mappedBy="articles", orphanRemoval=true)
     */
    private $commentary;

    /**
     * @ORM\ManyToMany(targetEntity=KeyWords::class, inversedBy="articles")
     */
    private $key_words;

    /**
     * @ORM\ManyToMany(targetEntity=Categories::class, inversedBy="articles")
     */
    private $categories;

    public function __construct()
    {
        $this->commentary = new ArrayCollection();
        $this->key_words = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }


    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function getFeaturedImage()
    {
        return $this->featured_image;
    }

    public function setFeaturedImage($featured_image)
    {
        $this->featured_image = $featured_image;

        return $this;
    }

    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updated_at = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getUsers(): ?string
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection|Commentary[]
     */
    public function getCommentary(): Collection
    {
        return $this->commentary;
    }

    public function addCommentary(Commentary $commentary): self
    {
        if (!$this->commentary->contains($commentary)) {
            $this->commentary[] = $commentary;
            $commentary->setArticles($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): self
    {
        if ($this->commentary->removeElement($commentary)) {
            // set the owning side to null (unless already changed)
            if ($commentary->getArticles() === $this) {
                $commentary->setArticles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|KeyWords[]
     */
    public function getKeyWords(): Collection
    {
        return $this->key_words;
    }

    public function addKeyWord(KeyWords $keyWord): self
    {
        if (!$this->key_words->contains($keyWord)) {
            $this->key_words[] = $keyWord;
        }

        return $this;
    }

    public function removeKeyWord(KeyWords $keyWord): self
    {
        $this->key_words->removeElement($keyWord);

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }
}
