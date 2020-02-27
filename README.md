# Collection
Another collection class
## Usage
You can use `Collection` direct or with a function:
```php
// Use as array, object or call a function
$collection = new Collection();
$collection[] = 'A';
$collection->b = 'B';
$collection->add('Value', 'optionalKey');

// Create from another iterator
$collection = Collection::fromIterator(['A', 'b' => 'B', 'C']);

// Create from an array
$collection = Collection::fromArray(['A', 'b' => 'B', 'C']);

// Create from another iterator/ array with a function
$collection = collect(['A', 'b' => 'B', 'C']);
```
