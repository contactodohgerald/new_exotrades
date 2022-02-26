<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Accesscode\AdminAccessCode;
use App\Models\Country\CountryList;
use App\Models\Plans\InvestmentPlan;
use App\Models\Settings\SiteSetting;
use App\Models\WalletAddress\WalletAddress;
use Illuminate\Support\Facades\Hash;
use App\Traits\Generics;

class DatabaseSeeder extends Seeder{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    use Generics;

    public function run(){

        // \App\Models\User::factory(10)->create();

        $user = new User();
        $user->unique_id  = $this->createUniqueId('users', 'unique_id');
        $user->name = "Super Admin";
        $user->email = "support@".env('APP_DOMAIN');
        $user->account_type = "super_admin";
        $user->country = "England";
        $user->phone = "0392372831";
        $user->gender = "Male";
        $user->address = "13, Osemene close mafoluku oshodi";
        $user->account_number = $this->createConfirmationNumbers('users', 'account_number', 7);
        $user->referral_id = $this->createUniqueId('users', 'referral_id');
        $user->password = Hash::make(1234567890);
        $user->save();

        $accessCode = new AdminAccessCode();
        $accessCode->unique_id = $this->createUniqueId('admin_access_codes', 'unique_id');
        $accessCode->access_code = strtoupper('makemoney.com');
        $accessCode->save();

        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        foreach ($countries as $item){
            $country = new CountryList();
            $country->name = $item;
            $country->save();
        }

        $settings = new SiteSetting();
        $settings->unique_id  = 'OGU9ZhIK0e66e8b70e91fea8';
        $settings->site_name = env('APP_NAME');
        $settings->site_email = "support@".env('APP_DOMAIN');
        $settings->site_email_2 = "xantatest@protonmail.com";
        $settings->site_phone = "+44 7887 443155";
        $settings->site_address = "United Kingdom: Ægisgardur 5, Reykjavik's Old Harbor";
        $settings->site_domain = env('APP_URL');
        $settings->save();

        $systemWalet = new WalletAddress();
        $systemWalet->unique_id = $this->createUniqueId('wallet_addresses', 'unique_id');
        $systemWalet->wallet_name = strtoupper('bitcoin');
        $systemWalet->wallet_address = 'ajsnahwsbdqwgxcqwqqwdmbqwkjh';
        $systemWalet->wallet_image = 'default.png';
        $systemWalet->save();

        $plan_name = ['BASIC', 'INTERMEDIATE', 'DIAMOND', 'CONTRACT'];
        $plan_min = [200, 5100, 10100, 50100];
        $plan_max = [5000, 10000, 50000, 'Unlimited'];
        $plan_percent = [1.5, 2.5, 3.5, 8.9];
        $payment_interval = ['Daily', 'Daily', 'Weekly', 'Monthly'];

        for($i = 0; $i < count($plan_name); $i++){
            $plan = new InvestmentPlan();
            $plan->unique_id  = $this->createUniqueId('investment_plans', 'unique_id');
            $plan->plan_name  = $plan_name[$i];
            $plan->plan_percentage  = $plan_percent[$i];
            $plan->min_amount  = $plan_min[$i];
            $plan->max_amount  = $plan_max[$i];
            $plan->payment_interval  = $payment_interval[$i];
            $plan->save();
        }

    }
}
