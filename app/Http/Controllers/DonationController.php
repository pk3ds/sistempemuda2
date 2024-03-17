<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Donations/Index', [
            'filters' => Request::all('search'),
            'donations' => Donation::select('*')
                ->orderBy('created_at')
                ->filter(Request::only('search'))
                ->paginate(5)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Donations/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDonationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Request::validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'target' => 'required|decimal:2|min:1'
        ]);
        
        Request::merge(['uuid' => Str::uuid()->toString()]);
        $donation = Donation::create(Request::only('uuid', 'name', 'description', 'target'));
        return redirect()
            ->route('donations')
            ->with('success', 'Donation "' . $donation->name . ' "created');
        // dd($validated);
        
        // Request::validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'nullable|string|max:255',
        //     'target' => 'required|decimal:2|min:1'
        // ]);

        // $donations = Request::merge(['uuid' => Str::uuid()->toString()]);
        // dd($donations);
        // $donation = Donation::create(Request::only('uuid', 'name', 'description', 'target'));
        // return redirect()
        //     ->route('donations')
        //     ->with('success', 'Donation "' . $donation->name . ' "created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        return Inertia::render('Donations/Edit', [
            'donation' => $donation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonationRequest  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        $validated = Request::validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255|',
            'target' => 'required|decimal:2|min:1'
        ]);
        
        $donation->update($validated);


        return redirect()
            ->back()
            ->with('success', 'Donation "' . $donation->name . '" updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
