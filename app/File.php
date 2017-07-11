<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Redis;
use App\Jobs\CheckIps;

class File extends Model
{
    /**
     * Возвращает путь к файлу
     *
     * @return string
     */
    public function getPath() {
        $path = storage_path() . '/file/' . $this->name;

        if (!file_exists($path)) {
            file_put_contents($path, md5($this->public_id));
        }

        return $path;
    }

    public function addView($ip) {
        //Redis::append('ips', $this->id . ',' . $ip . '|');
        Redis::rpush('ips', $this->id . ',' . $ip);

        // добавить задачу в очередь
        dispatch(new CheckIps());
    }
}
