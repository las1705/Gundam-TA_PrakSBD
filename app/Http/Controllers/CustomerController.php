<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function viewHomec(Request $request)
    {
        $user = session('user');
        if ($user == null){
            abort(403);
        }

        $datas = DB::select("
            SELECT g.id_g AS id, g.name_g AS name, g.price AS price, t.name_t AS type
            FROM gunpla g LEFT JOIN type t
            ON g.id_t = t.id_t WHERE g.status = :status;", [ 'status' => 'av']);
        return view('customer.home', ['user' => $user])->with('datas', $datas);
    }

    public function viewHistoryc(Request $request)
    {

        $user = session('user');
        $datas = DB::select("
                    SELECT c.username AS customer, g.name_g AS unit, tp.name_t AS type, t.quantity AS quantity, (t.quantity*g.price) AS price, t.create_at AS time
                    FROM transaction t
                    LEFT JOIN customer c ON t.id_c = c.id_c
                    LEFT JOIN gunpla g ON t.id_g = g.id_g
                    LEFT JOIN type tp ON g.id_t = tp.id_t
                    WHERE t.id_c = :idc;",
            [ 'idc' => $user->id_c]);
        return view('customer.history',['user' => $user])->with('datas', $datas);
    }

    public function buy(Request $request, $product, $user){
        $request->validate([
            'quantity' => 'required',
        ]);

        if($request->quantity == null || $request->quantity == 0){
            return redirect()->route('customer.home')->with('success', 'you cant buy item with 0 quantity');
        }

        DB::insert(
            'INSERT INTO transaction (id_c, id_g, quantity)
                    VALUES (:id_c, :id_g, :quantity);',
            [
                'id_c' => $user,
                'id_g' => $product,
                'quantity' => $request->quantity,
            ]
        );

        return redirect()->route('customer.home')->with('success', 'success buy');
    }

    public function searchc(Request $request)
    {
        $user = session('user');
        if ($user == null){
            abort(403);
        }

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
                'status' => 'av'
            ]
        );

        return view('customer.home', ['user' => $user])->with('datas', $datas);
    }

    public function viewAccount($id)
    {
        $user = session('user');
        if ($user == null){
            abort(403);
        }

        $datas = DB::select("SELECT * from customer WHERE id_c = :id",['id' =>$id]);
        $data = $datas[0];

        return view('customer.account', ['user' => $user])->with(['data' => $data]);
    }

    public function updateAccount($id, Request $request)
    {
        $request->validate([
//            'id_g' => 'required',
            'username' => 'required',
            'password' => 'required',
            'address' => 'required',
            'contact' => 'required',
        ]);

        DB::update(
            'UPDATE customer SET
                     username = :username,
                     password = :password,
                     address = :address,
                     contact = :contact
                 WHERE id_c = :id',
            [
                'id' => $id,
                'username' => $request->username,
                'password' => $request->password,
                'address' => $request->address,
                'contact' => $request->contact
            ]
        );

        return redirect()->route('customer.accountEdit', ['id'=>$id])->with('success', 'Data of your account changed is success');
    }

    public function accountSoftDelete($id)
    {
        $datas = DB::select("SELECT * from customer WHERE id_c = :id",['id' =>$id]);
        $data = $datas[0];
        $save_data = $data->username;
        DB::update(
            'UPDATE customer SET status = :status WHERE id_c = :id',
            [
                'id' => $id,
                'status' => 'not active'
            ]
        );
        return redirect()->route('login')->with('warning', 'Account '. $save_data .' has NOT ACTIVED');
    }


}
