<?php
namespace App\Services\Pages;
use App\Models\Pages\AboutUs;
use Illuminate\Support\Arr;

class AboutUsService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){
        
        if(Arr::has($data, 'slider_image')){
            $data['slider_image'] = (Arr::pull($data, 'slider_image'));
            $data['slider_image'] = (Arr::pull($data, 'slider_image'))->store('about-us');
        }
        
        if(Arr::has($data, 'image1')){
            $data['image1'] = (Arr::pull($data, 'image1'));
            $data['image1'] = (Arr::pull($data, 'image1'))->store('about-us');
        }

        if(Arr::has($data, 'image2')){
            $data['image2'] = (Arr::pull($data, 'image2'));
            $data['image2'] = (Arr::pull($data, 'image2'))->store('about-us');
        }

        AboutUs::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, $id){
        
        if(Arr::has($data, 'slider_image')){
            $data['slider_image'] = (Arr::pull($data, 'slider_image'));
            $data['slider_image'] = (Arr::pull($data, 'slider_image'))->store('about-us');
        }
        
        if(Arr::has($data, 'image1')){
            $data['image1'] = (Arr::pull($data, 'image1'));
            $data['image1'] = (Arr::pull($data, 'image1'))->store('about-us');
        }

        if(Arr::has($data, 'image2')){
            $data['image2'] = (Arr::pull($data, 'image2'));
            $data['image2'] = (Arr::pull($data, 'image2'))->store('about-us');
        }

        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        AboutUs::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        AboutUs::where('id',$id)->delete();
    }
}
