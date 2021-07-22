<?php

namespace Tests\Feature;

use App\Models\Paste;
use App\Services\PasteService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Mockery\MockInterface;
use Tests\TestCase;

class PasteApiTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test creating a paste
     *
     * @return void
     */
    public function test_create_paste()
    {
        // Create the paste content
        $content = $this->faker->text();

        // Create a dummy paste
        $paste = Paste::factory()
               ->create([
                   'content' => $content
               ]);

        // Mock the paste service
        $this->mock(PasteService::class, function(MockInterface $mock) use ($content, $paste) {
            $mock->shouldReceive('create')
                 ->once()
                 ->with($content)
                 ->andReturn($paste);
        });

        // Send the API request
        $response = $this->json('POST', route('paste.store'), [
            'content' => $content
        ]);

        // Assert the correct status code was returned
        $response->assertCreated();

        // Assert the correct information was returned
        $this->assertEquals($paste->slug, $response['slug']);
        $this->assertNotNull($response['url']);
        $this->assertNotNull($response['edit_url']);
        $this->assertNotNull($response['message']);
    }

    /**
     * Test updating a paste
     *
     * @return void
     */
    public function test_update_paste()
    {
        // Create a paste
        $paste = Paste::factory()->create();

        // Create the new content
        $content = $this->faker->text();

        // Mock the paste service
        $this->mock(PasteService::class, function(MockInterface $mock) use ($paste, $content) {
            $mock->shouldReceive('update')
                 ->once()
                 ->withArgs(function($pasteArg, $contentArg) use ($paste, $content) {
                     return $content == $contentArg && $paste->is($pasteArg);
                 });
        });

        // Update
        $response = $this->json('PUT', URL::signedRoute('paste.update', $paste), [
            'content' => $content
        ]);

        // Assert a 200
        $response->assertOk();
    }

    /**
     * Test updating a paste without a signed URL
     *
     * @return void
     */
    public function test_paste_update_requires_signed_url()
    {
        // Create a paste
        $paste = Paste::factory()
               ->create();

        // Update without a signed URL
        $response = $this->json('PUT', route('paste.update', $paste));

        // Assert a 401
        $response->assertUnauthorized();
    }
}
