<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Library\Twitter;
class TesteApi extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'user:test';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Testar se a API esta funcionando trazendo as informações';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Twitter $twitter)
    {
        $teste = $twitter->testeApiTwitter();
        $this->info("@".$teste["screen_name"]);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
