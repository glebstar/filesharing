<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * Возвращает путь к файлу
     *
     * @param bool $isAddView Нужно ли засчитывать скачивание файла
     * @param string $ip IP адрес клиента
     *
     * @return string
     */
    public function getPath($isAddView = false, $ip = '') {
        $path = storage_path() . '/file/' . $this->name;

        if (!file_exists($path)) {
            file_put_contents($path, md5($this->public_id));
        }

        if ($isAddView) {
            // добавить IP в список проверяемых
        }

        return $path;
    }
}
