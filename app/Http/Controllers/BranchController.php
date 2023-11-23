<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:admin-access");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return view('admin-dashboard.branches.index', ['branches' => $branches]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-dashboard.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request_data = $request->all();
        Branch::create($request_data);
        // return to_route("branches.index");
        return redirect(url('admin/dashboard/branches/'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('admin-dashboard.branches.edit', ['branch' => $branch]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $branch->update($request->all());
        // return to_route('branches.index');
        return redirect(url('admin/dashboard/branches/'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect(url('admin/dashboard/branches/'));
    }
}
