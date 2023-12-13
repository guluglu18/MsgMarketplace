<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index() {
        $ads = new Ad;


        if(isset(request()->cat)){
            $ads = Ad::whereHas('category', function ($query) {
                $query->whereName(request()->cat);
            });

        } 

        

        if (isset(request()->type)){
            $type = (request()->type == 'lower') ? 'asc' : 'desc'; 
            $ads = $ads->orderBy('price', $type);
        }

        $ads = $ads->get();
        $all_categories = Category::all();
        return view('welcome', compact('ads', 'all_categories'));
    }

    public function singleAd($id) {
        $ad = Ad::find($id);
        if(auth()->check() && auth()->user()->id !== $ad->user_id){
            $ad->increment('views');
        }

        

        return view('singleAd', compact('ad'));
    }

    public function sendMessage(Request $request, $id) {
        $ad = Ad::find($id); //koji oglas
        $ad_owner = $ad->user; //vlasnk oglsa
        $new_msg = new Message();
        $new_msg->text = $request->msg;
        $new_msg->sender_id = auth()->user()->id;
        $new_msg->reciver_id = $ad_owner->id;
        $new_msg->ad_id = $ad->id;
        $new_msg->save();


        return redirect()->back()->with('message', 'Message sent');
        
        

        
    }
}
