<?php

/*
 * This file has been created by developers from BitBag.
 * Feel free to contact us once you face any issues or want to start
 * You can find more information about us on https://bitbag.io and write us
 * an email on hello@bitbag.io.
 */

declare(strict_types=1);

namespace BitBag\SyliusCatalogPlugin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

class Catalog implements CatalogInterface
{
    use TranslatableTrait {
        __construct as protected initializeTranslationsCollection;
    }

    public function __construct()
    {
        $this->initializeTranslationsCollection();

        /** @var ArrayCollection<array-key, CatalogRuleInterface> $this->rules */
        $this->rules = new ArrayCollection();
        $this->productAssociationRules = new ArrayCollection();
    }

    /** @var int|null */
    protected $id;

    /** @var \DateTime|null */
    protected $startDate;

    /** @var \DateTime|null */
    protected $endDate;

    /** @var CatalogRuleInterface[]|Collection */
    protected $rules;

    /** @var string|null */
    protected $code;

    /** @var string|null */
    protected $connectingRules;

    /** @var CatalogRuleInterface[]|Collection */
    protected $productAssociationRules;

    protected $productAssociationConnectingRules;

    public function getConnectingRules(): ?string
    {
        return $this->connectingRules;
    }

    public function setConnectingRules(?string $connectingRules): void
    {
        $this->connectingRules = $connectingRules;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getRules(): Collection
    {
        return $this->rules;
    }

    public function hasRules(): bool
    {
        return !$this->rules->isEmpty();
    }

    public function hasRule(CatalogRuleInterface $rule): bool
    {
        return $this->rules->contains($rule);
    }

    public function addRule(CatalogRuleInterface $rule): void
    {
        if (!$this->hasRule($rule)) {
            $rule->setCatalog($this);
            $this->rules->add($rule);
        }
    }

    public function removeRule(CatalogRuleInterface $rule): void
    {
        $rule->setCatalog(null);
        $this->rules->removeElement($rule);
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->getCatalogTranslation()->getName();
    }

    public function setName(?string $name): void
    {
        $this->getCatalogTranslation()->setName($name);
    }

    /** @return CatalogTranslationInterface|TranslationInterface */
    protected function getCatalogTranslation(): TranslationInterface
    {
        return  $this->getTranslation();
    }

    protected function createTranslation(): CatalogTranslation
    {
        return new CatalogTranslation();
    }

    public function getProductAssociationRules(): Collection
    {
        return $this->productAssociationRules;
    }

    public function hasProductAssociationRules(): bool
    {
        return !$this->productAssociationRules->isEmpty();
    }

    public function hasProductAssociationRule(ProductAssociationRuleInterface $rule): bool
    {
        return $this->productAssociationRules->contains($rule);
    }

    public function addProductAssociationRule(ProductAssociationRuleInterface $rule): void
    {
        if (!$this->hasProductAssociationRule($rule)) {
            $rule->setCatalog($this);
            $this->productAssociationRules->add($rule);
        }
    }

    public function removeProductAssociationRule(ProductAssociationRuleInterface $rule): void
    {
        $rule->setCatalog(null);
        $this->productAssociationRules->removeElement($rule);
    }

    public function getProductAssociationConnectingRules(): ?string
    {
        return $this->productAssociationConnectingRules;
    }

    public function setProductAssociationConnectingRules($productAssociationConnectingRules): void
    {
        $this->productAssociationConnectingRules = $productAssociationConnectingRules;
    }
}
