<?php
include_once(__DIR__ . '/Category.php');
include_once(__DIR__ . '/BaseEntity.php');

class Product extends BaseEntity
{
    protected string $name;
    protected int $quantity;
    protected string $description;
    protected string $image_url;
    protected string $download_link;
    protected float $price;
    protected Category $category;
    protected string $tableName = 'product';

    function __construct()
    {
        parent::__construct();
    }

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
        $this->image_url = $image;
    }

    function set_downloadLink(string $downloadLink): void
    {
        $this->download_link = $downloadLink;
    }

    function set_category(Category $category): void
    {
        $this->category = $category;
    }

    function set_price(float $price): void
    {
        $this->price = $price;
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
        return $this->image_url;
    }

    function get_downloadLink(): string
    {
        return $this->download_link;
    }

    function get_category(): Category
    {
        return $this->category;
    }

    function get_price(): float
    {
        return $this->price;
    }

    function attributes_to_array(): array
    {
        return [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'download_link' => $this->download_link,
            'category_id' => $this->category->id,
            'name' => $this->name,
            'price' => $this->price
        ];
    }
}
