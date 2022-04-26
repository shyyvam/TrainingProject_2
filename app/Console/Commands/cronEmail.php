<?php

namespace App\Console\Commands;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class cronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails every week';

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
        $date = date('d/m/Y',strtotime('tomorrow'));
        $result = DB::table('issue')
                  ->join('users','issue.u_id','=','users.id')
                  ->join('books','issue.b_id','=','books.book_id')
                  ->select('books.book_name','users.name','issue.return_date')
                  ->where('issue.return_date','=',$date)
                  ->get();

        Mail::send(['html'=>'email.cron-email'],array('result'=>$result),function($message)
        {
          $message->from('shivam12061999@gmail.com','Commit2Clean');

          $message->subject('Notification for tomorrow return date'.'');

          $message->to('shivam12061999@outlook.com')->cc('sharma@gmail.com');
        }
      );
    }
}
