<?php

namespace App\Console\Commands;


use Carbon\Carbon;
use Illuminate\Console\Command;

class DeviceNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infusion:senddevicenotifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Device Notifications to Users';

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
    public function handle()
    {
        //  $txt = "John hello\n";

        // file_put_contents('test.txt', $txt.PHP_EOL , FILE_APPEND | LOCK_EX);
         $myfile = fopen("test.txt", "a") or die("Unable to open file!");
            $txt = "John Doe\n";
            fwrite($myfile, $txt);
            $txt = "Jane Doe\n";
            fwrite($myfile, $txt);
            $txt = "Jane Doe\n";
            fwrite($myfile, $txt);
            fclose($myfile);
        $this->info("File Updated.");
    }
}
