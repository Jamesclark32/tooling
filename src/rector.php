<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use Rector\Privatization\Rector\Class_\FinalizeTestCaseClassRector;
use Rector\Privatization\Rector\MethodCall\PrivatizeLocalGetterToPropertyRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/bootstrap/app.php',
        __DIR__.'/config',
        __DIR__.'/database',
        __DIR__.'/public',
        __DIR__.'/routes',
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        typeDeclarations: true,
        privatization: true,
        earlyReturn: true,
        strictBooleans: true,
    )
    ->withPhpSets(
        php84: true,
        php85: true
    )
    ->withComposerBased(laravel: true, )
    ->withRules([
        FinalizeTestCaseClassRector::class,
    ])
    ->withSkip([
        AddOverrideAttributeToOverriddenMethodsRector::class,
        ClassPropertyAssignToConstructorPromotionRector::class,
        ClosureToArrowFunctionRector::class,
        InlineConstructorDefaultToPropertyRector::class,
        PrivatizeLocalGetterToPropertyRector::class,
    ]);
