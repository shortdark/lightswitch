<?php

namespace Shortdark;

class Lightswitch implements LightswitchInterface
{

    protected $random_integer_array=[];


    /**
     * @param int $lowestinteger
     * @param int $highestinteger
     * @param int $volumeofintegers
     * @return array $random_integer_array
     */
    public function press($lowestinteger=0, $highestinteger=0, $volumeofintegers=0)
    {

        self::populateAndRemoveDuplicates($lowestinteger, $highestinteger, $volumeofintegers);
        return $this->random_integer_array;
    }

    /**
     * @param int $lowestinteger
     * @param int $highestinteger
     * @return int $random_integer
     */
    private function generateRandomInteger($lowestinteger=0, $highestinteger=0)
    {

        $random_integer = rand($lowestinteger, $highestinteger);
        return $random_integer;
    }

    /**
     * @param int $lowestinteger
     * @param int $highestinteger
     * @param int $volumeofintegers
     */
    private function populateArray($lowestinteger=0, $highestinteger=0, $volumeofintegers=0)
    {

        $size = self::countSizeOfArray();

        if($volumeofintegers > 0 && $lowestinteger > 0 && $highestinteger > $lowestinteger){
            while( $volumeofintegers > $size ){
                $this->random_integer_array[] = self::generateRandomInteger($lowestinteger, $highestinteger);
            }
        }
        return;
    }

    /**
     * @param int $volumeofintegers
     */
    private function removeDuplicateValues($volumeofintegers=0)
    {

        if( isset($random_integer_array) && isset($volumeofintegers) ){
            $this->random_integer_array = array_unique($random_integer_array);
        }

        return;
    }

    /**
     * @param int $lowestinteger
     * @param int $highestinteger
     * @param int $volumeofintegers
     */
    private function populateAndRemoveDuplicates($lowestinteger=0, $highestinteger=0, $volumeofintegers=0)
    {


        self::populateArray($lowestinteger, $highestinteger, $volumeofintegers);

        self::removeDuplicateValues($volumeofintegers);

        $size = self::countSizeOfArray();

        if($volumeofintegers > $size){
            self::populateAndRemoveDuplicates($lowestinteger, $highestinteger, $volumeofintegers);
        }

        return;
    }

    /**
     * @return int
     */
    private function countSizeOfArray()
    {
        $array_size = count($this->random_integer_array);
        return $array_size;
    }


}
