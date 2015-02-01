<?php

class AjaxController extends Controller {
	protected function postSelectSupplier() {
		

	if (Request::ajax()){
			$inputform = Input::all();
			
			$name_service = $inputform['name_service'];
			$date = $inputform['date'];
			$area = $inputform['area'];
			$city = $inputform['city'];
			$flexibility = $inputform['flexibility'];

			 $supplier = DB::table('supplier')
                    ->where('supplier_feature', '=', $name_service)
                    ->orWhere('office_address','=', $area)
                    ->get();
			 $supplier_count = DB::table('supplier')
			 ->where('supplier_feature', '=', $name_service)
			 ->orWhere('office_address','=', $area)
			 ->count();
			
			 return View::make('ajax.select-supplier')->with('supplier',$supplier );
		}
		
		
		
	}
	
	
	
}
