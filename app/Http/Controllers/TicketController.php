<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Mail\TicketCreated;
use Illuminate\Support\Str;
use App\Models\TicketStatus;
use App\Models\TicketCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Stevebauman\Location\Facades\Location;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::with(['ticketStatus', 'ticketCategory'])->paginate(10);
        // $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TicketCategory::all();

        return view('tickets.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTicketRequest $request)
    {
        $ticket = new Ticket();
        $ticket->user_id = Auth::id(); // ID of current user
        $ticket->ticket_subject = $request->input('subject');
        $ticket->ticket_description = $request->input('description');
        $ticket->category_id = $request->input('category');
        $ticket->ticket_number = $this->generateTicketNumber($ticket->category_id);
        $ticket->name = $request->input('name');
        $ticket->email = $request->input('email');
        $ticket->phone_number = $request->input('phone');

        // Retrieve location coordinates using HTML5 Geolocation API
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // Check if coordinates are available from frontend geolocation
        if (!$latitude || !$longitude) {
            // Use fallback method (e.g., IP geolocation service)
            $ipAddress = $request->ip();
            $location = $this->getLocationFromIpAddress($ipAddress);
            $latitude = $location->latitude;
            $longitude = $location->longitude;
        }

        $ticket->ip_address = $ipAddress;
        $ticket->latitude = $location->latitude;
        $ticket->longitude = $location->longitude;


        //Save the ticket to the database
        try {
            $ticket_result = DB::transaction(function () use ($ticket) {
               $ticket->save();

               // Send email notification
                $recipientEmail = $ticket->email;
                Mail::to($recipientEmail)->send(new TicketCreated($ticket));
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->withInput()->with('error', 'There was an error creating the ticket. Please try again. If the problem persists please contact the support agents.');
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::with(['ticketStatus', 'ticketCategory'])->findOrFail($id);

        if (Auth::user()->hasRole('Customer')) {
            if (Auth::user()->id !== $ticket->user_id) {
                return redirect()->route('tickets.index')->with('warning', 'You can not view a ticket you did not log.');
            }
        }
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $categories = TicketCategory::all();
        $statuses = TicketStatus::all();

        return view('tickets.edit', compact('ticket', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->ticket_subject = $request->input('subject');
        $ticket->ticket_description = $request->input('description');
        $ticket->category_id = $request->input('category');
        $ticket->status_id = $request->input('status');

        //Update the ticket in the database
        try {
            $ticket_result = DB::transaction(function () use ($ticket) {
               $ticket->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->withInput()->with('error', 'There was an error updating the ticket. Please try again. If the problem persists please contact the support agents.');
        }

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }



    /**
     * Gets the coordinates or else sets to default
     */
    function getLocationFromIpAddress($ipAddress)
    {
        $location = Location::get($ipAddress);

        // Check if location data is available
        if ($location && $location->latitude && $location->longitude) {
            return $location;
        }

        // Fallback to default coordinates
        $defaultLatitude = 0.0;
        $defaultLongitude = 0.0;

        return (object) [
            'latitude' => $defaultLatitude,
            'longitude' => $defaultLongitude,
        ];
    }

    function generateTicketNumber($categoryId)
    {
        $category = TicketCategory::findOrFail($categoryId);
        $categoryCode = strtolower($category->category_name);

        // Generate a unique identifier
        $uniqueIdentifier = random_int(100000, 999999);

        // Concatenate the category code and the unique identifier
        $ticketNumber = $categoryCode . '_' . $uniqueIdentifier;

        return $ticketNumber;
    }
}
