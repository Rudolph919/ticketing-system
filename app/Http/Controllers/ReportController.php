<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use App\Models\TicketCategory;

class ReportController extends Controller
{
    public function index()
    {
        $categories = TicketCategory::all();
        $statuses = TicketStatus::all();

        return view('reports.index', compact('categories', 'statuses'));
    }

    public function search(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $category = $request->input('category');
        $status = $request->input('status');

        // Start with the base query
        $query = Ticket::query();

        // Apply the filters
        $query->when($startDate, function ($query, $startDate) {
            return $query->whereDate('created_at', '>=', $startDate);
        })
        ->when($endDate, function ($query, $endDate) {
            return $query->whereDate('created_at', '<=', $endDate);
        })
        ->when($category, function ($query, $category) {
            return $query->where('category_id', $category);
        })
        ->when($status, function ($query, $status) {
            return $query->where('status_id', $status);
        });

        // Order the tickets based on the selected option
        $orderBy = $request->input('order_by', 'date_logged');

        switch ($orderBy) {
            case 'first_name':
                $query->orderBy('first_name');
                break;
            case 'last_name':
                $query->orderBy('last_name');
                break;
            case 'ticket_status':
                $query->join('ticket_statuses', 'tickets.status_id', '=', 'ticket_statuses.id')
                    ->orderBy('ticket_statuses.status_name');
                break;
            case 'category':
                $query->join('ticket_categories', 'tickets.category_id', '=', 'ticket_categories.id')
                    ->orderBy('ticket_categories.category_name');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Execute the query and fetch the results
        $tickets = $query->paginate(10);

        $categories = TicketCategory::all();
        $statuses = TicketStatus::all();

        return view('reports.index', compact('tickets', 'categories', 'statuses'));
    }

}
