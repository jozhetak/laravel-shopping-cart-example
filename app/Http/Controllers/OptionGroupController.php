<?php

namespace App\Http\Controllers;

use App\User;
Use App\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionGroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('layouts.addOptionGroup');
    }

    public function store(Request $request)
    {
        try {
        $this->validate($request, [
            'name' => 'required'
        ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try {
        OptionGroup::create([
            'name' => request('name')
        ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        return back()->with('success_message', 'Option Group added');

    }
}
