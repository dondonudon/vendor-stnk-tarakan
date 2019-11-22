<?php

namespace App\Http\Controllers;

use App\sysMenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_SystemMenuGroup extends Controller
{
    public function index() {
        return view('dashboard.system_utility.group.list');
    }

    public function add() {
        return view('dashboard.system_utility.group.baru');
    }

    public function edit($id) {
        $data = DB::table('sys_menu_groups')->where('id','=',$id)->first();
        return view('dashboard.system_utility.group.edit')->with('data',$data);
    }

    public function list() {
        $data['data'] = sysMenuGroup::all();
        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $name = $request->name;
        $segmentName = $request->segment_name;
        $icon = $request->icon;
        $ord = $request->ord;

        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $sysGroup = new sysMenuGroup();
                $sysGroup->name = $name;
                $sysGroup->segment_name = $segmentName;
                $sysGroup->icon = $icon;
                $sysGroup->ord = $ord;
                $sysGroup->save();
            } elseif ($type == 'edit') {
                DB::table('sys_menu_groups')
                    ->where('id','=',$request->id)
                    ->update([
                        'name' => $name,
                        'segment_name' => $segmentName,
                        'icon' => $icon,
                        'ord' => $ord,
                    ]);
            }
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
}
