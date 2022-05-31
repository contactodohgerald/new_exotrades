<?php

namespace App\Http\Controllers\FrontView;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Settings\SiteSetting;
use App\Models\Plans\InvestmentPlan;
use App\Models\Subscriber\Subscriber;
use App\Traits\Generics; 
use RealRashid\SweetAlert\Facades\Alert;
use Exception;

class FrontViewController extends Controller
{
    //
    use Generics;
    public function __construct(SiteSetting $setting, InvestmentPlan $plan, Subscriber $subscriber){
        $this->setting = $setting;
        $this->plan = $plan;
        $this->subscriber = $subscriber;
    }


    public function homePage(){

        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $setting = $this->setting->getSettings();

        $view = [
            'setting'=>$setting,
            'plan'=>$plan,
        ];

        return view('frontend.index', $view);

    }

    public function aboutPage(){
        
        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $setting = $this->setting->getSettings();

        $view = [
            'setting'=>$setting,
            'plan'=>$plan,
        ];

        return view('frontend.about', $view);

    }

    public function contactPage(){

        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $setting = $this->setting->getSettings();

        $view = [
            'setting'=>$setting,
            'plan'=>$plan,
        ];

        return view('frontend.contact', $view);

    }

    public function affiliatePage(){

        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $setting = $this->setting->getSettings();

        $view = [
            'setting'=>$setting,
            'plan'=>$plan,
        ];

        return view('frontend.affiliate', $view);

    }

    public function faqPage(){

        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $setting = $this->setting->getSettings();

        $view = [
            'setting'=>$setting,
            'plan'=>$plan,
        ];

        return view('frontend.faq', $view);

    } 
    
    public function servicesPage(){

        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $setting = $this->setting->getSettings();

        $view = [
            'setting'=>$setting,
            'plan'=>$plan,
        ];

        return view('frontend.services', $view);

    }

    public function planPage(){

        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $setting = $this->setting->getSettings();

        $view = [
            'setting'=>$setting,
            'plan'=>$plan,
        ];

        return view('frontend.plan', $view);

    }
    
    public function termOfUsePage(){

        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $setting = $this->setting->getSettings();

        $view = [
            'setting'=>$setting,
            'plan'=>$plan,
        ];

        return view('frontend.terms_of_use', $view);

    }

    public function userSubscribe(Request $request){
        try {

            $subscriber = $this->subscriber->getSingleSubscriber([
                ['emails', $request->email],
            ]);
           
            if($subscriber != null){

                $subscriber->emails = $request->email;
                $subscriber->save();
                return redirect()->back()->with('success', 'You successfully subscribed');
            }else{
                
                $unique_id = $this->createUniqueId('subscribers', 'unique_id');
                $subscriber = new Subscriber();
                $subscriber->unique_id  = $unique_id;
                $subscriber->emails = $request->email;
                $subscriber->save();
                return redirect()->back()->with('success', 'You successfully subscribed');
            }

        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return redirect()->back()->with('errors', $error);
        }

    }

    public function contactMailHandler(Request $request){
        try {

            $data = $request->all();

            //send admin email
           
            return redirect()->back()->with('success', 'You successfully subscribed');

        } catch (Exception $exception) {
            $error = $exception->getMessage();
            return redirect()->back()->with('errors', $error);
        }

    }
}
