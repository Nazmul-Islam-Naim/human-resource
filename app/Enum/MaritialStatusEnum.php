<?php

namespace App\Enum;

use ReflectionEnum;

enum MaritialStatusEnum: int
{
    case Single      =   1;
    case Married     =   2;
    case Divorece    =   3;
    case Widowed     =   4;

    /**
     * [Will return cases name list]
     *
     * @return [array]
     *
     */
    public static function getCases(){
        return array_column(self::cases(), 'name');
    }

   /**
     * [return cases list with description]
     *
     * @return [array]
     *
     */
    public static function get(){
        foreach(array_column(self::cases(), 'name') as $item){
            $arr[$item]=self::getFromName($item)->toString();
        }
        return $arr;
    }

    
   /**
     * [return cases list with name and value]
     *
     * @return [array]
     *
     */
    public static function getEnum(){
        foreach(array_column(self::cases(), 'value') as $item){
            $arr[$item]=self::getFromValue($item)->toString();
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
     * [get case object by value]
     *
     * @return [type]
     *
     */
    public static function getFromValue(int $value){
        foreach (Self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }
        
        return null;
    }

    /**
     * [Description for toString]
     *
     * @return [type]
     *
     */
    public function toString(){
        return match($this){
            self::Single=>"Single",
            self::Married=>"Married",
            self::Divorece=>"Divorece",
            self::Widowed=>"Widowed",
        };
    }


}
