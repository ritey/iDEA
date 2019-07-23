<?php

namespace Idea\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class DBBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'idea:backup_db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $process = new Process('');
        $default_config = sprintf('database.connections.%s',config('database.default'));
        $db = config($default_config);
        if (!is_dir(config('app.coderstudios.backup_dir'))) {
            mkdir(config('app.coderstudios.backup_dir'));
        }
        $path = config('app.coderstudios.backup_dir') . '/' . $db['database'] . '-' . date('Y-m-d-h-i') . '.gz';

        $command = sprintf('mysqldump --host=%s --port=%s --user=%s --password=%s --opt %s | gzip -c | cat > %s',
            $db['host'],
            $db['port'],
            $db['username'],
            $db['password'],
            $db['database'],
            $path
        );
        $process->setCommandLine($command);
        $process->run();
    }
}