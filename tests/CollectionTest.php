<?php

declare(strict_types=1);

namespace Regnerisch\Tests;

use PHPUnit\Framework\TestCase;
use Regnerisch\Collection\Collection;

final class CollectionTest extends TestCase
{
    public function testCanAccessCollectionAsArray()
    {
        $collection = new Collection();

        $collection[] = 'A';
        $collection['b'] = 'B';
        $collection['c'] = new \stdClass();

        $this->assertEquals(
            [
                'A',
                'b' => 'B',
                'c' => new \stdClass(),
            ],
            $collection->toArray()
        );
    }

    public function testCanAccessCollectionAsObject()
    {
        $collection = new Collection();

        $collection->{0} = 'A';
        $collection->b = 'B';
        $collection->c = new \stdClass();

        $this->assertEquals(
            [
                'A',
                'b' => 'B',
                'c' => new \stdClass(),
            ],
            $collection->toArray()
        );
    }

    public function testFromInterable()
    {
        $collection = Collection::fromIterable(new \ArrayIterator(['A', 'b' => 'B', 'c' => new \stdClass()]));

        $this->assertEquals(
            [
                'A',
                'b' => 'B',
                'c' => new \stdClass(),
            ],
            $collection->toArray()
        );
    }

    public function testFromArray()
    {
        $collection = Collection::fromArray(['A', 'b' => 'B', 'c' => new \stdClass()]);

        $this->assertEquals(
            [
                'A',
                'b' => 'B',
                'c' => new \stdClass(),
            ],
            $collection->toArray()
        );
    }
}
