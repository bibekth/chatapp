<?php

namespace App\Console\Commands;

use App\Models\Message;
use Exception;
use Illuminate\Console\Command;

class DeleteMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-message-command';

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
        try{
            $now = now();
            $oneDayAgo = $now->subDay();
            $oldmessages = Message::where('created_at','<',$oneDayAgo)->get(['id']);
            $response = Message::whereIn('id',$oldmessages)->delete();
            $this->info('Successfully deleted');
        }catch(Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
