<?php

class AdminsController extends \BaseController {
	/**
	 * To show admin console.
	 * /admin_console
	 *
	 */
	public function console()
	{
		Session::forget('messages');
		if(!(Session::has('adminID')))
		{
			return View::make('admins.console');
		}
		return View::make('admins.console');
	}


	/**
	* To add  a new employee
	* /addUser
	*/
	public function addUser()
	{
		Session::forget('messages');
		$username = Input::get('username');
		$validator = Validator::make(
			array('username' => $username),
			array('username' => 'exists:users'
				 )
			);
		if($validator->passes())
		{
			Session::put('messages',"A user by this name already exists please check your input");
			return View::make('admins.edit');
		}
		if($validator->fails())
		{
			$password = Hash::make(Request::input('password'));
			DB::table('users')->insert(
			    ['username' => $username, 'password' => $password]
			);
			Session::put('messages',"ADDED USER TO THE DATABASE");
			return View::make('admins.edit');
		}
	}


	/**
	* To remove an employee
	* target route /removeUser
	*source route /remove
	*/
	public function removeUser()
	{
		Session::forget('messages');
		$username = Request::input('username');
		$validator = Validator::make(
			array('username' => $username),
			array('username' => 'exists:users'
				 )
			);
		if($validator->fails())
		{
			Session::put('messages',"SUCH A USER DOESN'T EXIST");
			return View::make('admins.removeEmployee');
		}
		if($validator->passes())
		{
			DB::table('users')->where('username', $username)->delete();
			Session::put('messages',"EMPLOYEE HAS BEEN REMOVED");
			return View::make('admins.removeEmployee');
		}
	}

	/**
	* To order stock of a product
	* target route /orderStock
	*source route /reorder
	*/
	public function orderStock()
	{
		Session::forget('messages');
		$productID = Request::input('username');
		Log::info($productID);
		$validator = Validator::make(
			array('productID' => $productID),
			array('productID' => 'exists:products'
				 )
			);
		if($validator->fails())
		{
			Session::put('messages',"SUCH A PRODUCT DOESN'T EXIST");
			return View::make('admins.orderStock');
		}
		if($validator->passes())
		{
			$productStatus = DB::table('products')->where('productID', $productID)->pluck('Deprecated');
			if($productStatus == 1)
			{
				Session::put('messages',"THIS PRODUCT HAS BEED DEPRECATED");
				return View::make('admins.orderStock');	
			}
			$ReorderLevel = DB::table('products')->where('productID', $productID)->pluck('ReorderLevel');
			$UnitsInStock = DB::table('products')->where('productID', $productID)->pluck('UnitsInStock');
			if($UnitsInStock-10>$ReorderLevel)
			{
				Session::put('messages',"PRODUCT MEETS MINIMUM STOCK LEVEL, REORDER NOT REQUIRED!");
				return View::make('admins.orderStock');
			}
			$ReorderQuantity = DB::table('products')->where('productID', $productID)->pluck('ReorderQuantity');
			DB::table('products')
			            ->where('productID', $productID)
			            ->update(['UnitsOnOrder' => $ReorderQuantity]);
			Session::put('messages',"RESTOCK REQUEST PLACED");
			return View::make('admins.orderStock');
		}
	}


	/**
	* To deprecate a product from sales
	* target route /dep
	*source route /deprecate
	*/
	public function deprecateProduct()
	{
		Session::forget('messages');
		$productID = Request::input('username');
		Log::info($productID);
		$validator = Validator::make(
			array('productID' => $productID),
			array('productID' => 'exists:products'
				 )
			);
		if($validator->fails())
		{
			Session::put('messages',"SUCH A PRODUCT DOESN'T EXIST");
			return View::make('admins.deprecate');
		}
		if($validator->passes())
		{
			$productStatus = DB::table('products')->where('productID', $productID)->pluck('Deprecated');
			if($productStatus == 1)
			{
				Session::put('messages',"THIS PRODUCT HAS BEED DEPRECATED ALREADY");
				return View::make('admins.deprecate');
			}
			DB::table('products')
			            ->where('productID', $productID)
			            ->update(['Deprecated' => 1, 'DeprecateStart' => date('Y-m-d'), 'DeprecateEnd' => date('Y-m-d')]);
			Session::put('messages',"PRODUCT HAS BEEN DEPRECATED");
			return View::make('admins.deprecate');
		}
	}


