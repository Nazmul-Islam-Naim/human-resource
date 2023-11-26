<?php
namespace App\Enum;
use ReflectionEnum;
enum DocumentTitleEnum: string{
    case Offer_Letter = 'Offer Letter';
    case Joining_Letter = 'Joining Letter';
    case Transfer_Letter = 'Transfer Letter';
    case Release_Letter = 'Release Letter';
    case Pension_Letter = 'Pension Letter';

    public static function getCases(){
        return array_column(self::cases(),'name');
    }

    /**
     * [return cases list with description]
     *
     * @return [array]
     *
     */
    public static function get(){
        foreach(array_column(self::cases(), 'name') as $item){
            $arr[$item]=self::getFromName($item)->value;
        }
        return $arr;
    }

        /**
     * [get case object by name]
     *
     * @return [type]
     *
     */
    public static function getFromName($name){
        $reflection = new ReflectionEnum(self::class);
        return $reflection->getCase($name)->getValue();
    }

    /**
     * [Description for toString]
     *
     * @return [type]
     *
     */
    public function toString(){
        return match($this){
            self::Offer_Letter=>"Offer Letter",
            self::Joining_Letter=>"Joining Letter",
            self::Transfer_Letter=>"Transfer Letter",
            self::Release_Letter=>"Release Letter",
            self::Pension_Letter=>"Pension Letter",
        };
    }

}
