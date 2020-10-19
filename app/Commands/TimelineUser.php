<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Library\Twitter;



class TimelineUSer extends Command
{
    
    protected $montarTimeline;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'user:timeline';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List tweets your timeline';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Twitter $twitter)
    {
       try {
            $timeline = $twitter->timelineTerminal(5); 
            foreach ($timeline as $tweet) {

                $nome  = $tweet->user->name;
                $username  = $tweet->user->screen_name;
                $texto = $tweet->text;
                $data = $tweet->created_at;

                $this->info("-------------------------------------------------");
                $this->montarTimeline = $this->line($nome)."  ".$this->line("@".$username).$this->line($data)."<br>".$this->line($texto);
                $this->info("-------------------------------------------------");
            } 
           
       }catch (\Throwable $th) {
           
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
