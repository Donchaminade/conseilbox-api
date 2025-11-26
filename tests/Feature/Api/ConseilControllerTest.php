<?php

namespace Tests\Feature\Api;

use App\Models\Conseil;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConseilControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_published_conseils(): void
    {
        Conseil::factory()->published()->create(['created_at' => now()->subDay()]);
        Conseil::factory()->published()->create(['created_at' => now()]);
        Conseil::factory()->pending()->create();

        $response = $this->getJson('/api/conseils');

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
        $response->assertJsonPath('data.0.status', Conseil::STATUS_PUBLISHED);
    }

    public function test_index_can_filter_by_location_and_search(): void
    {
        Conseil::factory()->published()->create(['location' => 'Paris', 'title' => 'Astuce Paris']);
        Conseil::factory()->published()->create(['location' => 'Lyon', 'title' => 'Autre']);

        $response = $this->getJson('/api/conseils?location=Par&search=Astuce');

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.location', 'Paris');
    }

    public function test_show_returns_only_published_conseils(): void
    {
        $pending = Conseil::factory()->pending()->create();
        $published = Conseil::factory()->published()->create();

        $this->getJson('/api/conseils/' . $pending->id)->assertNotFound();

        $this->getJson('/api/conseils/' . $published->id)
            ->assertOk()
            ->assertJsonPath('data.id', $published->id);
    }

    public function test_store_creates_suggestion_in_pending_status(): void
    {
        $payload = [
            'title' => 'Nouveau conseil',
            'content' => 'Voici le contenu',
            'anecdote' => 'Anecdote sympa',
            'author' => 'Camille',
            'location' => 'Marseille',
            'social_link_1' => 'https://example.com',
        ];

        $response = $this->postJson('/api/conseils', $payload);

        $response->assertCreated();
        $response->assertJsonPath('data.status', Conseil::STATUS_PENDING);
        $this->assertDatabaseHas('conseils', [
            'title' => 'Nouveau conseil',
            'status' => Conseil::STATUS_PENDING,
        ]);
    }
}

