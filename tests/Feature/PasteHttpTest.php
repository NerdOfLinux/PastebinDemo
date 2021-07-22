<?php

namespace Tests\Feature;

use App\Models\Paste;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class PasteHttpTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test viewing a paste
     *
     * @return void
     */
    public function test_view_paste()
    {
        // Create a paste
        $paste = Paste::factory()->create();

        // Get the paste
        $response = $this->get(route('paste.show', $paste));

        // Assert the content exists
        $response->assertSeeText($paste->content);
    }

    /**
     * Test viewing the edit page
     *
     * @return void
     */
    public function test_view_edit_page_for_paste()
    {
        // Create a paste
        $paste = Paste::factory()->create();

        // Visit the page
        $response = $this->get(URL::signedRoute('paste.edit', $paste));

        // Assert the content exists
        $response->assertSeeText($paste->content);
    }

    /**
     * Assert a signed URL is needed on the edit page
     *
     * @return void
     */
    public function test_signed_url_required_for_edit()
    {
        // Create a paste
        $paste = Paste::factory()->create();

        // Try to view the edit page without a signed URL
        $response = $this->get(route('paste.edit', $paste));

        // Assert a 401
        $response->assertUnauthorized();
    }
}
