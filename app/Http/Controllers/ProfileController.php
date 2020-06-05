<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Repositories\MediaRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $mediaRepository;

    public function __construct(MediaRepositoryInterface $mediaRepository)
    {
        $this->middleware('auth');
        $this->mediaRepository = $mediaRepository;
    }

    public function profile() {
        $user = Auth::user();
        return view('profile', ['user' => $user]);
    }

    public function update(Request $request) {
        $user = Auth::user();
        $biography =  trim($request['biography'], ' ');
        $birthday = $request['birthday'];
        $birthday = strtotime($birthday);
        $birthday = date('Y-m-d', $birthday);
        $twitter = $request['twitter'];
        $website = $request['website'];
        $city = $request['city'];
        $profile = $user->profile;
        if ($profile === null) {
            $profile = new Profile([
                'city' => $city,
                'birthday' => $birthday,
                'biography' => $biography,
                'twitter' => $twitter,
                'website' => $website
            ]);
            $user->profile()->save($profile);
        } else {
            $user->profile->update([
                'city' => $city,
                'birthday' => $birthday,
                'biography' => $biography,
                'twitter' => $twitter,
                'website' => $website
            ]);
        }
        return redirect()->route('profile');
    }
}
