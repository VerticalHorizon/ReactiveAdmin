<?php	namespace VerticalHorizon\ReactiveAdmin;

use VerticalHorizon\ReactiveAdmin\AdminBaseController as Controller;

class AdminController extends Controller {

    protected $modelName;
    protected $viewsPath;
    protected $uriSegment;
    protected $resourceId;

    public function __construct()
    {
    	// TODO: refactor this!
        $this->model_config_path = app('path') . '/config/readmin';

        $this->uriSegment = null;
        $this->modelName = null;
        $this->viewsPath = null;
        $this->resourceId = null;

        if(Route::input('alias') !== null)
        {
            $this->uriSegment = Route::input('alias');
            $this->viewsPath = File::exists(app_path('views/admin/'.$this->uriSegment)) ? $this->uriSegment : 'defaults';
            $this->modelName = studly_case(str_singular(Route::input('alias')));
            if(Route::input('id') !== null)
            {
                $this->resourceId = Route::input('id');
            }

            View::share('config', require($this->model_config_path.'/'.$this->modelName.'.php'));

        }

        View::share('view', $this->uriSegment);
        View::share('model', $this->modelName);

    }

	/**
	 * Display a listing of admins
	 *
	 * @return Response
	 */
	public function index()
	{
		$admins = Admin::all();

		return View::make('admins.index', compact('admins'));
	}

	/**
	 * Show the form for creating a new admin
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admins.create');
	}

	/**
	 * Store a newly created admin in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Admin::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Admin::create($data);

		return Redirect::route('admins.index');
	}

	/**
	 * Display the specified admin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$admin = Admin::findOrFail($id);

		return View::make('admins.show', compact('admin'));
	}

	/**
	 * Show the form for editing the specified admin.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$admin = Admin::find($id);

		return View::make('admins.edit', compact('admin'));
	}

	/**
	 * Update the specified admin in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$admin = Admin::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Admin::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$admin->update($data);

		return Redirect::route('admins.index');
	}

	/**
	 * Remove the specified admin from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Admin::destroy($id);

		return Redirect::route('admins.index');
	}

}