	/**
	* To deprecate a product from sales
	* target route /dep
	*source route /revoke
	*/
	public function revokeProduct()
	{
		Session::forget('messages');
		$productID = Request::input('username');
		Log::info($productID);
		$validator = Validator::make(
			array('productID' => $productID),
			array('productID' => 'exists:products'
				 )
			);
		if($validator->fails())
		{
			Session::put('messages',"SUCH A PRODUCT DOESN'T EXIST");
			return View::make('admins.deprecate');
		}
		if($validator->passes())
		{
			$productStatus = DB::table('products')->where('productID', $productID)->pluck('Deprecated');
			if($productStatus == 0)
			{
				Session::put('messages',"THIS PRODUCT IS ALREADY IN USE");
				return View::make('admins.deprecate');
			}
			DB::table('products')
			            ->where('productID', $productID)
			            ->update(['Deprecated' => 0, 'DeprecateEnd' => date('Y-m-d')]);
			Session::put('messages',"PRODUCT HAS BEEN REVOKED");
			return View::make('admins.deprecate');
		}
	}

	/**
	 * To login as an admin.
	 * /admin_login
	 *
	 */
	public function login()
	{
		Session::forget('messages');
		Session::flush();
		$username = Input::get('username');
		$password = Input::get('password');
		$validator = Validator::make(
			array('username' => $username),
			array('username' => 'required|exists:admins')
			);
		
		if($validator->passes())
		{
			$db_password = DB::table('admins')->where('username', $username)->pluck('password');
			//$db_password = DB::select('select password from users where username = ?', array($username));
			$messages = "";
			if (Hash::check($password, $db_password) != 1)
			{
				Log::info("LogIN status");
				Log::info(Hash::check($password, $db_password));
				$messages = 'Incorrect User ID or Password, please Check your credentials';
				return View::make('admins.index')->with('user','ADMIN');
			}

			else if(Hash::check($password, $db_password) == 1)		//If the data is accepted and login is successful.
			{
				Session::put('user',"ADMIN");
				$adminID = DB::table('admins')->where('username', $username)->pluck('id');
				Session::put('adminID',$adminID);
				if (Session::has('errors'))
				{
					Session::flush();
					Session::forget('errors');
				}
				return View::make('admins.console');
			}
		}
		elseif($validator->fails())
		{
			$messages = 'Incorrect User ID or Password, please Check your credentials';
			Session::put('errors',$messages);
			return View::make('admins.index')->with('user','ADMIN');
		}
	}

	/**
	 * Display a listing of the resource.
	 * GET /admins
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Session::has('adminID'))
		{
			Redirect::to('/admins_console');
		}
		Session::flush();
		return View::make('admins.index')->with('user','ADMIN');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admins/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admins.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admins
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admins/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$admin = ADMIN::find($id);
		return View::make('admins.show',compact('admin'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admins/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$admin = ADMIN::find($id);
		return View::make('admins.edit');
	}


	/**
	* To generate the chart witht he given data
	*source route /genChart
	*/
	public function getChart()
	{
		$productID = Input::get('productID');
		$timePeriod = Input::get('timePeriod');
		$currentYear = idate("Y");
		$salesValues = array();
		//SELECT SUM(UnitPrice) FROM order details WHERE OrderID = (SELECT OrderID FROM Order WHERE (YEAR(OrderDate) <= CurrentYear))
		while ( $timePeriod>=0) {
			$yearSale = DB::select('select SUM(UnitPrice) FROM orderdetails WHERE (OrderYear = :year) AND (ProductID = :product)', ['product' => $productID,'year' => $currentYear-$timePeriod]);
			$temp = ((array)$yearSale[0]);
			array_push($salesValues, $temp['SUM(UnitPrice)']);
			$timePeriod = $timePeriod - 1;
		}
		return View::make('admins.chart')->with('sales',$salesValues);
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /admins/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return View::make('admins.update');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admins/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
