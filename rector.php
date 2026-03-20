<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector;
use Rector\TypeDeclaration\Rector\ClassMethod\ReturnUnionTypeRector;
use Rector\TypeDeclaration\Rector\Closure\AddClosureVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;
use RectorLaravel\Set\LaravelSetProvider;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.DIRECTORY_SEPARATOR.'app',
        __DIR__.DIRECTORY_SEPARATOR.'bootstrap',
        __DIR__.DIRECTORY_SEPARATOR.'config',
        __DIR__.DIRECTORY_SEPARATOR.'database',
        __DIR__.DIRECTORY_SEPARATOR.'resources',
        __DIR__.DIRECTORY_SEPARATOR.'routes',
        __DIR__.DIRECTORY_SEPARATOR.'tests',
    ])
    ->withSkip([
        __DIR__.DIRECTORY_SEPARATOR.'bootstrap/cache',
        __DIR__.DIRECTORY_SEPARATOR.'storage',
        __DIR__.DIRECTORY_SEPARATOR.'vendor',
        AddClosureVoidReturnTypeWhereNoReturnRector::class,
        ReturnTypeFromStrictTypedCallRector::class,
        ReturnUnionTypeRector::class,
        DeclareStrictTypesRector::class => [
            __DIR__.DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.'views',
        ],
        AddArrowFunctionReturnTypeRector::class,
    ])
    ->withPhpSets()
    ->withSetProviders(LaravelSetProvider::class)
    ->withComposerBased(true)
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        typeDeclarations: true,
        privatization: true,
        earlyReturn: true,
    )
    ->withRules([
        DeclareStrictTypesRector::class,
    ]);
