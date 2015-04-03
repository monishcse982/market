<?php

class UsersController extends \BaseController {


    /**
	 * To login as a user.
	 * PUT /user_login
	 *
	 */
	public function ulogin()
	{
		if(!(Session::has('userID')))
		{
			Log::info("Flushed the session before login");
			Session::flush();
		}

		if(Session::has('userID') && !(Session::has('errors')))
		{
			return  Redirect::to('/Users?');
		}

		if(Session::has('userID') && Session::has('errors'))
		{
			return View::make('Users.edit');
		}

		if (Session::has('errors'))
		{
			Session::forget('errors');
		}
		$username = Request::input('username');
		$password = Request::input('password');
		$validator = Validator::make(
			array(
				'username' => $username),
			array('username' => 'required|alpha_num|exists:users'
				 )
			);
		
		if($validator->passes())
		{
			$db_password = DB::table('users')->where('username', $username)->pluck('password');
			$messages = "";
			if (Hash::check($password, $db_password) != 1)
			{
				$messages = 'Incorrect User ID or Password, please Check your credentials';
				Log::info('Validation error 1');
				return View::make('Users.index');
			}

			else if(Hash::check($password, $db_password) == 1)		//If the data is accepted and login is successful.
			{
				Session::put('user',"USER");
				$userID = DB::table('users')->where('username', $username)->pluck('userID');
				Session::put('userID',$userID);
				if (Session::has('errors'))
				{
					Session::forget('errors');
				}
				Log::info('Validation succsess');
				return View::make('Users.edit');
			}
		}
		elseif($validator->fails())
		{
			$messages = 'Incorrect User ID or Password, please Check your credentials';
			Session::put('errors',$messages);
			Log::info('Validation error 2');
			return View::make('Users.index');
		}
	}

	 /**
	 * To login as a user.
	 * PUT /users
	 *
	 */
	 public function transactionUpdate()
	 {
	 	Log::info("Entered the update function");
	 	if(!(Session::has('userID')))
		{
			Log::info("Flushed the session");
			Session::flush();
			Session::put('errors',"You need to login first");
			return Redirect::to('Users?')->with('user','USER');
		}
		$input = Input::all();
		$prod = $input['products'];
		$quantity = $input['quantity'];
		foreach($prod as $product)
		{
			$validator = Validator::make(
			array('ProductId' => $product),
			array('ProductId' => 'required|integer|exists:products')
			);
		}
		if($validator->fails())
		{
			Log::info("ProductId is verified");
			$Errors = $validator->messages()->toArray();
			$errors = "";
			foreach ($Errors as $keys) 
			{
				foreach($keys as $key)
				{
					$errors = $errors."\n".(string)$key;
				}
			}
			Log::info($errors);
			Session::put('errors',$errors);
			return View::make('Users.edit');
		}
		if($validator->passes())
		{
			Log::info("ProductId didn't verify");
			foreach ($quantity as $qty)
			 {
				$validator = Validator::make(
				array('quantity' => $qty),
				array('quantity' => 'required|integer')
				);
			}
			if($validator->fails())
			{
				Log::info("Quantity didn't verify");
				$Errors = $validator->messages()->toArray();
				$errors = "";
				foreach ($Errors as $keys) 
				{
					foreach($keys as $key)
					{
						$errors = $errors."\n".(string)$key;
					}
				}
				Log::info($errors);
				Session::put('errors',$errors);
				return Redirect::to('/users_login');
			}
			if($validator->passes())
			{
				Log::info("Validations verified...");
				$noOfRecords = count($prod)-1;
				while($noOfRecords>=0)
				{
					$stockAvailable = DB::table('products')->where('ProductId', $prod[$noOfRecords])->pluck('UnitsInstock');
					if($quantity[$noOfRecords] >= $stockAvailable)
					{
						$errors = "Sorry, stock of ".(string)$prod[$noOfRecords]." is less than your request";
						Session::put('errors',$errors);
						return View::make('Users.edit');
					}
					$noOfRecords = $noOfRecords - 1;
				}
				if($noOfRecords ==-1)
				{
					Log::info("UPDATING TRANSACTION REOCRDS...");
					$userID = Session::get('userID');
					$noOfRecords = count($prod)-1;
					$OrderID = DB::table('orders')->insertGetId(
					    array('EmployeeID' => $userID, 'OrderDate' => date("Y-m-d", time()), 'workplace' => 'hyderabad')
					);
					while($noOfRecords>=0)
					{
						$UnitPrice = DB::table('products')->where('ProductId', $prod[$noOfRecords])->pluck('UnitPrice');
						$currentStock = DB::table('products')->where('ProductId', $prod[$noOfRecords])->pluck('UnitsInstock');
						
						DB::table('order details')->insert(
					    array('OrderID' => $OrderID,'ProductId' => $prod[$noOfRecords],'UnitPrice' => $UnitPrice,'Quantity' => $quantity[$noOfRecords])
					    );

					    DB::table('products')
							            ->where('ProductId', $prod[$noOfRecords])
							            ->update(array('UnitsInstock' => $currentStock-$quantity[$noOfRecords]));

						$noOfRecords = $noOfRecords -1;
					}
					Session::put('errors',"Transaction updated succesfully.");
					return View::make('Users.edit');
				}
			}
		}
	}

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{	
		if (Session::has('user'))
		{
		    $loggedUser = Session::get('user');
		    if($loggedUser == 'USER')
		    {
		    	return View::make('Users.edit');
		    }
		}
		return View::make('Users.index')->with('user','USER');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('Users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$users = DB::table('users')->get();
		foreach ($users as $user) {
			console.log($user);
		}
		return View::make('Users.show',compact('users'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
