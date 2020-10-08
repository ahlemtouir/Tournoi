<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of AuthentificationController
 *
 * @author ahlem
 */
use App\User;
use Illuminate\Http\Request;

class AuthentificationController extends Controller {

    /**
     * Returns user response
     * @param $request
     * $return string
     */
    public function handleUserData(Request $request) {
        try {
            $data = $request->all();
            $response = User::handleUserData($data);
            if (isset($response["status"]) && ($response["status"] == 200)) {
                return Redirect::to('/index')->with(array("success" => true));
            } else {
                return Redirect::back()->with(array("error" => true));
            }
        } catch (\Throwable $th) {
            report($th);
        }
    
    }

}



