<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function viewHome(Request $request)
    {

        $user = session('user');
        return view('admin.home', ['user' => $user]);
    }

    public function viewIndex()
    {
        $user = session('user');
        $datas = DB::select("
            SELECT g.id_g AS id, g.name_g AS name, g.price AS price, t.name_t AS type
            FROM gunpla g LEFT JOIN type t
            ON g.id_t = t.id_t WHERE g.status = :status;", [ 'status' => 'av']);
        return view('admin.index',['user' => $user])->with('datas', $datas);
    }



    public function viewAdd($status)
    {
        $user = session('user');
        return view('admin.add', ['user' => $user])->with('status', $status);
    }

    public function insert(Request $request, $status){
        $user = session('user');
        $request->validate([
            'id_g' => 'required',
            'name_g' => 'required',
            'type_g' => 'required',
            'price' => 'required',
        ]);

        $datas = DB::select('SELECT id_g FROM gunpla WHERE id_g = :id;', ['id'=>$request->id_g]);
        if($datas != null){
            return view('admin.add')->with(['error_D'=> '[Ganti ID menu] > Terdapat menu denga ID yang sama', 'status' => $status]);
        }

        DB::insert(
            'INSERT INTO gunpla(id_g,name_g, price, id_t, status)
                    VALUES (:id_g, :name_g, :price, :type_g, :status);',
            [
                'id_g' => $request->id_g,
                'name_g' => $request->name_g,
                'price' => $request->price,
                'type_g' => $request->type_g,
                'status' => $status
            ]
        );

        $data = DB::table('gunpla')->where('id_g', $request->id_g)->first();
        $status = $data->status;
        if ($status == 'av'){ $rt = 'admin.index';}
        else {$rt = 'admin.bin';}

        return redirect()->route($rt)->with('success', 'Added new unit add to database is success');
    }

    public function edit($id)
    {
        $user = session('user');
        $data = DB::table('gunpla')->where('id_g', $id)->first();
        $unitType = DB::table('type')->where('id_t', $data->id_t)->first();
        return view('admin.edit', ['user' => $user])->with(['data' => $data, 'unitType' => $unitType]);
    }

    public function update($id, Request $request)
    {
        $user = session('user');
        $request->validate([
//            'id_g' => 'required',
            'name_g' => 'required',
            'type_g' => 'required',
            'price' => 'required',
        ]);

        DB::update(
            'UPDATE gunpla SET
                     name_g = :name_g,
                     id_t = :type_g,
                     price = :price
                 WHERE id_g = :id',
            [
                'id' => $id,
                'name_g' => $request->name_g,
                'type_g' => $request->type_g,
                'price' => $request->price,
            ]
        );

        $data = DB::table('gunpla')->where('id_g', $id)->first();
        $status = $data->status;
        if ($status == 'av'){ $rt = 'admin.index';}
        else {$rt = 'admin.bin';}

        return redirect()->route($rt)->with('success', 'Data of unit changed is success');
    }

    public function search(Request $request, $status)
    {
        $user = session('user');
        $kw = $request->input('key');
        $skw = '%'.(string)$kw.'%';
        $datas = DB::select(
            "
            SELECT g.id_g AS id, g.name_g AS name, g.price AS price, t.name_t AS type
            FROM gunpla g LEFT JOIN type t
            ON g.id_t = t.id_t
            WHERE g.status = :status AND g.name_g LIKE :keyword ;",
            [
                'keyword' => $skw,
                'status' => $status
            ]
        );

        if ($status == 'av'){ $rt = 'admin.index';}
        else {$rt = 'admin.bin';}

        return view($rt, ['user' => $user])->with('datas', $datas);
    }

    public function softDelete($id)
    {
        $user = session('user');
        $data = DB::table('gunpla')->where('id_g', $id)->first();
        $save_data = $data->name_g;
        DB::update(
            'UPDATE gunpla SET status = :status WHERE id_g = :id',
            [
                'id' => $id,
                'status' => 'nav'
            ]
        );
        // DB::delete('DELETE FROM ice_cream WHERE id_ic = :id_v', ['id_v' => $id]);
        return redirect()->route('admin.index')->with('success', 'Unit '. $save_data .' has moved to recycle bin');
    }

}
