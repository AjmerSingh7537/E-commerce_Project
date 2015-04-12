<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $users = $this->getUsersList();
		return view('admin/users/users', ['users' => $users]);
	}

    private function getUsersList()
    {
        $users = User::join('users_type', 'users.type_id', '=', 'users_type.id')
            ->select('users.name', 'users.email', 'users_type.user_type', 'users.id')
            ->where('users.type_id', '<>', '2')
            ->get();
        $result = array();
        // The following foreach is used to reformat the array that I got from the above query
        foreach($users as $index => $user){
            $result[$index]['name'] = $user['name'];
            $result[$index]['email'] = $user['email'];
            $result[$index]['user_type'] = $user['user_type'];
            $result[$index]['id'] = $user['id'];
        }
        return $result;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}