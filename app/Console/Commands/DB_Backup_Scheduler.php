<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Config;
use DB;
use Illuminate\Http\Request;


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class DB_Backup_Scheduler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DB_Backup_Generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is DB Backup for avoiding data loss!';

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
        // crontab -e
        // */1 * * * * cd /var/www/html && php artisan schedule:run every minute
        // */2 * * * * cd /var/www/html && php artisan schedule:run every 2 minute
        // */30 * * * * cd /var/www/html && php artisan schedule:run every 30 minute
        try {

            $database = config('app.db');

            // dd(config('app.db'));
            $user = config('app.dbuser');
            $pass = config('app.dbpass');
            $host = config('app.dbhost');
            $dir = public_path().'/DB_Backups/server_db_backup_'.getToday().'.sql';
            try {
                unlink($dir);
            } catch (\Throwable $th) {
            }

            // echo $database.' '.$user.' '.$pass . ' '.  $host .' '.$dir;

            // echo "<h3>Backing up database to `<code>{$dir}</code>`</h3>";
            // mysqldump -u [user name] –p [password] [options] [database_name] [tablename] > [dumpfilename.sql]
            // --add-drop-database --databases 
            // mysqldump --user=root --password=bismib_fashion@_mysql --host=localhost --events --routines --triggers elaravel_v2 --result-file=db_backup_new.sql 2>&1
            exec("mysqldump  --user={$user} --password={$pass} --host={$host} --events --routines --triggers  {$database}  --result-file={$dir} 2>&1", $output);

            $tableViewsCounts = DB::select('SELECT count(TABLE_NAME) AS TOTALNUMBEROFTABLES FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ?', [$database]);
            $tableViewsCounts = $tableViewsCounts[0]->TOTALNUMBEROFTABLES;
            
            $viewsCounts = DB::select('SELECT count(TABLE_NAME) AS TOTALNUMBEROFVIEWS FROM INFORMATION_SCHEMA.TABLES WHERE  TABLE_TYPE LIKE "VIEW" AND TABLE_SCHEMA = ?', [$database]);
            $viewsCounts = $viewsCounts[0]->TOTALNUMBEROFVIEWS;

            $tablesCount = $tableViewsCounts-$viewsCounts;


            $proceduresCounts = DB::select('SELECT count(TYPE) AS proceduresCounts FROM mysql.proc WHERE  TYPE="PROCEDURE" AND db = ?', [$database]);
            $proceduresCounts = $proceduresCounts[0]->proceduresCounts;

            $functionsCounts = DB::select('SELECT count(TYPE) AS functionsCounts FROM mysql.proc WHERE  TYPE="FUNCTION" AND db = ?', [$database]);
            $functionsCounts = $functionsCounts[0]->functionsCounts;

            $projectURL = url('/');
            $deviceIP = \Request::ip();

            $init_command = PHP_EOL.'-- '.$database.' Database Backup Generated time = '.YmdTodmYPm(\Carbon\Carbon::now()). PHP_EOL.PHP_EOL.
                            '-- Project URL = '.$projectURL.PHP_EOL.
                            '-- Device IP = '.$deviceIP.PHP_EOL.PHP_EOL.
                            '-- =============Objects Counting Start================= '.PHP_EOL.PHP_EOL.PHP_EOL.
                            '-- Total Tables + Views = '.$tableViewsCounts.PHP_EOL.
                            '-- Total Tables = '.$tablesCount.PHP_EOL.
                            '-- Total Views = '.$viewsCounts.PHP_EOL.PHP_EOL.
                            '-- Total Procedures = '.$proceduresCounts.PHP_EOL.
                            '-- Total Functions = '.$functionsCounts.PHP_EOL.
                            '-- =============Objects Counting End================= '.PHP_EOL.
                            PHP_EOL.PHP_EOL.
                            'SET FOREIGN_KEY_CHECKS=0; '. PHP_EOL.
                            'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";'. PHP_EOL.
                            'START TRANSACTION;'. PHP_EOL.
                            'SET time_zone = "+06:00";'.PHP_EOL.
                            'drop database if exists '.$database.';'. PHP_EOL.
                            'CREATE DATABASE IF NOT EXISTS '.$database.' DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;'. PHP_EOL.
                            'use '.$database.';'.PHP_EOL; 
                
            $data = file_get_contents($dir);

            $append_command = PHP_EOL.'SET FOREIGN_KEY_CHECKS=1;'.PHP_EOL.'COMMIT;'.PHP_EOL;
            // // dd($data);
            file_put_contents ( $dir , $init_command.$data.$append_command);
            // file_put_contents ( $dir , $data);

            echo 'DB Backup Done!';
            // return response()->download($dir);

            $log = [
                    'time' => getNow(),
                    'description' => 'DB Backup Scheduler Run'
                ];
            $db_backup_scheduler_log = new Logger('db_backup_scheduler');
            $db_backup_scheduler_log->pushHandler(new StreamHandler(storage_path('logs/db_backup_scheduler_log.log')), Logger::INFO);
            $db_backup_scheduler_log->info('db_backup_scheduler_log', $log);

        } catch (\Throwable $th) {
        }
    }
}
