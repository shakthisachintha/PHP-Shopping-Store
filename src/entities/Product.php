<?php
include_once("./Category.php");
include_once("./BaseEntity.php");

class Product extends BaseEntity
{
    private string $name;
    private int $quantity;
    private string $description;
    private string $image;
    private string $downloadLink;
    private Category $category;

    function set_name(string $name): void
    {
        $this->name = $name;
    }

    function set_quantity(string $quantity): void
    {
        $this->quantity = $quantity;
    }

    function set_description(string $description): void
    {
        $this->description = $description;
    }

    function set_image(string $image): void
    {
        $this->image = $image;
    }

    function set_downloadLink(string $downloadLink): void
    {
        $this->downloadLink = $downloadLink;
    }

    function set_category(Category $category): void
    {
        $this->category = $category;
    }

    function get_name(): string
    {
        return $this->name;
    }

    function get_quantity(): int
    {
        return $this->quantity;
    }

    function get_description(): string
    {
        return $this->description;
    }

    function get_image(): string
    {
        return $this->image;
    }

    function get_downloadLink(): string
    {
        return $this->downloadLink;
    }
    
    function get_category(): Category
    {
        return $this->category;
    }
}
