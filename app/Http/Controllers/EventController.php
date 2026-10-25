<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('ticketCategories');

        // Fitur Search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Fitur Filter Category (Nasional / Internasional)
        if ($request->has('category') && $request->category != 'all' && $request->category != '') {
            $cat = $request->category;
            if ($cat == 'national') {
                $query->whereIn('id', [1, 2, 3, 4, 5]); // ID event nasional
            } elseif ($cat == 'international') {
                $query->whereNotIn('id', [1, 2, 3, 4, 5]); // ID event internasional
            }
        }

        // UBAH ->get() MENJADI ->paginate(6)
        $events = $query->orderBy('event_date', 'asc')->paginate(6)->withQueryString();

        // Featured Event untuk Banner Hero
        $featuredEvent = Event::with('ticketCategories')->first();

        return view('welcome', compact('events', 'featuredEvent'));
    }

    public function show($id)
    {
        $event = Event::with('ticketCategories')->findOrFail($id);
        return view('events.show', compact('event'));
    }
}