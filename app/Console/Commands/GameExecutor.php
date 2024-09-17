<?php

namespace App\Console\Commands;

use App\Events\RemainingTimeChanged;
use App\Events\WinnerNumberGenerated;
use Illuminate\Console\Command;

class GameExecutor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start executing the game';
    private $time = 15;
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        while (true) {
            broadcast(event: new RemainingTimeChanged($this->time . 's'));
            $this->time--;
            sleep(seconds: 1);

            if ($this->time === 0) {
                $this->time = "Waiting to start";
                broadcast(event: new RemainingTimeChanged(time: $this->time));
                broadcast(event: new WinnerNumberGenerated(number: mt_rand(min: 1, max: 12)));
                sleep(seconds: 5);
                $this->time = 15;

            }
        }
    }
}
