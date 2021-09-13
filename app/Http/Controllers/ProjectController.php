<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectController extends Controller
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return Project::orderBy('created_at', 'DESC')->get();
    }

    public function biggestId()
    {
        return Project::orderBy('id', 'DESC')->take(1)->get();
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
     * @return Project
     */
    public function store(Request $request)
    {
        $newProject = new Project;
        $newProject->title = $request->project['title'];
        $newProject->subtitle = $request->project['subtitle'];
        $newProject->location = $request->project['location'];
        $newProject->members = $request->project['members'];
        $newProject->financedState = $request->project['financedState'];
        $newProject->projectState = $request->project['projectState'];
        $newProject->needInvestment = $request->project['needInvestment'];
        $newProject->needRecruitment = $request->project['needRecruitment'];
        $newProject->stake = $request->project['stake'];
        $newProject->budget = $request->project['budget'];
        $newProject->currentCash = $request->project['currentCash'];
        $newProject->tags = $request->project['tags'];
        $newProject->images = $request->project['images'];
        $newProject->isOnline = $request->project['isOnline'];
        $newProject->introduction = $request->project['introduction'];
        $newProject->description = $request->project['description'];
        $newProject->partnerConditions = $request->project['partnerConditions'];
        $newProject->investmentNeeds = $request->project['investmentNeeds'];

        $newProject->save();

        return $newProject;
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
     * @param Request  $request
     * @param int $id
     * @return string
     */
    public function update(Request $request, int $id)
    {
        Project::find($id)->update([
            'title' => $request->project['title'],
            'subtitle' => $request->project['subtitle'],
            'location' => $request->project['location'],
            'members' => $request->project['members'],
            'financedState' => $request->project['financedState'],
            'projectState' => $request->project['projectState'],
            'needInvestment' => $request->project['needInvestment'],
            'needRecruitment' => $request->project['needRecruitment'],
            'stake' => $request->project['stake'],
            'budget' => $request->project['budget'],
            'currentCash' => $request->project['currentCash'],
            'tags' => $request->project['tags'],
            'images' => $request->project['images'],
            'isOnline' => $request->project['isOnline'],
            'introduction'=> $request->project['introduction'],
            'description' => $request->project['description'],
            'partnerConditions' => $request->project['partnerConditions'],
            'investmentNeeds' => $request->project['investmentNeeds']
        ]);

        return 'updated';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        $exisitingItem = Project::find($id);
        if ($exisitingItem) {
            $exisitingItem->delete();
            return "Item deleted";
        }

        return "Item not found";
    }
}
