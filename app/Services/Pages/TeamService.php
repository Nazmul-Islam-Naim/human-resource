<?php
namespace App\Services\Pages;
use App\Models\Pages\Team;
use Illuminate\Support\Arr;

class TeamService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){
        
        if(Arr::has($data, 'image')){
            $data['image'] = (Arr::pull($data, 'image'));
            $data['image'] = (Arr::pull($data, 'image'))->store('teams');
        }
        
        Team::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, $id){
        
        if(Arr::has($data, 'image')){
            $data['image'] = (Arr::pull($data, 'image'));
            $data['image'] = (Arr::pull($data, 'image'))->store('teams');
        }

        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        Team::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        Team::where('id',$id)->delete();
    }
}
