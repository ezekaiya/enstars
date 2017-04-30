<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Card;
use App\Boy;
use App\Skill;
use App\Minievent;
use App\Minieventchoice;
use App\Event;
use Auth;
use App\User;
use App\Usercard;
use App\Userevent;
use DB;

class UserController extends Controller
{

    /**
     * Only can do this when logged in
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display user dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard() {


         return view('user.dashboard');
      
    } 



    /**
     * Display user cards
     *
     * @return \Illuminate\Http\Response
     */
    public function cards() {
        //SELECT cards.* FROM cards,usercards WHERE usercards.user_id='1' AND usercards.card_id = cards.id
        //$cards = Usercard::where('user_id','=',Auth::user()->id)->get();

        // $cards = Card::
        // join('usercards', 'card.id', '=', 'usercards.card_id')
        //     ->join('usercards', 'usercards.user_id', '=', Auth::user()->id)
        //     ->select('cards.*')
        //     ->get();


        // print '<pre>';
        // print_r($cards);
        // print '</pre>';

        //$cards = Card::take(5);

        //this doesnt return a Card class object, which then cant use the function inside the method
        //$cards = DB::select("SELECT cards.* FROM cards,usercards WHERE usercards.user_id='".Auth::user()->id."' AND usercards.card_id = cards.id");

        //get all a users 5 stars
        //SELECT * FROM usercards WHERE user_id=
        //SELECT * FROM cards WHERE stars = 5

        //$cards = Usercard::where('user_id','=',Auth::user()->id)->get();
        //$test = new Usercard;

        //$cards = $test->select('cards.*')->join('cards', 'cards.id', '=', 'usercards.card_id')->whereRaw("cards.stars='5'")->whereRaw('usercards.user_id = '.Auth::user()->id)->get();


        $card = new Card;
        $fivestarcardsq = $card->select('cards.*')->join('usercards','usercards.card_id','=','cards.id')->whereRaw("cards.stars='5'")->whereRaw('usercards.user_id = '.Auth::user()->id)->orderBy('usercards.created_at','desc');
        $fivestarcards = $fivestarcardsq->get();
        //$fivestarcards_count = $fivestarcardsq->count();

        //four star
        $fourstarcardsq = $card->select('cards.*')->join('usercards','usercards.card_id','=','cards.id')->whereRaw("cards.stars='4'")->whereRaw('usercards.user_id = '.Auth::user()->id)->orderBy('usercards.created_at','desc');
        $fourstarcards = $fourstarcardsq->get();
        //$fourstarcards_count = $fourstarcardsq->count();

        //three star
        $threestarcardsq = $card->select('cards.*')->join('usercards','usercards.card_id','=','cards.id')->whereRaw("cards.stars='3'")->whereRaw('usercards.user_id = '.Auth::user()->id)->orderBy('usercards.created_at','desc');
        $threestarcards = $threestarcardsq->get();
        //$threestarcards_count = $threestarcardsq->count();        

       // dd($cards);


         return view('user.cards')
            ->with('fivestarcards',$fivestarcards)
            ->with('fourstarcards',$fourstarcards)
            ->with('threestarcards',$threestarcards);
      
    } 


    /**
     * Add card 
     *
     * @return \Illuminate\Http\Response
     */
    public function addCard(Request $request) {
        $card_id = $request->input('card_id');

        //add the user card
        $user = Auth::user();    

        //check if that card is already there

        $check = Usercard::where('user_id','=',$user->id)->where('card_id','=',$card_id)->count();

        if ($check < 1) {
            //only add if it isnt already there
            //need to update card
            $u = new Usercard;
            $u->user_id = $user->id;
            $u->card_id = $card_id;
             $u->bloom = 0;
             $u->copies = 1;
             $u->level = 0;
             $u->da = 0;
             $u->vo = 0;
             $u->pf = 0;
             $u->percent = 0;
             $u->affection = 0;
            $u->save();

            echo json_encode(array('card_id'=>$card_id));            
        }
    }


    /**
     * Remove card 
     *
     * @return \Illuminate\Http\Response
     */
    public function removeCard(Request $request) {
        $card_id = $request->input('card_id');

        //add the user card
        $user = Auth::user();    

        //need to delete card
        $d = Usercard::where('user_id','=',$user->id)->where('card_id','=',$card_id)->first();
        $d->delete();

        echo json_encode(array('card_id'=>$card_id));
    } 

    /**
     * Add event
     *
     * @return \Illuminate\Http\Response
     */
    public function addEvent(Request $request) {
        $event_id = $request->input('event_id');

        //add the user card
        $user = Auth::user();    


        $e = new Userevent;
        $e->user_id = $user->id;
        $e->event_id = $event_id;
        $e->points = 0;
        $e->rank = 0;
        $e->updated_by = $user->id;
        $e->save();


         echo json_encode(array('event_id'=>$event_id));            

    }


    /**
     * Update event
     *
     * @return \Illuminate\Http\Response
     */
    public function updateEvent(Request $request) {
        $event_id = $request->input('event_id');
        $rank = $request->input('rank');
        $points = $request->input('points');
        //add the user card
        $user = Auth::user();    

        //do want to update or be able to track all the data?
        //update for now, would just need to change this to an insert to add lots of data.
        $e = Userevent::where('user_id','=',$user->id)->where('event_id','=',$event_id)->first();

        $e->user_id = $user->id;
        $e->event_id = $event_id;
        $e->points = $points;
        $e->rank = $rank;
        $e->updated_by = $user->id;
        $e->save();


         echo json_encode(array('event_id'=>$event_id));            

    }

    /**
     * Update card
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCard(Request $request) {
         $user = Auth::user();

         $card_id = $request->input('card_id');
         $usercard_id = $request->input('usercard_id');

         $c = Usercard::find($usercard_id);
         $c->bloom = $request->input('bloom');
         $c->copies = $request->input('copies');
         $c->level = $request->input('level');
         $c->da = $request->input('da');
         $c->vo = $request->input('vo');
         $c->pf = $request->input('pf');
         $c->percent = $request->input('percent');
         $c->affection = $request->input('affection');
         $c->save();



        // $event_id = $request->input('event_id');
        // $rank = $request->input('rank');
        // $points = $request->input('points');
        // //add the user card
        // $user = Auth::user();    

        // //do want to update or be able to track all the data?
        // //update for now, would just need to change this to an insert to add lots of data.
        // $e = Userevent::where('user_id','=',$user->id)->where('event_id','=',$event_id)->first();

        // $e->user_id = $user->id;
        // $e->event_id = $event_id;
        // $e->points = $points;
        // $e->rank = $rank;
        // $e->updated_by = $user->id;
        // $e->save();


        // echo json_encode(array('usercard_id'=>$usercard_id));            
         return redirect('/card/'.$card_id);      

    }

}
