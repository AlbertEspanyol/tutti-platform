<?php

namespace App\Http\Controllers;

use App\Models\TuttiUser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Any;

class AccessController extends Controller
{
    private function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);

        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('access');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View|Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     * @param String $mode
     * @return Application|Factory|View|Response
     */
    public function show($mode)
    {
        $users = app('App\Http\Controllers\UserController')->index();
        return view("access")->with('users', $users)->with('mode', $mode);
    }

    public function showStep2($id)
    {
        $user = TuttiUser::find($id);
        return view("registerStep2")->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param String  $mode
     * @param Any $extras
     * @return Response
     */
    public function update(Request $request, $mode, $extras)
    {
        $this->debug_to_console($mode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
