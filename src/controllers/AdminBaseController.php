<?php namespace VerticalHorizon\ReactiveAdmin;

class AdminBaseController extends \Controller {

	public function __construct()
    {
    	// hook if ajax
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = \View::make($this->layout);
		}
	}

}
