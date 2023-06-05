<?php
namespace App\Services\Pages;
use App\Models\Pages\ProjectType;
use Illuminate\Support\Arr;

class ProjectTypeService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){

        ProjectType::create($data);
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

        ProjectType::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        ProjectType::where('id',$id)->delete();
    }
}
