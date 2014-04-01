<?php 

Class ProductsController extends BaseController 
{
	/*	
	product storage submission should be into store_product function
	Product: Necessary fields: product_name, price
			optional fields: product_desc, quantity, size
		
	*/
	public function store_product()
	{
		
		$input = Input::all();
		$rules = array('product_name'=>'required',
				'price'=> 'required|min:1',
				'quantity'=>'min:1',
				'size'=>'min:0.1'	
				);
		
		$validator = Validator::make($input,$rules);
		if(!$validator->fails())
		{
			$product = new Product;
			$product->product_name = $input['product_name'];
			$product->price = $input['price'];
			if (Input::has('product_desc'))
			{
    				$product->product_desc = $input['product_desc'];
				 
			}	
			if (Input::has('quantity'))
			{
    				$product->quantity = $input['quantity'];
			}
			if (Input::has('size'))
			{
    				$product->size = $input['size'];
			}
			$product->save();
			return Redirect::action('ProductsController@show');  // function to show all products
		}
		return Redirect::action('ProductsController@create');
	}
	public function create()
	{
		return View::make('create');
	}
	public function index()
	{
		return View::make('index');
	}
   
}
?>