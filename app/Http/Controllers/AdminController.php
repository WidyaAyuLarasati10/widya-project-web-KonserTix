<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Event;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak! Anda bukan Administrator.');
        }

        $totalRevenue = Order::where('status', 'paid')->sum('total_amount');
        $totalTicketsSold = Order::where('status', 'paid')->sum('quantity');
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $totalEventsCount = Event::count();

        $query = Order::with(['ticketCategory.event', 'user'])->latest();

        // PERBAIKAN PENCARIAN/FILTER DI SINI
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $latestOrders = $query->paginate(10)->appends($request->all());
        $eventsSummary = Event::with('ticketCategories')->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalTicketsSold',
            'pendingOrdersCount',
            'totalEventsCount',
            'latestOrders',
            'eventsSummary'
        ));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'status' => 'required|in:pending,paid,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan # ' . $order->order_number . ' berhasil diperbarui!');
    }

    public function createEvent()
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        return view('admin.events.create');
    }

    public function storeEvent(Request $request)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'title'        => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'event_date'   => 'required|date',
            'category'     => 'required|in:national,international',
            'description'  => 'nullable|string',
            'banner_file'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tickets'      => 'required|array|min:1',
            'tickets.*.name'  => 'required|string|max:255',
            'tickets.*.price' => 'required|numeric|min:0',
            'tickets.*.stock' => 'required|integer|min:1',
        ]);

        $bannerUrl = 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=1000';
        if ($request->hasFile('banner_file')) {
            $path = $request->file('banner_file')->store('events', 'public');
            $bannerUrl = asset('storage/' . $path);
        }

        $event = Event::create([
            'title'        => $request->title,
            'location'     => $request->location,
            'event_date'   => $request->event_date,
            'category'     => $request->category,
            'banner_image' => $bannerUrl,
            'description'  => $request->description,
        ]);

        foreach ($request->tickets as $ticketData) {
            TicketCategory::create([
                'event_id' => $event->id,
                'name'     => $ticketData['name'],
                'price'    => $ticketData['price'],
                'stock'    => $ticketData['stock'],
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Event konser dan kategori tiket berhasil ditambahkan!');
    }

    public function editEvent($id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        $event = Event::with('ticketCategories')->findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'title'        => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'event_date'   => 'required|date',
            'category'     => 'required|in:national,international',
            'description'  => 'nullable|string',
            'banner_file'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'tickets'      => 'required|array|min:1',
            'tickets.*.name'  => 'required|string|max:255',
            'tickets.*.price' => 'required|numeric|min:0',
            'tickets.*.stock' => 'required|integer|min:1',
        ]);

        $event = Event::findOrFail($id);

        $bannerUrl = $event->banner_image;
        if ($request->hasFile('banner_file')) {
            $path = $request->file('banner_file')->store('events', 'public');
            $bannerUrl = asset('storage/' . $path);
        }

        $event->update([
            'title'        => $request->title,
            'location'     => $request->location,
            'event_date'   => $request->event_date,
            'category'     => $request->category,
            'banner_image' => $bannerUrl,
            'description'  => $request->description,
        ]);

        $event->ticketCategories()->delete();
        foreach ($request->tickets as $ticketData) {
            TicketCategory::create([
                'event_id' => $event->id,
                'name'     => $ticketData['name'],
                'price'    => $ticketData['price'],
                'stock'    => $ticketData['stock'],
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Event ' . $event->title . ' berhasil diperbarui!');
    }

    public function destroyEvent($id)
    {
        if (!Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        $event = Event::findOrFail($id);
        $event->ticketCategories()->delete();
        $event->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Event berhasil dihapus!');
    }
}