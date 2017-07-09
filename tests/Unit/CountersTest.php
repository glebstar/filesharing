<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Jobs\CheckIps;
use App\File;

class CountersTest extends TestCase
{
    public function testCounters()
    {
        $startTime = time();

        // иммитируем скачивания
        for($i=0; $i<=1450; $i++) {
            $file = File::find(rand(1, 9));
            $file->getPath(true, round(1, 5000));
        }

        // запуск команды для обработки счётчиков
        $command = new CheckIps();
        $command->handle();

        // проверка, что не превысили 40 секунд на исполнение
        $this->assertTrue((time() - $startTime) <= 40);
    }
}
