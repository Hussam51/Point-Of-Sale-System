<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:client-list|client-create|client-edit|client-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:client-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:client-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:client-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {

        $data = Client::when($request->search,function($q) use($request){

            return $q->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('phone','LIKE','%'.$request->search.'%')
            ->orWhere('address','LIKE','%'.$request->search.'%');

        })->latest()->paginate(5);



        return view('layouts.dashboard.clients.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('layouts.dashboard.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'phone.0' => 'required',
            'address' => 'required|string',

        ]);


        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone); //filter all data that be null or false
        Client::create($request_data);
        return redirect()->route('clients.index')
            ->with('success', 'client created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('layouts.dashboard.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        return view('layouts.dashboard.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $client = Client::find($id);




        //   $input = $request->except('name_en', 'name_ar');

        $request->validate([
            'name' => 'required',
            'phone.0' => 'required',
            'address' => 'required|string',

        ]);


        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone); //filter all data that be null or false
        $client->update($request_data);
        return redirect()->route('clients.index')
            ->with('success', 'client created successfully');

        return redirect()->route('clients.index')
            ->with('success', 'client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $client = Client::find($id);
        //delete image
        //  Storage::disk('public')->delete($product->image_path);
        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'client deleted successfully');
    }
}
