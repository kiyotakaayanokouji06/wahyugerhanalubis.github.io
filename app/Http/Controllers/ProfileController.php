<?php
 namespace App\Http\Controllers;
 use Auth;
 use Alert;
 use App\Models\User;
 use Illuminate\Http\Request;
 
class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{
		$user = User::where('id', Auth::user()->id)->first();
		return view('profile.index', compact('user'));
	}

	public function update(Request $request)
	{
		$this->validate($request, [
			'passowrd' =>'confirmed',
		]);
		$user = user::where('id',Auth::user()->id)->first();
		$user->name = $request->name;
		$user->email = $request->email;
		$user->nohp = $request->nohp;
		$user->alamat = $request->alamat;
		if(!empty($request->password))
		{
			$user->password = Hash::make($request->password);
		}

		$user->update();


	}

}

