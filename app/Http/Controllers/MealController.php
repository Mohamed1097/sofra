<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $meals=new Meal();
        $message=null;
        if ($request->name) {
            $meals=$meals->where('name','like','%'.$request->name.'%');
        }
        if (!$meals->count()) {
            $message='There Is No Meals';
        }
        return view('meals.index',['title'=>'Meals','meals'=>$meals->paginate(),'message'=>$message]);
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
        //
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $meal=Meal::findOrFail($id);
        if ($meal->orders()->where('status','pending')->OrWhere('status','accepted')->count()) {
            return responseJson(0,'لا تستطيع حذف هذه الوجبه حاليا');
        }
        $meal->delete();
        return responseJson(1,'تم مسح الوجبه بنجاح');
        
    }
}