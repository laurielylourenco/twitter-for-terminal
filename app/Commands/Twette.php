<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Library\Twitter;

class Twette extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'post:tweet';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Post on twitter';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Twitter $twitter)
    {
       try {
            $tweet = $this->ask("O que voce esta pensando ?"); 
            $teste =  $twitter->postTweet($tweet); 

       } catch (\Throwable $th){
            $this->error($th->getMessage());
       }
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
