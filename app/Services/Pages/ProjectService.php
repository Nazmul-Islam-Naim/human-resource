<?php
namespace App\Services\Pages;
use App\Models\Pages\Project;
use Illuminate\Support\Arr;

class ProjectService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){
        
        if(Arr::has($data, 'image')){
            $data['image'] = (Arr::pull($data, 'image'));
            $data['image'] = (Arr::pull($data, 'image'))->store('projects');
        }
        
        if(Arr::has($data, 'image1')){
            $data['image1'] = (Arr::pull($data, 'image1'));
            $data['image1'] = (Arr::pull($data, 'image1'))->store('projects');
        }
        
        if(Arr::has($data, 'image2')){
            $data['image2'] = (Arr::pull($data, 'image2'));
            $data['image2'] = (Arr::pull($data, 'image2'))->store('projects');
        }
        
        if(Arr::has($data, 'image3')){
            $data['image3'] = (Arr::pull($data, 'image3'));
            $data['image3'] = (Arr::pull($data, 'image3'))->store('projects');
        }
        
        if(Arr::has($data, 'image4')){
            $data['image4'] = (Arr::pull($data, 'image4'));
            $data['image4'] = (Arr::pull($data, 'image4'))->store('projects');
        }

        Project::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, $id){
        
        if(Arr::has($data, 'image')){
            $data['image'] = (Arr::pull($data, 'image'));
            $data['image'] = (Arr::pull($data, 'image'))->store('projects');
        }
 
        if(Arr::has($data, 'image1')){
            $data['image1'] = (Arr::pull($data, 'image1'));
            $data['image1'] = (Arr::pull($data, 'image1'))->store('projects');
        }
        
        if(Arr::has($data, 'image2')){
            $data['image2'] = (Arr::pull($data, 'image2'));
            $data['image2'] = (Arr::pull($data, 'image2'))->store('projects');
        }
        
        if(Arr::has($data, 'image3')){
            $data['image3'] = (Arr::pull($data, 'image3'));
            $data['image3'] = (Arr::pull($data, 'image3'))->store('projects');
        }
        
        if(Arr::has($data, 'image4')){
            $data['image4'] = (Arr::pull($data, 'image4'));
            $data['image4'] = (Arr::pull($data, 'image4'))->store('projects');
        }
        
        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        Project::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        Project::where('id',$id)->delete();
    }
}
