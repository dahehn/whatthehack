<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use function Sodium\add;
use Symfony\Component\Routing\Matcher\RedirectableUrlMatcher;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try {
            $classrooms = Classroom::all();
        }
        catch (Exception $ex){
            return redirect('classroom.index')->withErrors("No db");
        }
        return view('classroom.index')->with('classrooms',$classrooms);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $classroom = new Classroom();
            $classroom->id = $request->id;
            $user = Auth::user();
            $this->validate($request,[
                'name' => 'required',
                'add_Students'=>'required',
            ]);
            $classroom->classroom_name = $request->name;
            $classroom->classroom_owner=$user->getAuthIdentifier();

            $addStudents = $request->input('add_Students');
            $classroom->save();
            foreach ($addStudents as $student){
                $classroom->users()->attach($student);
            }
            $classroom->users()->attach($user->getAuthIdentifier());

            return redirect()->route('home');
        }
        catch (Exception $ex)
        {
            return redirect()->route('classroom.create')->withErrors("Cannot create because of error: " . $ex. "!");
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
    public function myClassrooms(){
        $classrooms = Auth::user()->classrooms;
        return view('classroom.myclassrooms')->with('classrooms', $classrooms);
    }

    public function edit($id)
    {
        $classroom = Classroom::find($id);

        if ($classroom != null) {
            return view('classroom.edit')->with('classroom', $classroom);
        }
        else {
            return redirect()->route('classroom.index')
                ->withErrors('Classroom with id=' . $id . ' not found!');
        }
    }

    public function editMembers($id){

    }

    public function editChallenges($id){
        $classroom = Classroom::find($id);

        if ($classroom != null) {
            return view('classroom.editChallenges')->with('classroom', $classroom);
        }
        else {
            return redirect()->route('classroom.myClassrooms')
                ->withErrors('Classroom with id=' . $id . ' not found!');
        }
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
        $classroom = Classroom::find($id);
        $classroom->classroom_name = $request->name;
        $classroom->save();
        return redirect()->route('classroom.myclassrooms');
    }

    public function updateMembers(Request $request, $id){

    }

    public function updateChallenges(Request $request, $id){

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
    //Associate a multitude of challenges with a classroom
    public function attach(Request $request, $id)
    {
        $classroom = Classroom::find($id);
        $this->validate($request,[
            'add_Challenges'=>'required',
        ]);
        $challenges = $request->input('add_Challenges');

        foreach ($challenges as $c)
        {
           $classroom->challenges()->attach($c);
        }
        return redirect()->route('classroom.myclassrooms');
    }

    public function detach(Request $request,$id){
        $classroom = Classroom::find($id);

        $challenges = $request->input('remove_Challenges');

        foreach ($challenges as $c){
            $classroom->challenges()->detach($c);
        }
        return redirect()->route('classroom.myclassrooms');
    }

}
