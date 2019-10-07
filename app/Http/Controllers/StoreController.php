<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{

    public function get_all_stores() {
      $result = Store::all();

      // stores -> [id, name, days[]]
      $stores = [];
      foreach ($result as $row) {
        $store = [];
        $store['id'] = $row->id;
        $store['name'] = $row->name;
        $store['days'] = [$row->mo, $row->tu, $row->we, $row->th, $row->fr, $row->sa, $row->su];
        $stores[] = $store;
      }
      $data['stores'] = $stores;

      return json_encode($data);
    }

    public function save_stores(Request $request) {

      if ($request->has('tbl')) {
        $data = $request->input('tbl');
        // $rows = count($data['stores']);
        foreach ($data['stores'] as $store) {
          $current_store = Store::find($store['id']);
          $current_store['mo'] = $store['days'][0];
          $current_store['tu'] = $store['days'][1];
          $current_store['we'] = $store['days'][2];
          $current_store['th'] = $store['days'][3];
          $current_store['fr'] = $store['days'][4];
          $current_store['sa'] = $store['days'][5];
          $current_store['su'] = $store['days'][6];
          $current_store->save();
        }
        return response()->json(["result" => "OK"]);
      }

      return response()->json(["result" => "FAIL"]);
    }

    public function stores() {
      return View('stores');
    }
}
