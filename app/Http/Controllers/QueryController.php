<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use App\Models\PersonalDetail;
use Illuminate\Support\Facades\DB;

class QueryController extends Controller
{

    public function index()
    {
        return view('query.index');
    }

    public function animalLovers()
    {
        $query = PersonalDetail::whereHas('interests', function ($query) {
            $query->where('name', 'Animals');
        })->has('documents', '=', 1)->paginate(5);

        $data = [
            'query' => $query,
            'filter' => 'Animal lovers with 1 document'
        ];

        return view('query.index')->with($data);
    }

    public function childrenSportLovers()
    {
        $query = PersonalDetail::whereHas('interests', function ($query) {
            $query->whereIn('name', ['Children', 'Sports']);
        })->paginate(5);

        $data = [
            'query' => $query,
            'filter' => 'Children and sport lovers'
        ];

        return view('query.index')->with($data);
    }

    public function uniqueInterestWithoutDocuments()
    {
        $query = PersonalDetail::leftJoin('interest_personal_detail', 'personal_details.id', '=', 'interest_personal_detail.personal_detail_id')
            ->leftJoin('interests', 'interest_personal_detail.interest_id', '=', 'interests.id')
            ->leftJoin('documents', 'personal_details.id', '=', 'documents.personal_detail_id')
            ->whereNull('documents.id')
            ->select('interests.name', DB::raw('COUNT(DISTINCT personal_details.id) as count'))
            ->groupBy('interests.name')
            ->paginate(5);

            $data = [
                'query' => $query,
                'filter' => 'Unique interests without documents',
                'interestCount' => true,
            ];

        return view('query.index')->with($data);
    }

    public function peopleWithMultipleDocuments()
    {
        $query = PersonalDetail::whereHas('interests', function ($query) {
            $query->has('documents', '>', 1);
        })
        ->withCount('interests')
        ->having('interests_count', '>=', 5)
        ->having('interests_count', '<=', 6)
        ->paginate(5);

        $data = [
            'query' => $query,
            'filter' => 'People with multiple documents'
        ];

        return view('query.index')->with($data);
    }
}
