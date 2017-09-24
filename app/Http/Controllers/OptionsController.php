<?php

namespace App\Http\Controllers;

use App\User;
use App\Option;
use App\OptionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OptionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if( ! Auth::user()->isAdmin()){
            return view('layouts.shop')->with('error_message', 'Page not found');
        }
        $optionGroups = OptionGroup::all();
        return view('layouts.addOptions', compact('optionGroups'));
    }

    public function store(Request $request)
    {
        if( ! Auth::user()->isAdmin()){
            return view('layouts.shop')->with('error_message', 'Page not found');
        }

        try {
            $this->validate($request, [
                'name' => 'required',
                'option_group_id' => 'required'
            ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        try {
            Option::create([
                'name' => request('name'),
                'option_group_id' => request('option_group_id')
            ]);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }

        return back()->with('success_message', 'Option added');

    }
}