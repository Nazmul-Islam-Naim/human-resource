<?php 
namespace App\Enums;
use ReflectionEnum;
enum Status: int{
    case Inactive = 0;
    case Active = 1;

    // public static function getCases(){
    //     return array_column(self::cases(),'name');
    // }

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

    public static function getByValue($value){
        foreach(self::cases() as  $item){
            // dd($item->value);
            if($item->value == $value){
                $itemValue = $item->name;
                break;
            }
        }
        return $itemValue;
    }
}