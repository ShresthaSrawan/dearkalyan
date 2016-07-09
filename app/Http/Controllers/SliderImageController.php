<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderImageRequest;
use App\SliderImage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class SliderImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = "Create";
        return view('slider-images.form', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SliderImageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderImageRequest $request)
    {
        DB::transaction(function() use ($request) {
            $inputs = $request->all();
            $inputs['slug'] = str_slug($inputs['title']);
            $sliderImage = SliderImage::create($inputs);
            $sliderImage->image()->create([])->setPath($request->file('image'));
        });
        return redirect()->back()->withSuccess('Slider added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SliderImage $slider)
    {
        $type = "Edit";
        return view('slider-images.form', compact('slider', 'type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SliderImage $slider)
    {
        DB::transaction(function() use ($request, $slider) {
            $inputs = $request->all();
            $inputs['slug'] = str_slug($inputs['title']);
            $slider->update($inputs);
            if($request->hasFile('image')) {
                if(!is_null($slider->image))
                    $slider->image()->delete();
                $slider->image()->create([])->setPath($request->file('image'));
            }
        });
        return redirect()->back()->withSuccess('Slider added!');
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
