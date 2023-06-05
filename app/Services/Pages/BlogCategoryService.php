<?php
namespace App\Services\Pages;
use App\Models\Pages\BlogCategory;
use Illuminate\Support\Arr;

class BlogCategoryService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){

        BlogCategory::create($data);
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

        BlogCategory::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        BlogCategory::where('id',$id)->delete();
    }
}
