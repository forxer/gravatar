<?php

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\Config\RectorConfig;

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
        __DIR__.'/src',
    ])

    // Up from PHP X.x to 8.2
    // ->withPhpSets()

    // only PHP 8.2
    ->withPhpSets(php82: true)

    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        instanceOf: true,
        earlyReturn: true,
        // strictBooleans: true,
    );
