<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Brands\StoreBrandRequest;
use App\Http\Requests\Admin\Brands\UpdateBrandRequest;

class BrandsController extends Controller
{
    const STATSES = ['مفعل'=>1 , 'غير مفعل'=> 0 ];
    const AVAILABLE_EXTENTION = ['png','jpg','jpeg'];

    public function index(){
        $brands = Brand::all();
        return view('Admin.brands.index',compact('brands'));
    }

    public function create(){
        return view('Admin.brands.create',['statuses'=>self::STATSES]);
    }

    public function store(StoreBrandRequest $request){
        // $path = $request->file('image')->storeAs('brands',$request->file('image')->hashName());
        // dd(Storage::url($path));
        // dd(asset('storage/'.$path));
        // dd($request->all());
        $brand=Brand::create($request->validated());
        $brand->addMediaFromRequest('image')->toMediaCollection('brands');
        if($request->has('resize')){
            Image::make($brand->getFirstMediaPath('brands'))->resize($request->width,$request->height)->save($brand->getFirstMediaPath('brands'));

        }

        return redirectAccordingToRequest($request,'success');



    }

    public function edit(Brand $brand){

        // dd(url($brand->getFirstMediaUrl('images')));
        return view('Admin.brands.edit',['statuses'=>self::STATSES,'brand'=>$brand]);
    }

    public function update(UpdateBrandRequest $request,Brand $brand){
        // dd($request->all());
        $brand->update($request->validated());
        if($request->hasFile('image')){
            $media = $brand->getMedia('brands');
            $media[0]->delete();
            $brand->addMediaFromRequest('image')->toMediaCollection('brands');


        }
        if($request->has('resize')){
            $brand =Brand::find($brand->id);
            Image::make($brand->getFirstMediaPath('brands'))->resize($request->width,$request->height)->save($brand->getFirstMediaPath('brands'));

        }

        return redirect()->route('brands.index')->with('success','تمت العمليه بنجاح');

    }
    public function destroy(Brand $brand){
        $brand->delete();
        return redirect()->back()->with('success','تمت العمليه بنجاح');


    }
}
