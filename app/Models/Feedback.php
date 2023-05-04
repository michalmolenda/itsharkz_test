<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    public const SORTABLE_COLUMNS = ['name', 'email', 'rate', 'created_at'];
    public const SORTABLE_DIRECTIONS = ['asc', 'desc'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email', 'name', 'rate', 'comment', 'file_name'
    ];
}
