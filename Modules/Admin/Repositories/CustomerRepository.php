<?php

namespace Modules\Admin\Repositories;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use Storage;
use Hash;
use App\Http\libraries\Session;
use App\Customer\Customer;
use App\Customer\CustomerAddress;
use App\Customer\CustomerGrouping;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CustomerRepository {

    public function saveCustomer($request, $cust, $group_id) {

        $cust->first_name      = $request->first_name;
        if($request->has('middle_name')) {
            $cust->middle_name = $request->middle_name;
        }
        $cust->last_name       = $request->last_name;
        $cust->email           = $request->email;
        $cust->password        = Hash::make($request->katasandi);
        $cust->group_id        = $group_id;
        $cust->gender          = $request->gender;
        $cust->company         = 'kunci.io';
        $cust->status          = isset($request->status_customer) ? $request->status_customer : null;
        $cust->save();

        $cust->assignRole(['2']);

        $cam = new CustomerAddress;
        $cam->setConnection('mysql');
        if($cam->where('customer_id', $cust->id)->first() != null) {
            $cam->update([
                'street'    => $request->street,    'city'   => $request->city, 
                'postcode'  => $request->postcode,  'region' => $request->region, 
                'telephone' => $request->telephone, 'fax'    => isset($request->fax) ? $request->fax : null,
                'province'  => $request->region
            ]);
        } else {
            $cam->insert([
                'customer_id' => $cust->id,          'street' => $request->street,  'city'      => $request->city,
                'postcode'    => $request->postcode, 'region' => $request->region,  'telephone' => $request->telephone, 
                'province'    => $request->region,   'fax'    => isset($request->fax) ? $request->fax : null
            ]);
        }

        if($request->has('group')) {
            $custGrouping = new CustomerGrouping;
            $custGrouping->setConnection('mysql');
            $custGrouping = $custGrouping->where('customer_id', $cust->id)->get();
            if(count($custGrouping) > 0) {
                $custGrouping->delete();
            }

            foreach($request->group as $g) {
                $cg = new CustomerGrouping;
                $cg->customer_id       = $cust->id;
                $cg->customer_group_id = $g;
                $cg->save();
            }
        }

        return $cust;
    }
}