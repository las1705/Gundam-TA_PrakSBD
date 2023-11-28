<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BinController extends Controller
{


    public function viewBin()
    {
        $user = session('user');
        $datas = DB::select("
            SELECT g.id_g AS id, g.name_g AS name, g.price AS price, t.name_t AS type
            FROM gunpla g LEFT JOIN type t
            ON g.id_t = t.id_t WHERE g.status = :status;", [ 'status' => 'nav']);
        return view('admin.bin',['user' => $user])->with('datas', $datas);
    }

    public function restoreAll()
    {
        $user = session('user');
        DB::update(
            'UPDATE gunpla SET status = :status WHERE status = :newStatus',
            [
                'status' => 'av',
                'newStatus' => 'nav'
            ]
        );
        // DB::delete('DELETE FROM ice_cream WHERE id_ic = :id_v', ['id_v' => $id]);
        return redirect()->route('admin.index')->with('success', 'All unit in recycle bin has been RESTORE');
    }
    public function restoreSingle($id)
    {
        $user = session('user');
        $data = DB::table('gunpla')->where('id_g', $id)->first();
        $save_data = $data->name_g;
        DB::update(
            'UPDATE gunpla SET status = :status WHERE id_g = :id',
            [
                'id' => $id,
                'status' => 'av'
            ]
        );
        // DB::delete('DELETE FROM ice_cream WHERE id_ic = :id_v', ['id_v' => $id]);
        return redirect()->route('admin.index')->with('success', 'Unit '. $save_data .' has been RESTORE');
    }

    public function deleteAll()
    {
        $user = session('user');
        DB::delete('DELETE FROM gunpla WHERE status = :status ;', ['status' => 'nav']);
        return redirect()->route('admin.bin')->with('success', 'All unit in recycle bin has been DESTROY');
    }

    public function deleteSingle($id)
    {
        $user = session('user');
        $data = DB::table('gunpla')->where('id_g', $id)->first();
        $save_data = $data->name_g;
        DB::delete('DELETE FROM gunpla WHERE id_g = :id ;', ['id' => $id]);
        return redirect()->route('admin.bin')->with('success', 'Unit '. $save_data .' has been DESTROY');

    }

}
