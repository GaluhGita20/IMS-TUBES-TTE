<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Activity;
use App\Models\Document;
use App\Models\Signer;
use Auth;
use Illuminate\Support\Facades\Redirect;

class DocumentController extends Controller
{
    //
    public function index()
    {
        // user bussiness
        // $request= Http::get('https://api.eversign.com/api/business?access_key=b703c86aaa5c672435ed9e5a7734ed79');

        // $request= Http::get('https://api.eversign.com/api/document?access_key=b703c86aaa5c672435ed9e5a7734ed79&business_id=559770&type=all');


        // $dd = $request->json();

        // return $dd;

        // $signers[0]=[
        //     'client_id' => "kelompok4ims@gmail.com",
        //     'client_secret' => "Darmawan14045@"
        // ];
        // $credentials = base64_encode('kelompok4ims@gmail.com:Darmawan14045@');
        // $request= Http::withHeaders([
        //     'Content-Type' => 'application/json',
        // ])->post('https://api.signhero.io/4/auth',[
        //     'action_str' => 'create',
        //     'data_type' => 'access_token',
        //     'request_map' => $signers[0]
        // ]);
        // $dd = $request->json();

        // $data[0]=[
        //     "access_token" => "b26908bd6ba621ad0178b68cd12e68ca",
        // ];
        // $data1[0]=[
        //     'scope' => "group",
        // ];
        // $request2= Http::withHeaders([
        //     'Content-Type' => 'application/json',
        //     'Content-type' => 'application/json',
        // ])->post('https://api.signhero.io/4/documents',[
        //     'action_str' => 'retrieve',
        //     'data_type' => 'unattached_documents',
        //     'trans_map' => $dd['trans_map'],
        //     'request_map' => $data1[0]
        // ]);
        // $dd2 = $request2->json();

        // return $dd2;
        return view('admin.document.index');
    }

    public function create()
    {
        $activities = Activity::all();
        return view('admin.document.create')->with(compact('activities'));
        // return $file_upload_document;
    }

    public function store(Request $request){
        $request->validate([
            "title" => "required",
            "activity_id" => "required",
            "filedoc" => "required",
        ]);

        $fileName = $request->filedoc->getClientOriginalName();
        $file = $request->file('filedoc');
        Storage::disk('asset')->put('asset/document/'.$fileName, file_get_contents($file));

        $request_1= Http::attach('upload', file_get_contents($file), $fileName)->post('https://api.eversign.com/api/file?access_key=dff6ff35c45ebf1b0b5a96589edc41c7&business_id=562984&type=all', [
                'upload' => $fileName,
            ]);

        $dd1 = $request_1->json();

        $document = Document::create([
            'document' => $fileName,
            'activity_id' => $request->activity_id,
            'title' => $request->title,
            'message' => $request->message,
            'document_hash' => NULL,
            'file_id' => $dd1['file_id'],
            'status' => "pending"
        ]); 

        return redirect()->route('admin.document.detail', $document->id);
    }


    public function document_sending($id, Request $request){
        $document = Document::with('activity', 'signers')->where('id', '=', $id)->get()->first();
        $files[0]=[
            'name' => $document->document,
            'file_id' => $document->file_id,
            'file_url' => "",
            'file_base64' => ""
        ];


        $request_2= Http::post('https://api.eversign.com/api/document?access_key=dff6ff35c45ebf1b0b5a96589edc41c7&business_id=562984&type=all', [
                'title' => $document->title,
                'message' => $document->message,
                'custom_requester_name' => "",
                'custom_requester_email' => "",
                'client' => "",
                'files' => $files,
                'signers' => $document->signers,

            ]);
    
        $dd2 = $request_2->json();
        
        $document->update([
            'document_hash' => $dd2['document_hash'],
            'status' => 'sending',
        ]);

        return redirect()->back()->with('success', 'Document berhasil dikirim ke penandatangan... Silahkan cek email!!!');
    }

    public function document_integrasi($id, Request $request){
        $document = Document::with('activity', 'signers')->where('id', '=', $id)->get()->first();

        $request_2= Http::get('https://api.eversign.com/api/document?access_key=dff6ff35c45ebf1b0b5a96589edc41c7&business_id=562984&document_hash='. $document->document_hash);
    
        $dd2 = $request_2->json();

        if($dd2['is_completed'] == 1){
            $document->update([
                'status' => 'finish',
            ]);
        }
        
        // return $dd2;
        return redirect()->back()->with('success', 'Document berhasil disinkronisasikan dengan server!!!');
    }


    public function document_download_final($id){
        $document = Document::with('activity', 'signers')->where('id', '=', $id)->get()->first();

        $request_2= Http::get('https://api.eversign.com/api/download_final_document?access_key=dff6ff35c45ebf1b0b5a96589edc41c7&business_id=562984&document_hash='. $document->document_hash . '&audit_trail=1&url_only=1');

        $headers = [
            'Content-Type' => 'application/pdf',
         ];
    
        $dd2 = $request_2->json();
        $str = $dd2['url'];

        $result = explode('/', $str, 2);
        $result_final = "https://" .$result[0] . "/". $result[1];

        return Redirect::to($result_final);
        // return $result_final;
    }

    public function detail($id)
    {
        $document = Document::with('activity', 'signers')->where('id', '=', $id)->get()->first();
        // return $document;
        return view('admin.document.detail')->with(compact('document'));
    }

    public function signer_add($id, Request $request)
    {
        // validasi inputan
        $request->validate([
            "name_signer" => "required",
            "email_signer" => "required",
        ]);

        Signer::create([
            'document_id' => $id,
            'name' => $request->name_signer,
            'email' => $request->email_signer,
        ]);
        return redirect()->back()->with('success', 'Data signer document berhasil ditambahkan!');
    }

    public function signer_delete($id){
        $signer = Signer::find($id);
        $temp_name = $signer->name;
        $signer->delete();
        return redirect()->back()->with('success', 'Data signer document (' . $signer->name . ') berhasil didelete!');

    }











    // public function upload_file(Request $request){
    //     $request->validate([
    //         "filedoc" => "required",
    //     ]);

    //     $fileName = $request->filedoc->getClientOriginalName();
    //     $file = $request->file('filedoc');
    //     Storage::disk('asset')->put('asset/document/'.$fileName, file_get_contents($file));

    //     $request_2= Http::attach('upload', file_get_contents($file), $fileName)->post('https://api.eversign.com/api/file?access_key=dff6ff35c45ebf1b0b5a96589edc41c7&business_id=562984&type=all', [
    //             'upload' => $fileName,
    //         ]);
    
    //     $dd2 = $request_2->json();

    //     return $dd2;
    // }
}
