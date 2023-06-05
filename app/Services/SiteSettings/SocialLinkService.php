<?php
namespace App\Services\SiteSettings;
use App\Models\SiteSettings\SocialLink;
use Illuminate\Support\Arr;

class SocialLinkService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){
        
        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        SocialLink::updateOrCreate(
            ['id' => $data['id']],
            $data,
        );
    }
}
