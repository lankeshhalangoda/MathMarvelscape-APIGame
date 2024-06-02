<?php

namespace App\Http\Controllers;

use App\Http\Resources\DataResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    //Main

    public function index()
    {
        return Inertia::render('Home/start');
    }

    public function game()
    {
        return Inertia::render('Home/index');
    }

    //Menu Items

    public function startGame()
    {
        return Inertia::render('Home/start-game');
    }

    public function leaderBoard()
    {
        return Inertia::render('Home/leader-board');
    }

    public function tutorial()
    {
        return Inertia::render('Home/tutorial');
    }

    public function levels()
    {
        return Inertia::render('Home/levels');
    }

    // Levels

    public function level1()
    {
        return Inertia::render('Home/level1');
    }

    public function level2()
    {
        return Inertia::render('Home/level2');
    }

    public function level3()
    {
        return Inertia::render('Home/level3');
    }

    public function level4()
    {
        return Inertia::render('Home/level4');
    }

    public function level5()
    {
        return Inertia::render('Home/level5');
    }

    public function level6()
    {
        return Inertia::render('Home/level6');
    }

    public function level7()
    {
        return Inertia::render('Home/level7');
    }

    public function level8()
    {
        return Inertia::render('Home/level8');
    }

    public function level9()
    {
        return Inertia::render('Home/level9');
    }

    public function level10()
    {
        return Inertia::render('Home/level10');
    }


    public function saveScore(Request $request)
    {
        $user = User::find(Auth::id());

        if ($user->score < $request->score) {
            $user->score = $request->score;
            $user->save();
        }
    }

    public function getleaderboard()
    {
        $users = User::orderBy('score', 'desc')->get();
        return response()->json($users);
    }

    public function tomatoApi()
    {
        $url = "https://marcconrad.com/uob/tomato/api.php";
        $data = file_get_contents($url);
        $json = json_decode($data, true);
        return response()->json($json);
    }

    public function smileApi()
    {
        $url = "https://marcconrad.com/uob/smile/api.php";
        $data = file_get_contents($url);
        $json = json_decode($data, true);
        return response()->json($json);
    }

    public function getScores()
    {
        $users = User::orderBy('score', 'desc')->get();
        return new DataResource($users);
    }

    public function allUsers()
    {
        $users = User::all();
        return new DataResource($users);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully!']);
    }

}
