<?php

declare(strict_types=1);

namespace SwagMyPlugin\Core\Content\SwagMyPlugin;

use Shopware\Core\Content\Media\MediaEntity;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;
use Shopware\Core\System\Country\CountryEntity;

class SwagMyPluginEntity extends Entity
{
    use EntityIdTrait;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $city;

    /**
     * @var CountryEntity|null
     */
    protected CountryEntity|null $country = null;

    /**
     * @var boolean
     */
    protected bool $active;

    /**
     * @var MediaEntity
     */
    protected MediaEntity|null $media = null;

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCity(): string
    {
        return $this->city;
    }
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCountry(): CountryEntity|null
    {
        return $this->country;
    }
    public function setCountry(CountryEntity|null $country): void
    {
        $this->country = $country;
    }

    public function getActive(): bool
    {
        return $this->active;
    }
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getMedia(): MediaEntity|null
    {
        return $this->media;
    }
    public function setMedia(MediaEntity|null $media): void
    {
        $this->media = $media;
    }
}
