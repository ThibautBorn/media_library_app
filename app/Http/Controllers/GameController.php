<?php


namespace App\Http\Controllers;
use App\Owned_Game;
use App\Owned_platform;
use Illuminate\Http\Request;
use MarcReichel\IGDBLaravel\Models\Artwork;
use MarcReichel\IGDBLaravel\Models\Company;
use MarcReichel\IGDBLaravel\Models\Franchise;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\ReleaseDate;
use MarcReichel\IGDBLaravel\Models\Screenshot;
use Validator;
use Session;
use function GuzzleHttp\Psr7\str;


class GameController extends Controller
{

    public static function game_messages() {
        return [
            'name.required' => 'Gelieve de titel van een spel op te geven',
            'platform.required' => 'Gelieve een (primair) platform voor jouw spelervaring te selecteren',
            'year.required' => 'Gelieve het jaar van uitgave mee te geven',
        ];
    }

    public static function game_rules ()
    {
        return [
            'name' => 'required',
            'platform'=> 'required',
            'year'=>'required',
        ];
    }

    public function index(Request $request){
        $platforms = Owned_platform::all();
        $owned_games = Owned_Game::all();
        return view('game.index')->with('owned_games',$owned_games)->with('platforms',$platforms);
    }

    public function index_wishlist(Request $request){
        $wishlist = $this->get_wishlist();
        return view('game.wishlist')->with('wishlist',$wishlist);
    }

    public function create(Request $request){
        $platforms = Owned_platform::all();
        return view('game.create')->with('platforms',$platforms);
    }

    public function promote(Request $request){
        $name = $request->name;
        $game = Owned_Game::where('name','=',$name)->firstorfail();

        return view('game.promotion')->with('game',$game);
    }

    public function store(Request $request){
        $messages = GameController::game_messages();
        $rules = GameController::game_rules();
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Session::flash('message', 'Er zitten fouten in het formulier. Gelieve deze op te lossen.');
            return Redirect()->Back()->withErrors($validator)->withInput();
        } else {
            //dump(intval($request->platform));
            $plat_id = intval(request('platform'));
            $wish = intval(request('on_wishlist'));


            $new_game = Owned_Game::create([
                'name' =>request('name'),
                'owned_platform_id'=>$plat_id,
                'art_url'=>request('art_url'),
                'year'=>request('year'),
                'on_wishlist'=>$wish,
                'score'=>request('score')
            ]);


            if ($wish === 1){
                return redirect('/my_wishlist');
            } else {
                return redirect('/my_games');
            }




            /*
             $game = Game::where('name', $request->name)->get();
             dump($game);
             */
        }


    }

    public function promote_to_owned(Request $request){
        dump($request->id);

        $game = Owned_Game::find($request->id);
        dump($game);


        $game->art_url = $request->art_url;
        $game->on_wishlist = 0;
        $game->score = $request->score;

        $game->save();


        return redirect('/my_games');

    }

    public function get_games(){
        $owned_games = Owned_game::where('on_wishlist','=',0)->get();
        $info = [];
        foreach ($owned_games as $owned){
            $item = [];
            $games = Game::where('name', $owned->name)->whereYear('first_release_date', '=',$owned->year)->with(['cover','involved_companies','franchise','genres'])->get();
            $game = $games[0];
            foreach ( $games as $potential_game)
                if(count($potential_game->attributes)>count($game->attributes)){
                    $game = $potential_game;
                }
            $game->attributes["total_rating"] = intval($game->attributes["total_rating"]);
            $game->attributes["myScore"] = $owned->score;
            $game->attributes["art_url"] = $owned->art_url;
            $release_date = ReleaseDate::where('game','=', strval($game->attributes["id"]))->first()->attributes["y"];
            $game->attributes["release_date"] = $release_date;
            $game->attributes["platform"] = Owned_platform::find($owned->owned_platform_id)->name;

            $developer = Company::find($game->involved_companies->where('developer','=','true')->first()->attributes["company"]);
            $publisher = Company::find($game->involved_companies->where('publisher','=','true')->first()->attributes["company"]);
            $screenshots = Screenshot::where('game','=', strval($game->attributes["id"]))->get();

            $item['game'] = $game;
            $item['developer'] = $developer;
            $item['publisher'] = $publisher;

            $number_screenshots = count($screenshots)-1;
            $firstShot = rand(0 , $number_screenshots );
            $secondShot = rand(0 , $number_screenshots );
            while($secondShot === $firstShot){
                $secondShot = rand(0 , $number_screenshots );
            }
            $item['screenshot1'] = $screenshots[$firstShot];
            $item['screenshot2'] = $screenshots[$secondShot];


            array_push($info,$item);
        }
        //dump($info);
        return $info;
    }

    public function get_wishlist(){
        $wanted_games = Owned_game::where('on_wishlist','=',1)->get();
        $wishlist = [];

        foreach ($wanted_games as $owned){
            $games = Game::where('name', $owned->name)->whereYear('first_release_date', '=',$owned->year)->with(['cover','involved_companies','franchise','genres'])->get();
            $game = $games[0];
            foreach ( $games as $potential_game)
                if(count($potential_game->attributes)>count($game->attributes)){
                    $game = $potential_game;
                }
            $release_date = ReleaseDate::where('game','=', strval($game->attributes["id"]))->first()->attributes["y"];
            $game->attributes["release_date"] = $release_date;
            $game->attributes["platform"] = Owned_platform::find($owned->owned_platform_id)->name;

            array_push($wishlist,$game);
        }
        //dump($wishlist);
        return $wishlist;

    }

}
