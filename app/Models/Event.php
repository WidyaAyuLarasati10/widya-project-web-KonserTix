<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', // <--- TAMBAHKAN INI
        'location',
        'event_date',
        'banner_image',
    ];

    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class);
    }
}