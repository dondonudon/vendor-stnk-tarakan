<?php

namespace App\Http\Controllers;

use App\sysMenu;
use App\sysMenuGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class c_Dashboard extends Controller
{
    public static function sidebar() {
        $username = \request()->session()->get('username');

        if ($username == 'dev') {
            $group = DB::table('sys_menus')
                ->select('sys_menu_groups.id','sys_menu_groups.name','sys_menu_groups.segment_name','sys_menu_groups.icon','sys_menu_groups.ord','sys_menu_groups.status','sys_menu_groups.created_at','sys_menu_groups.updated_at')
                ->join('sys_menu_groups','sys_menus.id_group','=','sys_menu_groups.id')
                ->orderBy('sys_menu_groups.ord','asc')
                ->distinct()
                ->get();

            $dtMenu = DB::table('sys_menus')
                ->select('sys_menus.id', 'sys_menus.id_group', 'sys_menus.name', 'sys_menus.segment_name', 'sys_menus.url', 'sys_menus.ord','sys_menus.status', 'sys_menus.created_at', 'sys_menus.updated_at')
                ->orderBy('sys_menus.ord','asc')
                ->get();

            $menu = [];
            foreach ($dtMenu as $m) {
                $menu[$m->id_group][] = [
                    'id' => $m->id,
                    'id_group' => $m->id_group,
                    'name' => $m->name,
                    'segment_name' => $m->segment_name,
                    'url' => $m->url,
                    'ord' => $m->ord,
                    'created_at' => $m->created_at,
                    'updated_at' => $m->updated_at,
                ];
            }
        } else {
            $group = DB::table('sys_permissions')
                ->select('sys_menu_groups.id','sys_menu_groups.name','sys_menu_groups.segment_name','sys_menu_groups.icon','sys_menu_groups.ord','sys_menu_groups.created_at','sys_menu_groups.status','sys_menu_groups.updated_at')
                ->join('sys_menus','sys_permissions.id_menu','=','sys_menus.id')
                ->join('sys_menu_groups','sys_menus.id_group','=','sys_menu_groups.id')
                ->where('sys_permissions.username','=',$username)
                ->where('sys_menu_groups.status','<>',1)
                ->orderBy('sys_menu_groups.ord','asc')
                ->distinct()
                ->get();

            $dtMenu = DB::table('sys_permissions')
                ->select('sys_menus.id', 'sys_menus.id_group', 'sys_menus.name', 'sys_menus.segment_name', 'sys_menus.url', 'sys_menus.ord','sys_menus.status', 'sys_menus.created_at', 'sys_menus.updated_at')
                ->join('sys_menus','sys_permissions.id_menu','=','sys_menus.id')
                ->where('sys_permissions.username','=',$username)
                ->where('sys_menus.status','<>',1)
                ->orderBy('sys_menus.ord','asc')
                ->get();

            $menu = [];
            foreach ($dtMenu as $m) {
                $menu[$m->id_group][] = [
                    'id' => $m->id,
                    'id_group' => $m->id_group,
                    'name' => $m->name,
                    'segment_name' => $m->segment_name,
                    'url' => $m->url,
                    'ord' => $m->ord,
                    'status' => $m->status,
                    'created_at' => $m->created_at,
                    'updated_at' => $m->updated_at,
                ];
            }
        }

        $i = 0;
        $sidebar = [];
        foreach ($group as $g) {
            $sidebar[$i]['group'] = [
                'name' => $g->name,
                'segment_name' => $g->segment_name,
                'icon' => $g->icon,
                'status' => $g->status,
            ];
            $sidebar[$i]['menu'] = $menu[$g->id];
            $i++;
        }
        return $sidebar;
    }

    public function wilayahProvinsi(Request $request) {
        if (isset($_GET['search'])) {
            $provinsi['results'] = DB::table('wilayah_provinsi')
                ->select('id','name as text')
                ->where('name','like','%'.$_GET['search'].'%')
                ->orderBy('name','asc')
                ->get();
            return $provinsi;
        } else {
            $provinsi['results'] = DB::table('wilayah_provinsi')
                ->select('id','name as text')
                ->orderBy('name','asc')
                ->get();
            return $provinsi;
        }
    }

    public function wilayahKota(Request $request) {
        if (isset($_GET['search'])) {
            $kota['results'] = DB::table('wilayah_kota')
                ->select('id','name as text')
                ->where('name','like','%'.$_GET['search'].'%')
                ->where('id_provinsi','=',$_GET['provinsi'])
                ->orderBy('name','asc')
                ->get();
            return $kota;
        } else {
            $kota['results'] = DB::table('wilayah_kota')
                ->select('id','name as text')
                ->where('id_provinsi','=',$_GET['provinsi'])
                ->orderBy('name','asc')
                ->get();
            return $kota;
        }
    }

    public function dealer(Request $request) {
        if (isset($_GET['search'])) {
            $dealer['results'] = DB::table('ms_dealer')
                ->select('id','nama as text')
                ->where('nama','like','%'.$_GET['search'].'%')
                ->orderBy('nama','asc')
                ->get();
            return $dealer;
        } else {
            $dealer['results'] = DB::table('ms_dealer')
                ->select('id','nama as text')
                ->orderBy('nama','asc')
                ->get();
            return $dealer;
        }
    }

    public function samsat(Request $request) {
        if (isset($_GET['search'])) {
            $samsat['results'] = DB::table('ms_samsat')
                ->select('id','nama as text')
                ->where('nama','like','%'.$_GET['search'].'%')
                ->orderBy('nama','asc')
                ->get();
            return $samsat;
        } else {
            $samsat['results'] = DB::table('ms_samsat')
                ->select('id','nama as text')
                ->orderBy('nama','asc')
                ->get();
            return $samsat;
        }
    }
}
