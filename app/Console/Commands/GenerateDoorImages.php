<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class GenerateDoorImages extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'generate:door-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate door images.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $script_path = app_path() . '/Console/Commands/generate-door-images.py';
        $img_path    = public_path() . '/img';
        system("python3 $script_path $img_path", $error);
        if ($error === 0) {
            $this->info('Door images created successfully.');
        }
        else {
            $this->error('Something went wrong!');
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments() {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return [];
    }
}
