<?php

namespace Tests\Feature\Api;

use App\Models\Publicite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PubliciteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_only_active_publicites_by_default(): void
    {
        Publicite::factory()->active()->count(2)->create();
        Publicite::factory()->inactive()->create();

        $response = $this->getJson('/api/publicites');

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
    }

    public function test_index_can_include_inactive_and_limit_results(): void
    {
        Publicite::factory()->count(3)->create();

        $response = $this->getJson('/api/publicites?only_active=0&limit=2');

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
    }
}

