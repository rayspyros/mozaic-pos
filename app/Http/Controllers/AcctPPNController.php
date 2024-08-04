<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcctPPNSetting;
use App\Models\PreferenceCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AcctPPNController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Session::forget('datasetting');
        $data = AcctPPNSetting::where('data_state', 0)
        ->where('company_id', Auth::user()->company_id)
        ->get();
        return view('content.AcctPPNSetting.ListInvtPPNSetting', compact('data'));
    }

    public function addPPNSetting()
    {
        $datasetting = Session::get('datasetting');
        return view('content.AcctPPNSetting.FormAddInvtPPNSetting',compact('datasetting'));
    }

    public function elementsAddPPNSetting(Request $request)
    {
        $datasetting = Session::get('datasetting');
        if(!$datasetting || $datasetting == ''){
            $datasetting['ppn_setting_code']    = '';
            $datasetting['ppn_setting_name']    = '';   
            $datasetting['ppn_setting_value']  = '';
        }
        $datasetting[$request->name] = $request->value;
        Session::put('datasetting', $datasetting);
    }

    public function addReset()
    {
        Session::forget('datasetting');
        return redirect()->back();
    }

    public function processAddPPNSetting(Request $request)
    {
        $fields = $request->validate([
            'ppn_setting_code'     => 'required',
            'ppn_setting_name'     => 'required',
            'ppn_setting_value'   => 'required'
        ]);

        $data = AcctPPNSetting::create([
            'ppn_setting_code'        => $fields['ppn_setting_code'],
            'ppn_setting_name'        => $fields['ppn_setting_name'],
            'ppn_setting_value'       => $fields['ppn_setting_value'],
            'company_id'                => Auth::user()->company_id,
            'updated_id'                => Auth::id(),
            'created_id'                => Auth::id(),
        ]);

        if($data->save()){
            $msg = 'Tambah Setting Berhasil';
            return redirect('/ppn-setting/edit-setting')->with('msg',$msg);
        } else {
            $msg = 'Tambah Setting Gagal';
            return redirect('/ppn-setting/edit-setting')->with('msg',$msg);
        }
    }

    public function editPPNSetting($ppn_setting_id)
    {
        $data = AcctPPNSetting::where('ppn_setting_id',$ppn_setting_id)->first();
        return view('content.AcctPPNSetting.FormEditInvtPPNSetting', compact('data'));
    }

    // public function getPPNPrecentage($company_id)
    // {
    //     $data   = PreferenceCompany::where('company_id', $company_id)->first();

    //     return $data['ppn_precentage'];
    // }

    public function processEditPPNSetting(Request $request)
    {
        $fields = $request->validate([
            'setting_id'       => '',
            'setting_code'     => 'required',
            'setting_name'     => 'required',
            'setting_value'   => 'required'
        ]);

        $table                          = AcctPPNSetting::findOrFail($fields['setting_id']);
        $table->ppn_setting_code      = $fields['setting_code'];
        $table->ppn_setting_name      = $fields['setting_name'];
        $table->ppn_setting_value     = $fields['setting_value'];
        $table->updated_id  = Auth::id();

        if($table->save()){
            $msg = "Ubah Setting PPN Berhasil";
            return redirect('/ppn-setting')->with('msg', $msg);
        } else {
            $msg = "Ubah Setting PPN Gagal";
            return redirect('/ppn-setting')->with('msg', $msg);
        }
    }

    public function deletePPNSetting($ppn_setting_id)
    {
        $table              = AcctPPNSetting::findOrFail($ppn_setting_id);
        $table->data_state  = 1;
        $table->updated_id  = Auth::id();

        if($table->save()){
            $msg = "Hapus Setting Barang Berhasil";
            return redirect('/ppn-setting')->with('msg', $msg);
        } else {
            $msg = "Hapus Setting Barang Gagal";
            return redirect('/ppn-setting')->with('msg', $msg);
        }
    }
}
