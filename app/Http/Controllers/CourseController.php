<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Price;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$courses = Course::all();
        if(auth()->user()->id==1){
            $courses = Course::all();
        }
        else
        {
            $courses = Course::where('user_id',auth()->user()->id)->get();
        }
        
        
        return view('courses.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'user_id' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

  
        if ($img = $request->file('img')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $img->getClientOriginalExtension();
            $img->move($destinationPath, $profileImage);
            $validatedData['img'] = "$profileImage";
        }

        $show = Course::create($validatedData);

        
        $precio=$request->precio;
        $pais=$request->pais;
        $simbolo=$request->simbolo;
        $g=0;
        
        foreach($precio as $p){
            if($pais[$g]!='' && $p!='' && $simbolo[$g]!=''){
                Price::insert(['course_id'=>$show->id,'pais'=>$pais[$g],'price'=>$p,'simbolo'=>$simbolo[$g]]);
                $g++;
            }
        }
   
   
        return redirect('/courses')->with('success', 'Curso creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
 
        return view('courses.show', [
            'course' => $course
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $price = Price::where('course_id',$id)->get();

        return view('courses.edit', compact('course','price'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required'
        ]);


        if ($img = $request->file('img')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $img->getClientOriginalExtension();
            $img->move($destinationPath, $profileImage);
            $validatedData['img'] = "$profileImage";
        }else{
            unset($validatedData['img']);
        }

        Course::whereId($id)->update($validatedData);


        $pricex = Price::where('course_id',$id)->get();
        $pricex->each->delete();
        $precio=$request->precio;
        $pais=$request->pais;
        $simbolo=$request->simbolo;
        $g=0;

        foreach($precio as $p){
            if($pais[$g]!='' && $p!='' && $simbolo[$g]!=''){
                Price::insert(['course_id'=>$id,'pais'=>$pais[$g],'price'=>$p,'simbolo'=>$simbolo[$g]]);
                $g++;
            }
        }
        


        return redirect('/courses')->with('success', 'Curso actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect('/courses')->with('success', 'Curso eliminado correctamente');
    }

    public function GetPrecio($id){
      
        if ($_SERVER['REMOTE_ADDR']=='::1') $ipuser= ''; else $ipuser= $_SERVER['REMOTE_ADDR'];
        $geoPlugin_array = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ipuser) );
        $pais=$geoPlugin_array['geoplugin_countryName'];

        $pricex = Price::where('course_id',$id)->where('pais', $pais)->get();

        if(count($pricex)>0){
            foreach($pricex as $pric){
                echo $pric->price.' '.$pric->simbolo;
            }
        }
        else
        {
            $pricex = Price::where('course_id',$id)->where('pais', 'Estados unidos')->get();
            foreach($pricex as $pric){
                echo $pric->price.' '.$pric->simbolo;
            }
        }
        


    }
}
