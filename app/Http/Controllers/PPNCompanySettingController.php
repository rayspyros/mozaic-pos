<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PreferenceCompany;
use App\Models\PPNCompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PPNCompanySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {
        Session::forget('datasetting');
        $data = PPNCompanySetting::where('data_state', 0)
        ->where('company_id', Auth::user()->FK_company_id)
        ->get();
        return view('content.PPNCompanySetting.EditPPNCompanySetting', compact('data'));
    }

    public function processAddPPNCompanySetting(Request $request)
    {
        
        $data = array(
            '1_account_id'               => $request->input('purchase_cash_account_id'),
            '1_account_setting_status'   => $request->input('purchase_cash_account_status'),
            '1_account_setting_name'     => 'purchase_account',
            '1_account_default_status'     => $this->getAccountDefault($request->input('purchase_cash_account_id')),

            '2_account_id'               => $request->input('account_cash_purchase_id'),
            '2_account_setting_status'   => $request->input('account_cash_purchase_status'),
            '2_account_setting_name'     => 'purchase_cash_account',
            '2_account_default_status'     => $this->getAccountDefault($request->input('account_cash_purchase_id')),

            '3_account_id'               => $request->input('purchase_return_account_id'),
            '3_account_setting_status'   => $request->input('purchase_return_account_status'),
            '3_account_setting_name'     => 'purchase_return_account',
            '3_account_default_status'     => $this->getAccountDefault($request->input('purchase_return_account_id')),

            '4_account_id'               => $request->input('account_payable_return_account_id'),
            '4_account_setting_status'   => $request->input('account_payable_return_account_status'),
            '4_account_setting_name'     => 'purchase_return_cash_account',
            '4_account_default_status'     => $this->getAccountDefault($request->input('account_payable_return_account_id')),

            '5_account_id'               => $request->input('sales_account_id'),
            '5_account_setting_status'   => $request->input('sales_account_status'),
            '5_account_setting_name'     => 'sales_account',
            '5_account_default_status'     => $this->getAccountDefault($request->input('sales_account_id')),

            '6_account_id'               => $request->input('account_receivable_account_id'),
            '6_account_setting_status'   => $request->input('account_receivable_account_status'),
            '6_account_setting_name'     => 'sales_cash_account',
            '6_account_default_status'     => $this->getAccountDefault($request->input('account_receivable_account_id')),

            '7_account_id'               => $request->input('expenditure_account_id'),
            '7_account_setting_status'   => $request->input('expenditure_account_status'),
            '7_account_setting_name'     => 'expenditure_account',
            '7_account_default_status'     => $this->getAccountDefault($request->input('expenditure_account_id')),

            '8_account_id'               => $request->input('expenditure_cash_account_id'),
            '8_account_setting_status'   => $request->input('expenditure_cash_account_status'),
            '8_account_setting_name'     => 'expenditure_cash_account',
            '8_account_default_status'     => $this->getAccountDefault($request->input('expenditure_cash_account_id')),
        );

        $company_id = PPNCompanySetting::where('company_id', Auth::user()->company_id)->first();
        if(!empty($company_id)){
            for($key = 1; $key<=8;$key++){
                $data_item = array(
                    'account_id' 				=> $data[$key."_account_id"],
                    'account_setting_status'	=> $data[$key."_account_setting_status"],
                    'account_setting_name' 		=> $data[$key."_account_setting_name"],
                    'account_default_status'    => $data[$key."_account_default_status"],
                    'company_id'                => Auth::user()->company_id
                );
                PPNCompanySetting::where('account_setting_name',$data_item['account_setting_name'])
                ->where('company_id', Auth::user()->company_id)
                ->update($data_item);
            }
        } else {
            for($key = 1; $key<=8;$key++){
                $data_item = array(
                    'account_id' 				=> $data[$key."_account_id"],
                    'account_setting_status'	=> $data[$key."_account_setting_status"],
                    'account_setting_name' 		=> $data[$key."_account_setting_name"],
                    'account_default_status'    => $data[$key."_account_default_status"],
                    'company_id'                => Auth::user()->company_id
                );
                PPNCompanySetting::create($data_item);    
            }
        }
        $msg = 'Setting Jurnal Berhasil';
        return redirect('/ppn-company-setting')->with('msg',$msg);
        
    }

    public function getAccountDefault($account_id)
    {
        $data = PreferenceCompany::where('account_id', $account_id)->first();

        return $data['ppn_default_status'];
    }
}
