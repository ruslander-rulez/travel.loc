<?php
namespace App\Http\Controllers\Dashboard;


class RootController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        return view("dashboard.root.index");
    }
}