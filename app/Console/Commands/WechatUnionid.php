<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use EasyWeChat;

class WechatUnionid extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wechat:unionid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get unionid by wechat user openid';

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
        $app  = EasyWeChat::officialAccount();

        while (true)
        {
            $input = $this->ask('Input wechat user openid (input "exit" to quit)');

            if ($input == 'exit') {
                break;
            }

            $user    = $app->user->get($input);
            $unionid = isset($user['unionid']) ? $user['unionid'] : 'Not Found !!!';

            $this->info("union id: {$unionid}");
        }
    }
}
