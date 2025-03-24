<?php

namespace App\Http\Controllers;

use App\Models\Record; // Assuming this model exists
use Illuminate\Http\Request;

class RecordController extends Controller
{
    // ...existing code if any...

    public function index()
    {
        // Return view for listing records
        return view('records.index');
    }

    public function getRecords(Request $request)
    {
        $columns = ['id', 'name', 'email'];
        $totalData = Record::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = $columns[$orderColumnIndex] ?? 'id';
        $orderDir = $request->input('order.0.dir') ?? 'asc';
        $search = $request->input('search.value');

        $query = Record::query();
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        $totalFiltered = $query->count();

        $records = $query->offset($start)
            ->limit($limit)
            ->orderBy($orderColumn, $orderDir)
            ->get();

        $data = [];
        foreach ($records as $record) {
            $data[] = [
                'id'    => $record->id,
                'name'  => $record->name,
                'email' => $record->email,
            ];
        }

        return response()->json([
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data,
        ]);
    }
}
