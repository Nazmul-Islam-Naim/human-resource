<?php
namespace App\Services\SiteSettings;
use App\Models\SiteSettings\Contact;
use Illuminate\Support\Arr;

class ContactService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){
        Contact::create($data);
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

        Contact::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        Contact::where('id',$id)->delete();
    }
}
