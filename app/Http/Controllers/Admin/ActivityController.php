<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityDetailParticipant;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Str;
use Auth;

class ActivityController extends Controller
{
    //
    public function index()
    {
        return view('admin.activity.index');
    }

    public function add()
    {
        return view('admin.activity.add');
    }

    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // validasi inputan
        $request->validate([
            "name" => "required",
            "desc" => "required",
            "start" => "required",
            "end" => "required"
        ]);

        Activity::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'start' => $request->start,
            'end' => $request->end,
            'admin_id' => $admin->id,
            'status' => "unfinish"
        ]);
        return redirect()->route('admin.training.index');
    }

    public function detail($id){
        $training = Activity::find($id);
        $users = User::all();
        return view('admin.activity.detail')->with(compact('training', 'users'));
    }

    public function destroy($id){
        $training = Activity::find($id);
        $training->delete();
        return redirect()->back()->with('success', 'Data kegiatan training berhasil didelete!');
    }

    public function peserta_delete($id){
        $peserta = ActivityDetailParticipant::find($id);
        $user = User::find($peserta->user_id);
        $peserta->delete();
        return redirect()->back()->with('success', 'Data peserta training (' . $user->name . ') berhasil didelete!');

    }

    public function peserta_add($id, Request $request)
    {
        $admin = Auth::guard('admin')->user();

        // validasi inputan
        $request->validate([
            "peserta_id" => "required",
        ]);

        ActivityDetailParticipant::create([
            'user_id' => $request->peserta_id,
            'activity_id' => $id,
            'status' => "pending",
        ]);
        return redirect()->back()->with('success', 'Data peserta training berhasil ditambahkan!');
    }


    public function training_finish($id, Request $request){
        $activity= Activity::where('id', '=', $id)->get()->first();

        $activity->update([
            'status' => 'finish',
        ]);
        
        // return $dd2;
        return redirect()->back()->with('success', 'Kegiatan Training berhasil mengupdate status kegiatan menjadi "finish"!!!');
    }
}
