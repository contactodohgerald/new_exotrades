<?php

namespace App\Http\Controllers\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Plans\InvestmentPlan;
use App\Traits\Generics;
use RealRashid\SweetAlert\Facades\Alert; 

class PlanController extends Controller
{
    //
    use Generics;
    public function __construct(InvestmentPlan $plan){
        $this->plan = $plan;
    }

    public function createPlanPageInterface(){
        
        return view('backend.create_plan');
    }

    public function addNewPlan(Request $request){
        try{
            $data = $request->all();

            $request->validate([
                'plan_name' => 'required',
                'plan_percentage' => 'required',
                'min_amount' => 'required',
                'max_amount' => 'required',
            ]);
            
            $thumbnailUrl = 'default.jpg';
            // addind the image to cloudinary
            if ($request->hasFile('thumbnail')) {

                // Uploading an image file to cloudinary and resizing the image to a resolution specified by the dimension parameters with one line of code
                $thumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath(), [
                    'folder' => 'exotrades/plan_image',
                    'transformation' => [
                        'width' => 200,
                        'height' => 200
                    ]
                ])->getSecurePath();
            }

            $plans = new InvestmentPlan();
            $plans->unique_id = $this->createUniqueId('investment_plans', 'unique_id');
            $plans->plan_name = strtoupper($data['plan_name']);
            $plans->plan_percentage = $data['plan_percentage'] ? $data['plan_percentage'] : null;
            $plans->min_amount = $data['min_amount'] ? $data['min_amount'] : null;
            $plans->max_amount = $data['max_amount'] ? $data['max_amount'] : null;
            $plans->plan_image = $thumbnailUrl;
            $plans->intrest_duration = $data['intrest_duration'] ? $data['intrest_duration'] : null;
            $plans->capital_duration = $data['capital_duration'] ? $data['capital_duration'] : null;
            $plans->payment_interval = $data['payment_interval'] ? $data['payment_interval'] : null;

            if($plans->save()){
                Alert::success('Success', 'You request was successfully created');
                return redirect()->back(); 
            }else {
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }

    public function viewPlansPageInterface(){
        $plan = $this->plan->getAllPlans([
            ['deleted_at', null]
        ]);

        $view = [
            'plan'=>$plan,
        ];

        return view('backend.view_plans', $view);
    } 
    
    public function editPlansPageInterface($unique_id = null){

        if($unique_id != null){
            $plan = $this->plan->getSinglePlan([
                ['unique_id', $unique_id]
            ]);
    
            $view = [
                'plan'=>$plan,
            ];
            return view('backend.edit_plan', $view);
        }
    }

    public function updatePlan(Request $request, $unique_id = null){
        try{

            if($unique_id != null){
                $data = $request->all();

                $request->validate([
                    'plan_name' => 'required',
                    'plan_percentage' => 'required',
                    'min_amount' => 'required',
                    'max_amount' => 'required',
                ]);

                $plan = $this->plan->getSinglePlan([
                    ['unique_id', $unique_id]
                ]);
                
                // addind the image to cloudinary
                if ($request->hasFile('thumbnail')) {

                    // Uploading an image file to cloudinary and resizing the image to a resolution specified by the dimension parameters with one line of code
                    $thumbnailUrl = Cloudinary::upload($request->file('thumbnail')->getRealPath(), [
                        'folder' => 'exotrades/plan_image',
                        'transformation' => [
                            'width' => 200,
                            'height' => 200
                        ]
                    ])->getSecurePath();

                    $plan->plan_image = $thumbnailUrl;
                }

                $plan->plan_name = strtoupper($data['plan_name']) ? strtoupper($data['plan_name']) : $plan->plan_name;
                $plan->plan_percentage = $data['plan_percentage'] ? $data['plan_percentage'] : $plan->plan_percentage ;
                $plan->min_amount = $data['min_amount'] ? $data['min_amount'] : $plan->min_amount;
                $plan->max_amount = $data['max_amount'] ? $data['max_amount'] : $plan->max_amount;
                $plan->intrest_duration = $data['intrest_duration'] ? $data['intrest_duration'] : $plan->intrest_duration ;
                $plan->capital_duration = $data['capital_duration'] ? $data['capital_duration'] : $plan->capital_duration ;
                $plan->payment_interval = $data['payment_interval'] ? $data['payment_interval'] : $plan->payment_interval ;
                $plan->save();

                Alert::success('Success', 'You request was successfully updated');
                return redirect()->to('view-plan'); 
 
            }else {
                Alert::error('Error', 'An error occured, try again later');
                return redirect()->back();
            }
        }catch (Exception $exception) {
            $error = $exception->getMessage();
            Alert::error('Error', $error);
            return redirect()->back();
        }
    }
}
