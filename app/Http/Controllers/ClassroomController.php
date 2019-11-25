<?php

namespace App\Http\Controllers;

use App\Classroom;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use function Sodium\add;

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
        $students="";
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
            $lenght=sizeOf($addStudents)-1;
            foreach ($addStudents as $student){
                if($lenght>0)
                    $students=$students.$student.",";
                else
                    $students=$students.$student;
                $lenght--;
            }
            $classroom->member = $students;
            $classroom->save();
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
        foreach (Classroom::all() as $classroom){
            if ($classroom->members.containsString(Auth::id())){
                echo $classroom->name;
            }
        }
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
