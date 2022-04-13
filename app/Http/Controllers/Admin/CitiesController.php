<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cities\StoreCityRequest;
use App\Http\Requests\Admin\Cities\UpdateCityRequest;

class CitiesController extends Controller
{
    const STATSES = ['مفعل التوصيل'=>1 , 'غير مفعل التوصيل'=> 0 ];
    public function index(){
        $cities = City::all();
        return view('Admin.cities.index',compact('cities'));
    }

    public function create(){
        return view('Admin.cities.create',['statuses'=>self::STATSES]);
    }

    public function store(StoreCityRequest $request){
        City::create($request->validated());
        return redirectAccordingToRequest($request,'success');



    }

    public function edit($id){
        $city = City::findOrFail($id);
        return view('Admin.cities.edit',['statuses'=>self::STATSES,'city'=>$city]);
    }

    public function update(UpdateCityRequest $request,$id){
        // dd($request->all());
        City::findOrFail($id)->update($request->validated());

        return redirect()->route('cities.index')->with('success','تمت العمليه بنجاح');

    }
    public function destroy($id){
        City::findOrFail($id)->delete();
        return redirect()->back()->with('success','تمت العمليه بنجاح');


    }
}
