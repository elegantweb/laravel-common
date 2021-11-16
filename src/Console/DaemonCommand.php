<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

abstract class DaemonCommand extends Command
{
    /**
     * The delay between each tick in seconds.
     *
     * @var int
     */
    protected $delay = 1;

    /**
     * The current tick.
     * Current tick is always zero in daemon mode.
     *
     * @var int
     */
    protected $tick = 0;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->addOption('daemon', null, InputOption::VALUE_NONE);
        $this->addOption('ticks', null, InputOption::VALUE_REQUIRED, '', 0);
    }

    /**
     * The function to run on every tick.
     *
     * @return void
     */
    abstract public function tick();

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('daemon')) {
            $this->daemon();
        } else {
            $this->tick();
        }
    }

    protected function daemon()
    {
        while ($this->cond()) {
            $start = microtime(true);
            $this->tick();
            @time_sleep_until($start + $this->delay);
        }
    }

    /**
     * The condition which indicates the daemon should continue running or no.
     *
     * @return bool
     */
    protected function cond()
    {
        if ($ticks = $this->option('ticks')) {
            return ++$this->tick <= $ticks;
        } else {
            return true;
        }
    }
}
