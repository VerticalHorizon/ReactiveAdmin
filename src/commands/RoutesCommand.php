<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RoutesCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'reactiveadmin:routes';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Append the default Reactiveadmin controller routes to the routes.php';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        // Prompt
        $this->line('');
        $this->info("Routes file: app/routes.php");

        if ($this->confirm("Proceed with the append? [Yes|no]")) {
            $this->info("Appending routes...");
            // Generate
            $filename = 'routes.php';
            //$this->appendInFile($filename, 'generators.routes', $viewVars);

            $this->info("app/routes.php Patched successfully!");
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
