<?php
namespace App\Services\Pages;
use App\Models\Pages\ServiceType;
use Illuminate\Support\Arr;

class ServiceTypeService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){

        ServiceType::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, $id){

        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        ServiceType::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        ServiceType::where('id',$id)->delete();
    }
}
