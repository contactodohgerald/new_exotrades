<?php

namespace App\Traits;
use App\Http\Controllers\Controller;

use App\Models\Settings\SiteSetting;

trait ReturnTemplate {

    //create a method that outputs this value to user side
    public static function return_values(){

        $appSettings = SiteSetting::first();

        Controller::$site_details['app_name'] = $appSettings->site_name;
        Controller::$site_details['site_email'] = $appSettings->site_email;
        Controller::$site_details['site_phone'] = $appSettings->site_phone;

        //create an array to house the values that will be returned to the front end
        $return_values = array();
        $return_values['status'] = Controller::$status;
        $return_values['success'] = Controller::$success;
        $return_values['error'] = Controller::$error;
        $return_values['payload'] = Controller::$payload;
        $return_values['site_details'] = Controller::$site_details;

        return $return_values;

    }

}