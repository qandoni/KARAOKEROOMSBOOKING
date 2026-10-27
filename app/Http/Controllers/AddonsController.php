<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AddonsController extends Controller
{
    public function index()
    {
        $addons = Addon::orderBy('sort_order')->get();

        return view('addons.index', compact('addons'));
    }

    public function create()
    {
        return view('addons.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_active'] = request()->has('is_active');

        Addon::create($data);

        return redirect()->route('addons.index');
    }

    public function edit(Addon $addon)
    {
        return view('addons.edit', compact('addon'));
    }

    public function update(Request $request, Addon $addon): RedirectResponse
    {
        $data = $request->all();
        $data['is_active'] = request()->has('is_active');

        $addon->update($data);
        return redirect()->route('addons.index');
    }


    public function destroy(Addon $addon)
    {
        $addon->update(['is_active' => false]);

        return redirect()->route('addons.index');
    }
}
