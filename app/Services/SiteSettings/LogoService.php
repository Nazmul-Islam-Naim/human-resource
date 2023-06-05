<?php
namespace App\Services\SiteSettings;
use App\Models\SiteSettings\Logo;
use Illuminate\Support\Arr;

class LogoService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){
        
        if(Arr::has($data, 'header_logo')){
            $data['header_logo'] = (Arr::pull($data, 'header_logo'));
            $data['header_logo'] = (Arr::pull($data, 'header_logo'))->store('logos');
        }

        if(Arr::has($data, 'footer_logo')){
            $data['footer_logo'] = (Arr::pull($data, 'footer_logo'));
            $data['footer_logo'] = (Arr::pull($data, 'footer_logo'))->store('logos');
        }

        if(Arr::has($data, 'fav_icon')){
            $data['fav_icon'] = (Arr::pull($data, 'fav_icon'));
            $data['fav_icon'] = (Arr::pull($data, 'fav_icon'))->store('logos');
        }

        Logo::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, $id){

        if(Arr::has($data, 'header_logo')){
            $data['header_logo'] = (Arr::pull($data, 'header_logo'));
            $data['header_logo'] = (Arr::pull($data, 'header_logo'))->store('logos');
        }

        if(Arr::has($data, 'footer_logo')){
            $data['footer_logo'] = (Arr::pull($data, 'footer_logo'));
            $data['footer_logo'] = (Arr::pull($data, 'footer_logo'))->store('logos');
        }

        if(Arr::has($data, 'fav_icon')){
            $data['fav_icon'] = (Arr::pull($data, 'fav_icon'));
            $data['fav_icon'] = (Arr::pull($data, 'fav_icon'))->store('logos');
        }

        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        Logo::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        Logo::where('id',$id)->delete();
    }
}
