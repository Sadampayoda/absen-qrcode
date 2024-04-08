<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function user(Request $request)
    {
        $data =  User::where('name', 'like', '%' . $request->search . '%')->paginate(10);
        if ($request->search == '') {
            $data = User::paginate(10);
        }
        return view('admin.user.search', [
            'data' => $data,
            'active' => 'user-manejement'
        ]);
    }
}
