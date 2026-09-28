<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\workSite;
use Jcf\Geocode\Facades\Geocode;

class WorkSiteController extends Controller
{
    /**
     * Show the map with all work sites.
     */
    public function index()
    {
        $workSites = workSite::all();
        return view('work-sites.map', compact('workSites'));
    }

    /**
     * Show the form to add a new work site.
     */
    public function create()
    {
        return view('work-sites.add-site');
    }

    /**
     * Geocode the address and save the work site.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name'    => 'required|string|max:255',
    //         'address' => 'required|string|max:500',
    //     ]);

    //     // Use the jcf/geocode package to get coordinates
    //     $result = Geocode::address($request->address);

    //     // If geocoding fails, redirect back with an error
    //     if (!$result) {
    //         return back()
    //             ->withInput()
    //             ->withErrors(['address' => 'Could not find that address. Please try a more specific location.']);
    //     }

    //     // Save the work site with the returned data
    //     workSite::create([
    //         'name'      => $request->name,
    //         'address'   => $result->formattedAddress,
    //         'latitude'  => $result->latitude,
    //         'longitude' => $result->longitude,
    //     ]);

    //     return redirect()
    //         ->route('map.index')
    //         ->with('success', 'Work site added successfully!');
    // }


    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:500',
        ]);

        $apiKey = env('LOCATIONIQ_API_KEY');

        if (!$apiKey) {
            return back()->withInput()->withErrors(['address' => 'LocationIQ API key is not configured.']);
        }

        // Call LocationIQ Geocoding API
        $response = \Illuminate\Support\Facades\Http::get(
            'https://us1.locationiq.com/v1/search.php',
            [
                'key' => $apiKey,
                'q'   => $request->address,
                'format' => 'json',
                'limit'  => 1,
            ]
        );

        if ($response->failed() || empty($response->json())) {
            return back()->withInput()->withErrors(['address' => 'Could not find that address. Please try a more specific location.']);
        }

        $result = $response->json()[0];

        WorkSite::create([
            'name'      => $request->name,
            'address'   => $result['display_name'],
            'latitude'  => $result['lat'],
            'longitude' => $result['lon'],
        ]);

        return redirect()->route('map.index')->with('success', 'Work site added successfully!');
    }
}