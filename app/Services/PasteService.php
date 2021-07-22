<?php
namespace App\Services;

use App\Models\Paste;
use Illuminate\Support\Str;

class PasteService
{
    /**
     * Create a new paste
     *
     * @param  string $content The paste's content
     * @return Paste
     */
    public function create($content)
    {
        return Paste::create([
            'content' => $content,
            'slug' => Str::random(16)
        ]);
    }

    /**
     * Update a paste
     *
     * @param  Paste $paste The paste to update
     * @param  string $content The new content
     * @return void
     */
    public function update($paste, $content)
    {
        $paste->update([
            'content' => $content
        ]);
    }
}
