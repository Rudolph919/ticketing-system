<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use App\Models\PersonalDetail;

class QueryController extends Controller
{

    public function index()
    {
        return view('query.index');
    }

    public function animalLovers()
    {
        $query = PersonalDetail::whereHas('interests', function ($query) {
                $query->where('interest', 'Animals');
            })
            ->has('documents', '=', 1)
            ->get();

        return view('query.index')->with(['query' => $query]);
    }

    public function childrenSportLovers()
    {
        $query = PersonalDetail::whereHas('interests', function ($query) {
                $query->whereIn('interest', ['Children', 'Sport']);
            })
            ->get();

        return view('query.index')->with(['query' => $query]);
    }

    public function uniqueInterestWithoutDocuments()
    {
        $query = PersonalDetail::doesntHave('documents')
            ->with('interests')
            ->select('interest')
            ->distinct()
            ->withCount('interests')
            ->get();

        return view('query.index')->with(['query' => $query]);
    }

    public function peopleWithMultipleDocuments()
    {
        $query = PersonalDetail::whereHas('interests.documents', function ($query) {
                $query->groupBy('interest_id')
                    ->havingRaw('COUNT(*) >= 2');
            })
            ->withCount(['interests.documents' => function ($query) {
                $query->whereNotNull('file_path');
            }])
            ->get();

        return view('query.index')->with(['query' => $query]);
    }
}
