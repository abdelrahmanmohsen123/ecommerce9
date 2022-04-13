<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Models;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Models\StoreModelRequest;
use App\Http\Requests\Admin\Models\UpdateModelRequest;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class ModelsController extends Controller
{
    const STATSES = ['مفعل'=>1 , 'غير مفعل'=> 0 ];
    const AVAILABLE_EXTENTION = ['png','jpg','jpeg'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Models::all();
        return view('Admin.models.index',['models'=>$models]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands =Brand::all();
        return view('Admin.models.create',['statuses'=>self::STATSES,'brands'=>$brands]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModelRequest $request)
    {
        $model=Models::create($request->validated());
        $model->addMediaFromRequest('image')->toMediaCollection('models');
        if($request->has('resize')){
            Image::make($model->getFirstMediaPath('models'))->resize($request->width,$request->height)->save($model->getFirstMediaPath('models'));

        }

        return redirectAccordingToRequest($request,'success');
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
    public function edit(Models $model)
    {
        $brands = Brand::all();
        return view('Admin.models.edit',['statuses'=>self::STATSES,'brands'=>$brands,'model'=>$model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModelRequest $request, Models $model)
    {
        $model->update($request->validated());
        if($request->hasFile('image')){
            $media = $model->getMedia('models');
            $media[0]->delete();
            $model->addMediaFromRequest('image')->toMediaCollection('models');


        }
        if($request->has('resize')){
            $model =Models::find($model->id);
            Image::make($model->getFirstMediaPath('models'))->resize($request->width,$request->height)->save($model->getFirstMediaPath('brands'));

        }
        return redirect()->route('models.index')->with('success','تمت العمليه بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Models $model)
    {
            $model->delete();
            return redirect()->back()->with('success','تمت العمليه بنجاح');
    
    }
}
