<?php
namespace App\Services\Pages;
use App\Models\Pages\Service;
use Illuminate\Support\Arr;

class ServiceService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){

        if(Arr::has($data, 'image1')){
            $data['image1'] = (Arr::pull($data, 'image1'));
            $data['image1'] = (Arr::pull($data, 'image1'))->store('services');
        }
        
        if(Arr::has($data, 'image2')){
            $data['image2'] = (Arr::pull($data, 'image2'));
            $data['image2'] = (Arr::pull($data, 'image2'))->store('services');
        }

        Service::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, $id){

        if(Arr::has($data, 'image1')){
            $data['image1'] = (Arr::pull($data, 'image1'));
            $data['image1'] = (Arr::pull($data, 'image1'))->store('services');
        }
        
        if(Arr::has($data, 'image2')){
            $data['image2'] = (Arr::pull($data, 'image2'));
            $data['image2'] = (Arr::pull($data, 'image2'))->store('services');
        }
        
        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        Service::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        Service::where('id',$id)->delete();
    }
}
