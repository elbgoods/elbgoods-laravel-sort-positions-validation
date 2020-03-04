<?php

namespace Elbgoods\SortPositionsRule\Tests;

use Elbgoods\SortPositionsRule\SortPositionsRuleServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [SortPositionsRuleServiceProvider::class];
    }
}
