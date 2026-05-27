<?php

declare(strict_types=1);

namespace Tests\Feature;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use Tests\TestCase;

class DocsRouteTest extends TestCase
{
    public function test_docs_route_is_accessible_in_local_environment(): void
    {
        app()->detectEnvironment(fn () => 'local');

        $response = $this->get('/docs');

        $response->assertOk()
            ->assertViewIs('scribe.index');
    }

    public function test_docs_route_is_not_accessible_in_production(): void
    {
        app()->detectEnvironment(fn () => 'production');

        $this->withoutExceptionHandling();

        $this->expectException(AccessDeniedException::class);

        $this->get('/docs');
    }
}