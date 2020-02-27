<?php

declare(strict_types=1);

namespace Regnerisch\Collection;

if (!function_exists('collect')) {
    function collect(iterable $iterable): Collection
    {
        return Collection::fromIterable($iterable);
    }
}
