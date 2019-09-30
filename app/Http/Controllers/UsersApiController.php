<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Groups;
use Auth;

class UsersApiController extends Controller
{

	/**
	 * Returns a json array of groups
	 * 
	 * @return json
	 */
	public function groups() {
		$groups = Groups::all();
		$filtered = [];

		foreach ($groups as $group) {
			$filtered[$group->id] = [
				'name' => $group->group_name,
				'description' => $group->description
			];
		}

		return response()->json($filtered, 200);
	}

	/**
	 * Returns a json array of users
	 * 
	 * @return json
	 */
	public function users() {
		$groups = Groups::all();
		$filtered = [];
		
		foreach ($groups as $group) {
			$users_group = [];
			$users = User::where('group',$group->id)->get();

			foreach ($users as $user) {
				if (Auth::user()->admin == 1 || Auth::user()->id == $user->id) { 
					$users_group[$user->id] = [
						'name' => $user->name,
						'email' => $user->email,
						'dob' => $user->dob,
						'title' => $user->job_title,
						'phone' => $user->phone,
						'extension' => $user->extension,
					];
				} else {
					$users_group[$user->id] = [
						'name' => $user->name,
						'phone' => $user->phone,
						'extension' => $user->extension
					];
				}
			}		

			$filtered[$group->id] = [
				'name' => $group->group_name,
				'users' => $users_group
			];
		}
		

		return response()->json($filtered, 200);
	}

}
