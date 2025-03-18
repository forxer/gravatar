<?php

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\Config\RectorConfig;
use Rector\Php81\Rector\Array_\FirstClassCallableRector;

return RectorConfig::configure()
    ->withImportNames()
    ->withParallel(
        timeoutSeconds: 320,
        maxNumberOfProcess: 16,
        jobSize: 20,
    )
    ->withCache(
        cacheClass: FileCacheStorage::class,
        cacheDirectory: __DIR__.'/.rector_cache',
    )
    ->withPaths([
        __DIR__.'/breadcrumbs',
        __DIR__.'/database',
        __DIR__.'/routes',
        __DIR__.'/src',
    ])

    // Up from PHP X.x to 8.2
    // ->withPhpSets()

    // only PHP 8.2
    ->withPhpSets(php82: true)

    ->withSkip([
        // Désactivation de cette règle car elle
        // transforme :     array_map('intval',
        // en :             array_map(intval(...),
        FirstClassCallableRector::class,
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        instanceOf: true,
        earlyReturn: true,
        strictBooleans: true,
    );
