<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use EasyWeChat;

class WechatMenu extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wechat:menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Wechat Menu';

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
        $app = EasyWeChat::officialAccount();
        $app->menu->create(config('menu'));
    }
}
