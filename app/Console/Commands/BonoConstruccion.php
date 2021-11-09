<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\InversionController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BonoConstruccion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bono:construccion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Paga el bono de construccion mensual';

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
        Log::info('Inciar Comando bonoContruccion '.Carbon::now()->format('Y-m-d'));

        $inversionController = new InversionController();
        $inversionController->bonoContruccion();
        Log::info('Fin Comando bonoContruccion '.Carbon::now()->format('Y-m-d'));

        return Command::SUCCESS;
    }
}
