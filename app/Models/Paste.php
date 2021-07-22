<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id The paste's primary key
 * @property string $slug The paste's slug
 * @property string $content The paste's content
 */
class Paste extends Model
{
    use HasFactory;

    /**
     * Properties that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'slug'
    ];
}
