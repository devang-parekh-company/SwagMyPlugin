<?php declare(strict_types=1);

namespace BlogPlugin\Core\Content\BlogPlugin\BlogCategory;

use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use BlogPlugin\Core\Content\BlogPlugin\BlogCategory\Aggregate\BlogCategoryTranslationCollection;
use BlogPlugin\Core\Content\BlogPlugin\Blog\BlogCollection;

class BlogCategoryEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var BlogCategoryTranslationCollection|null
     */
    protected $translations;

    /**
     * @var BlogCollection|null
     */
    protected $blogs;

    /**
     * @var \DateTimeInterface
     */
    protected $createdAt;

    /**
     * @var \DateTimeInterface|null
     */
    protected $updatedAt;

    /**
     * @var array|null
     */
    protected $translated;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getTranslations(): ?BlogCategoryTranslationCollection
    {
        return $this->translations;
    }

    public function setTranslations(?BlogCategoryTranslationCollection $translations): void
    {
        $this->translations = $translations;
    }

    public function getBlogs(): ?BlogCollection
    {
        return $this->blogs;
    }

    public function setBlogs(?BlogCollection $blogs): void
    {
        $this->blogs = $blogs;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getTranslated(): array
    {
        return $this->translated;
    }

    public function setTranslated(?array $translated): void
    {
        $this->translated = $translated;
    }
}