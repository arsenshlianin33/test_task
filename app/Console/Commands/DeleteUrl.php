<?php

namespace App\Console\Commands;

use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete no valid URL';

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
     * @return int
     */
    public function handle()
    {
        $url = Url::all();
        foreach ($url as $row) {
            if ($row->transitions != 0 and $row->count >= $row->transitions) {
                $row->delete();
            }
            if(Carbon::now() > $row->created_at->addHour($row->time_of_action)) {
                $row->delete();
            }
        }
    }
}
