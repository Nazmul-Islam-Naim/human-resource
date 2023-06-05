<?php
namespace App\Services\SiteSettings;
use App\Models\SiteSettings\Slider;
use Illuminate\Support\Arr;

class SliderService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){
        
        if(Arr::has($data, 'image1')){
            $data['image1'] = (Arr::pull($data, 'image1'));
            $data['image1'] = (Arr::pull($data, 'image1'))->store('sliders');
        }

        if(Arr::has($data, 'image2')){
            $data['image2'] = (Arr::pull($data, 'image2'));
            $data['image2'] = (Arr::pull($data, 'image2'))->store('sliders');
        }

        if(Arr::has($data, 'image3')){
            $data['image3'] = (Arr::pull($data, 'image3'));
            $data['image3'] = (Arr::pull($data, 'image3'))->store('sliders');
        }

        Slider::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, $id){
        if(Arr::has($data, 'image1')){
            $data['image1'] = (Arr::pull($data, 'image1'));
            $data['image1'] = (Arr::pull($data, 'image1'))->store('sliders');
        }

        if(Arr::has($data, 'image2')){
            $data['image2'] = (Arr::pull($data, 'image2'));
            $data['image2'] = (Arr::pull($data, 'image2'))->store('sliders');
        }

        if(Arr::has($data, 'image3')){
            $data['image3'] = (Arr::pull($data, 'image3'));
            $data['image3'] = (Arr::pull($data, 'image3'))->store('sliders');
        }

        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        Slider::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        Slider::where('id',$id)->delete();
    }
}
