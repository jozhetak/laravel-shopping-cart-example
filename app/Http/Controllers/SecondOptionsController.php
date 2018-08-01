<?php

namespace App\Http\Controllers;

use App\SecondOption;
use App\SecondOptionGroup;
use Illuminate\Http\Request;
use App\Http\Requests\OptionRequest;

class SecondOptionsController extends Controller
{
    public function index(Request $request)
    {
        $optionGroups = SecondOptionGroup::with('options')->get();
        $action = $request->path();

        if ($request->wantsJson()) {
            return response([$optionGroups], 200);
        }

        return view('admin.addOptions', compact('action'));
    }

    public function store(OptionRequest $request)
    {
        try {
            $option = SecondOption::create([
                'name' => request('name'),
                'second_option_group_id' => request('option_group_id')
            ]);

            return response(['ok'], 200);

        } catch (\Exception $e) {
            return back()->with(['error_message' => $e->getMessage() ]);
        }
    }

    public function destroy($id)
    {
        $option = SecondOption::where('id', $id)->firstOrFail();

        $option->delete();

        return response(['ok'], 200);
    }
}
