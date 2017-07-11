<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Redis;
use App\CheckIps as CI;
use App\File;
use App\User;

class CheckIps implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (Redis::llen('ips') >= 1400) {
            $ips = Redis::lrange('ips', 0, Redis::llen('ips')-1);

            Redis::del('ips');

            $data = $ids = [];

            for($i=0; $i<count($ips); $i++) {
                $arr = explode(',', $ips[$i]);

                if ($arr) {
                    $data[] = $arr[1];

                    if (!isset($ids[$arr[1]])) {
                        $ids[$arr[1]] = [];
                    }
                    $ids[$arr[1]][] = $arr[0];
                }

                if((count($data) == 500) || ($i == count($ips)-1)) {
                    $this->updateCounts($data, $ids);
                    $data = $ids = [];
                }
            }
        }
    }

    private function updateCounts($data, $ids) {
        $res = CI::checkIpsReputation($data);

        foreach ($res as $key=>$value) {
            foreach ($ids[$key] as $id) {
                $file = File::find($id);
                // увеличиваем общий счётчик
                $file->increment('cnt_view');

                // если нужно, увеличиваем счётчик платных скачиваний
                if($value) {
                    $file->increment('cnt_pay_view');
                    $user = User::find($file->user_id);
                    $user->increment('cnt_pay_view');
                    $user->save();
                }

                $file->save();
            }
        }
    }
}
