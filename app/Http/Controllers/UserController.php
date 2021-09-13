<?php

namespace App\Http\Controllers;

use App\Models\TuttiUser;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TuttiUser::orderBy('created_at', 'DESC')->get();
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
     * @return TuttiUser
     */
    public function store(Request $request)
    {
        $newUser = new TuttiUser();
        $newUser->fullName = $request->user['fullName'];
        $newUser->email = $request->user['email'];
        $newUser->password = $request->user['password'];
        $newUser->birthday = $request->user['birthday'];
        $newUser->userType = $request->user['userType'];
        $newUser->isPremium = $request->user['isPremium'];

        $newUser->save();

        return $newUser;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        $exisitingItem = TuttiUser::find($id);
        if ($exisitingItem) {
            $exisitingItem->delete();
            return "Item deleted";
        }

        return "Item not found";
    }
}
