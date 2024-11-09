<?php

namespace App\Console\Commands;

use App\Models\FlashSale;
use Illuminate\Console\Command;

class UpdateFlashSalesStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flashSale:change-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FlashSale::where('start_date','<=',now())
        ->update(['status'=>1]);

        FlashSale::where('end_date', '<=', now())->delete();

    }
}
