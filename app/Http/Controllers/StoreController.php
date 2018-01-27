<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Store;
use Validator;

class StoreController extends Controller {

    protected $store;

    public function get($id = 0) {
        if ($id == 0) {
            return Store::all();
        } else {
            $array[0]='';
            return $array[1]=Store::find($id);
        }
    }

    public function set($array) {
        $store = new Store();
        $store->title = addslashes($array[1]);
        $store->regionId = $array[0];
        $store->city = addslashes($array[2]);
        $store->address = addslashes($array[3]);
        $store->userId = $array[4];

        return $this->store = $store;
    }

    public function isValid($param) {
        if (is_array($param)){
            $validator = Validator::make($param, [
                    '0'=> 'required|integer',
                    '1' => 'required|string',
                    '2' => 'required|string',
                    '3' => 'required|string',
                    '4' => 'required|integer',
            ]);
            if ($validator->passes()) {
                return true;
            }
        }
        return false;
    }

    public function save($store) {
        if ($this->isValid($store)) {
            $storeModel = $this->set($store);
            $storeModel->save();
            return true;
        }
        return false;
    }

}
