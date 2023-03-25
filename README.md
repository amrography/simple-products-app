# Simple products php app task <!-- omit in toc -->

## Table of contents <!-- omit in toc -->

- [ORM](#orm)
  - [Create a product](#create-a-product)
  - [Get products](#get-products)
  - [Update a product](#update-a-product)
  - [Delete a product](#delete-a-product)
- [Road map](#road-map)

## ORM

### Create a product

```php
$product = (new \Akhaled\Ecommerce\Models\Product)->create([
        'name' => 'test',
        'sku' => '1023-0213-313',
        'price' => 10000,
        'type' => 'dvd',
        'attributes' => json_encode([
            10
        ])
    ]);

// return product
```

### Get products

```php
$product = (new \Akhaled\Ecommerce\Models\Product)->select("id")
    ->where("id", ">", "0")
    ->get(); // returns array
```

### Update a product

```php
$product = (new \Akhaled\Ecommerce\Models\Product)->where('sku', '1023-0213-313')
    ->update([
        'name' => "Test new",
        'price' => 9000,
        'type' => 'dvd',
        'attributes' => json_encode([
            10
        ])
    ]);
// return updated product
```

### Delete a product

```php
$product = (new \Akhaled\Ecommerce\Models\Product)->where('sku', '1023-0213-313')
    ->delete();
// return bool
```

## Road map

- [x] Create app container
- [x] Include Config and develop facade classes
- [x] Include ORM
- [x] Include routes handler
- [x] Handle route response
- [ ] Install vue with vite
- [ ] Include validation processor
