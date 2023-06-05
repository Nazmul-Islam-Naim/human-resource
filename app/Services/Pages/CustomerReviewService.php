<?php
namespace App\Services\Pages;
use App\Models\Pages\CustomerReview;
use Illuminate\Support\Arr;

class CustomerReviewService
{
     /**
     * Store a newly created resource in storage.
     */
    public function store($data){
        
        if(Arr::has($data, 'image')){
            $data['image'] = (Arr::pull($data, 'image'));
            $data['image'] = (Arr::pull($data, 'image'))->store('customer-reviews');
        }
        
        CustomerReview::create($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($data, $id){
        
        if(Arr::has($data, 'image')){
            $data['image'] = (Arr::pull($data, 'image'));
            $data['image'] = (Arr::pull($data, 'image'))->store('customer-reviews');
        }

        if(Arr::has($data, '_method')){
            $method = Arr::pull($data, '_method');
        }

        if(Arr::has($data, '_token')){
            $token = Arr::pull($data, '_token');
        }

        CustomerReview::where('id',$id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        CustomerReview::where('id',$id)->delete();
    }
}
