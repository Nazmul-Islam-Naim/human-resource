<?php 
namespace App\Enums;
use ReflectionEnum;
enum ProjectStatus: string{
    case Running =  'Running';
    case Complete = 'Complete';

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
}