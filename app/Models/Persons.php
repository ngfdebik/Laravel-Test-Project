<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persons extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $timestamps = false;
    protected $guarded = [];
    protected $updated_at = true;
    protected $created_at = true;

}