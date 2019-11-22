<?php

namespace App\Http\Controllers;

use App\sysMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_SystemMenu extends Controller
{
    public function index() {
        return view('dashboard.system_utility.menu.list');
    }

    public function add() {
        $group = DB::table('sys_menu_groups')->select('id','name')->get();
        return view('dashboard.system_utility.menu.baru')->with('data',$group);
    }

    public function edit($id) {
        $data = DB::table('sys_menus')->where('id','=',$id)->first();
        $group = DB::table('sys_menu_groups')->select('id','name')->get();
        return view('dashboard.system_utility.menu.edit')->with('data',$data)->with('group',$group);
    }

    public function list() {
        $data['data'] = DB::table('sys_menus')
            ->select('sys_menus.id','sys_menu_groups.name as id_group','sys_menus.name','sys_menus.segment_name','sys_menus.url','sys_menus.ord')
            ->join('sys_menu_groups','sys_menus.id_group','=','sys_menu_groups.id')
            ->get();

        return json_encode($data);
    }

    public function submit(Request $request) {
        $type = $request->type;
        $id_group = $request->id_group;
        $name = $request->name;
        $segment_name = $request->segment_name;
        $url = $request->url;
        $ord = $request->ord;

        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $sysMenu = new sysMenu();
                $sysMenu->id_group = $id_group;
                $sysMenu->name = $name;
                $sysMenu->segment_name = $segment_name;
                $sysMenu->url = $url;
                $sysMenu->ord = $ord;
                $sysMenu->save();
            } elseif ($type == 'edit') {
                DB::table('sys_menus')
                    ->where('id','=',$request->id)
                    ->update([
                        'id_group' => $id_group,
                        'name' => $name,
                        'segment_name' => $segment_name,
                        'url' => $url,
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
