<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Psize;
use App\Product;
use Illuminate\Support\Str;

class PsizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $psizes = Psize::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $psizes = $psizes->where('name', 'like', '%'.$sort_search.'%');
        }
        $psizes = $psizes->paginate(15);
        return view('psizes.index', compact('psizes', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('psizes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Psize = new Psize;
        $Psize->name = $request->name;
        if($Psize->save()){
            flash(translate('Psize has been inserted successfully'))->success();
            return redirect()->route('psizes.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $psizes = Psize::findOrFail(decrypt($id));
        return view('psizes.edit', compact('psizes'));
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
        $Psize = Psize::findOrFail($id);
        $Psize->name = $request->name;
        
        if($Psize->save()){
            flash(translate('Psize has been updated successfully'))->success();
            return redirect()->route('psizes.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Psize = Psize::findOrFail($id);
        if(Psize::destroy($id)){
            flash(translate('Psize has been deleted successfully'))->success();
            return redirect()->route('psizes.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }
}
