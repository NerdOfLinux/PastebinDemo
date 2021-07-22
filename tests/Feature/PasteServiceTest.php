<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paste;
use App\Services\PasteService;

class PasteServiceTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test creating a new paste
     *
     * @return void
     */
    public function test_create_new_paste()
    {
        // Resolve the service
        $pasteService = $this->app->make(PasteService::class);

        // Generate random content for the paste
        $content = $this->faker->text();

        // Create the paste
        $paste = $pasteService->create($content);

        // Assert the correct type was returned
        $this->assertInstanceOf(Paste::class, $paste);

        // Assert the database was updated
        $this->assertDatabaseHas('pastes', [
            'content' => $content
        ]);
    }

    /**
     * Test updating a paste
     *
     * @return void
     */
    public function test_update_paste()
    {
        // Resolve the service
        $pasteService = $this->app->make(PasteService::class);

        // Create a paste
        $paste = Paste::factory()->create();

        // Create the new content
        $content = $this->faker->text();

        // Update the paste
        $pasteService->update($paste, $content);

        // Assert the paste was updated
        $this->assertDatabaseHas('pastes', [
            'id' => $paste->id,
            'content' => $content
        ]);
    }
}
