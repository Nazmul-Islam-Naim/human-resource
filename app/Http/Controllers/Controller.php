<?php

namespace App\Http\Controllers;

use App\Models\Pages\AboutUs;
use App\Models\Pages\Project;
use App\Models\SiteSettings\Contact;
use App\Models\SiteSettings\Logo;
use App\Models\SiteSettings\SocialLink;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $service;

    public function layout(){
        $logo = Logo::select('title','header_logo','footer_logo','fav_icon')->where('status',1)->orderBy('id','desc')->first();
        return $logo;
    }

    public function contact(){
        $contact = Contact::select('email','phone','address','office_time','lat','long')->where('status',1)->orderBy('id','desc')->first();
        return $contact;
    }

    public function socialLink(){
        $socialLink = SocialLink::select('facebook','twitter','linkedin','whatsapp')->first();
        return $socialLink;
    }

    public function commonSlider(){
        $commonSlider = AboutUs::select('slider_image')->where('status',1)->orderBy('id','desc')->first();
        return $commonSlider;
    }

    public function footerProjects(){
        $footerProjects = Project::select('title','slug','project_type_id','project_status','location')->where('status',1)->latest()->take(3)->get();
        return $footerProjects;
    }
}
