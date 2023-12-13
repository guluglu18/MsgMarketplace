<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ads = Ad::where('user_id', Auth::user()->id)->get();
        //
        return view('home', compact('ads'));
    }


    public function addDeposit() {

        
        return view('home.addDeposit');
    }

    public function saveDeposit(Request $request) {
        $user = Auth::user();
        request()->validate([
            'deposit' => 'required|max:4'
        ],
        [
            'deposit.max'=>'Cant add more than 9999rsd at once'
        ]);
        
        $user->deposit = $user->deposit + $request->deposit;
        $user->save();

        return redirect(route('home'));



    }



    public function showForm() {
        $categories = Category::all();
        return view('home.showForm', compact('categories'));
    }

    public function saveData(Request $request) {

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'price' => 'required|max:4',
            'image1' => 'mimes:jpg, png, jpeg',
            'image2' => 'mimes:jpg, png, jpeg',
            'image3' => 'mimes:jpg, png, jpeg',
            'category' => 'required'
        ]);

        if ($request->hasFile('image1')){
            $image1 = $request->file(('image1'));
            $image1_name = time().'1.'.$image1->extension();
            $image1->move(public_path('ad_image'), $image1_name);
        }
        
        if ($request->hasFile('image2')){
            $image2 = $request->file(('image2'));
            $image2_name = time().'2.'.$image2->extension();
            $image2->move(public_path('ad_image'), $image2_name);
        }
        
        if ($request->hasFile('image3')){
            $image3 = $request->file(('image3'));
            $image3_name = time().'3.'.$image3->extension();
            $image3->move(public_path('ad_image'), $image3_name);
        }

        Ad::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'price'=>$request->price,
            'image1'=>(isset($image1_name)) ? $image1_name : null,
            'image2'=>(isset($image2_name)) ? $image2_name : null,
            'image3'=>(isset($image3_name)) ? $image3_name : null,
            'category_id'=>$request->category,
            'user_id'=>Auth::user()->id
        ]);

        return redirect(route('home'));
        
    }

    public function singleAd($id) {
        $singleAd = Ad::find($id);
        return view('home.singleAd', compact('singleAd'));    
    }


    public function showMessages() {
        $messages = Message::where('reciver_id', auth()->user()->id)->get();
        return view('home.messages', compact('messages'));
    }
    public function reply() {
        $sender_id = request()->sender_id;
        $ad_id = request()->ad_id;
 
        $messages = Message::where('sender_id', $sender_id)->where('ad_id', $ad_id)->get();


        return view('home.reply', compact('sender_id', 'ad_id', 'messages'));

    }

    public function replyStore(Request $request) {
        $sender = User::find($request->sender_id);
        $ad = Ad::find($request->ad_id);

        // nova poruka...

        $new_msg = new Message();
        $new_msg->text = $request->msg;
        $new_msg->sender_id = auth()->user()->id;
        $new_msg->reciver_id = $sender->id;
        $new_msg->ad_id = $ad->id;
        $new_msg->save();


        return redirect()->route('home.showMessages')->with('message', 'Replay sent...'); 


    }
    
}
