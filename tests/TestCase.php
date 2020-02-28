<?php

namespace Elbgoods\LaravelSortPositionsValidation\Tests;

use Elbgoods\LaravelSortPositionsValidation\LaravelSortPositionsValidationServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [LaravelSortPositionsValidationServiceProvider::class];
    }
}
