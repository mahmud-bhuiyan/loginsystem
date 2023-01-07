<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complete;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $completes = Complete::orderby('id', 'desc')->where('status', '2')->get();

        return view('admin.Complete', compact('completes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'amount' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'amount' => $request->amount,
        ];

        Complete::create($data);

        $notify = [
            'message' => 'Order Placed Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notify);
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
        //
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
        $complete = Complete::find($id);

        $request->validate([
            // 'name' => 'required|unique:categories,name,'. $category->id .'|max:255',
            // 'description' => 'required',
            'status' => 'required',
        ]);

        $data = [
            // 'name' => $request->name,
            // 'description' => $request->description,
            'status' => $request->status,
        ];

        $complete->update($data);

        $notify = [
            'message' => 'Order Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notify);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
