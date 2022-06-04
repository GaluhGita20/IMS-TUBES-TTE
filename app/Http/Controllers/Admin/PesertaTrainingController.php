<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityDetailParticipant;
use App\Models\Certificate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Mail;
use App\Mail\MyMail;
use Illuminate\Support\Facades\URL;

class PesertaTrainingController extends Controller
{
    //
    public function index($id_user, $id_training){

        $peserta = ActivityDetailParticipant::with('user', 'activity', 'certificates')->where('id','=', $id_user)->first();
        return view('admin.peserta.index')->with(compact('peserta'));
        // return $peserta;
    }

    public function create($id, Request $request){

        $request->validate([
            "tingkatan" => "required",
            "filedoc" => "required",
        ]);

        $fileName = $request->filedoc->getClientOriginalName();
        $file = $request->file('filedoc');
        Storage::disk('asset')->put('asset/certificate/certificate-'.$fileName, file_get_contents($file));

        $request_1= Http::attach('upload', file_get_contents($file), $fileName)->post('https://api.eversign.com/api/file?access_key=dff6ff35c45ebf1b0b5a96589edc41c7&business_id=562984&type=all', [
                'upload' => $fileName,
            ]);

        $dd1 = $request_1->json();

        $document = Certificate::create([
            'activity_detail_participant_id' => $id,
            'document' => $fileName,
            'tingkatan' => $request->tingkatan,
            'file_id' => $dd1['file_id'],
            'document_hash'=> NULL,
            'status' => "not yet",
            'sending' => null,
        ]); 
        return redirect()->back()->with('success', 'Data certificate berhasil ditambahkan!');

        // return $peserta;
    }

    public function sending($id, Request $request){
        $cc = Certificate::find($id);
        $certificate = ActivityDetailParticipant::with('user', 'activity', 'certificates')->where('id','=', $cc->activity_detail_participant_id)->first();

        $title = "Certificate Training " . $certificate->activity->name;
        $message = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In mattis diam vitae eleifend ornare. Sed nulla velit, euismod et erat imperdiet, interdum facilisis massa. Nullam non ipsum facilisis purus vestibulum scelerisque et pulvinar sapien. Vivamus laoreet sit amet elit ut facilisis. Sed viverra congue eros ut ultricies. Sed elementum blandit luctus. Sed sollicitudin, neque vitae rutrum accumsan, ipsum nisi pharetra massa, ut pellentesque velit tellus fringilla massa. Pellentesque euismod pretium massa, quis suscipit nulla molestie sed. Donec viverra blandit nibh. Curabitur efficitur, velit sit amet venenatis mollis, velit sem ornare metus, vitae aliquet nisl lectus vitae libero. Ut pretium sem semper nisl finibus condimentum. Cras suscipit vitae lacus ut ultricies. Quisque dictum ut libero in sagittis. Nam in ex imperdiet, iaculis augue at, mattis nunc.";

        $data["email"] = $certificate->user->email;
        $data["title"] = $title;
        $data["body"] = $message;
        $data['certificate'] =$certificate->id . '/' . $cc->document;
        $temp_nama = $cc->document;
        $temp_id = $certificate->id;
 

  
        Mail::send('email.sendCertificate', $data, function($message)use($data, $temp_nama, $cc) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attach('C:\xampp\htdocs\IMS-TUBES-TTE\public\asset\certificate\certificate-'. $cc->document);
            
        });
 
        dd('Mail sent successfully');
        
        // $cc->update([
        //     'document_hash' => $dd2['document_hash'],
        //     'sending' => Carbon::now('Asia/Makassar'),
        //     'status' => 'finish',
        // ]);

        // return redirect()->back()->with('success', 'Certificate berhasil dikirimkan ke email peserta!!!');
    }
}
