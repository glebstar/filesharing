<?php

namespace App;

class CheckIps
{
    /**
     * Передаем сервису проверки IP список и получаем для каждого из них
     * нужно ли ему засчитывать просмотр (TRUE) или нет (FALSE)
     *
     * @param array $ips
     * @return array
     * @throws InvalidArgumentException
     */
    public static function checkIpsReputation (array $ips)
    {
        if (count($ips) > 500 )
            throw new InvalidArgumentException( 'Plz not more than 500 ips' );
        // Делаем запрос к внешнему сервису
        sleep( 7 + rand( 0 , 3 ));
        $res = [];
        foreach ($ips as $ip) {
            $res[$ip] = rand( 0 , 1 ) == 1 ;
        }
        return $res;
    }
}