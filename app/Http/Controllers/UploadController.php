<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use League\Flysystem\Filesystem;
use  App\Upload as Upload;
use  App\User as User;
use Session;

class UploadController extends Controller {

	/**
	 * Show upload view.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('upload');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$images = $request->file('images');	

		foreach ($images as $image) 
		{
			$rules = array(
     			'image' => 'required|mimes:png,gif,jpeg,jpg|max:20000'
 		 	);

 		 	$validator = \Validator::make(array('image'=> $image), $rules);

 			if (! $validator->passes())
     		{
      			return redirect()->back()->withErrors($validator);
      		}

 			$extension = $image->getClientOriginalExtension();
			$filename = uniqid() . '.' . $extension;

			$path = public_path() . '/uploads';

			//Move file into uploads folder 
			$image->move($path, $filename);

			//Insert file name in db
			$image = Upload::create([ 
			 	'picture_name'		=> $filename,
			]);	
		}

		\Session::flash('success_message', 'Well done, images uploaded successfully.');
		return redirect()->back();
	}

	
}
