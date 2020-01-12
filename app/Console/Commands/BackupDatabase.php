<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Carbon;
use Storage;
use DB;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $process;
    public function __construct()
    {
        parent::__construct();

        // $this->process = new Process(sprintf(
        //     'mysqldump -u%s -p%s %s > %s',
        //     'root',
        //     '',
        //     'sistemacle',
        //     // config('database.connections.mysql.username'),
        //     // config('database.connections.mysql.password'),
        //     // config('database.connections.mysql.database'),
        //     storage_path('backups/backup.sql')
        // ));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //set filename with date and time of backup
$filename = "backup-" . Carbon\Carbon::now()->format('Y-m-d_H-i-s') . ".sql";

//mysqldump command with account credentials from .env file. storage_path() adds default local storage path
$command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  > " . storage_path() . "/" . $filename;

$returnVar = NULL;
$output  = NULL;
//exec command allows you to run terminal commands from php 
exec($command, $output, $returnVar);

//if nothing (error) is returned
if(!$returnVar){
    //get mysqldump output file from local storage
    $getFile = Storage::disk('local')->get($filename);
    // put file in backups directory on s3 storage
    Storage::disk('s3')->put("backups/" .  $filename, $getFile);
    // delete local copy
    Storage::disk('local')->delete($filename); 
}else{
    // if there is an error send an email 
    Mail::raw('There has been an error backing up the database.', function ($message) {
        $message->to("rich@example.com", "Rich")->subject("Backup Error");
    });
}
    }
}
