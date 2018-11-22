<?php

namespace Shortdark;

class Lightswitch implements LightswitchInterface
{

    protected $random_integer_array=[];


    /**
     * Press the lightswitch, i.e. generate the array of integers.
     *
     * @param int $lowestinteger
     * @param int $highestinteger
     * @param int $volumeofintegers
     * @return array $random_integer_array
     */
    public function press($lowestinteger=0, $highestinteger=0, $volumeofintegers=0)
    {

        self::populateAndRemoveDuplicates($lowestinteger, $highestinteger, $volumeofintegers);
        self::sortArrayLowToHigh();
        return $this->random_integer_array;
    }

    /**
     * Generate a random integer.
     *
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
     * Populate the array with a random integer.
     *
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
                $size = self::countSizeOfArray();
            }
        }
        return;
    }

    /**
     * Ensure that every item in the array is unique, i.e. remove duplicate values.
     *
     * @param int $volumeofintegers
     */
    private function removeDuplicateValues($volumeofintegers=0)
    {

        if( isset($this->random_integer_array) && isset($volumeofintegers) ){
            $this->random_integer_array = array_unique($this->random_integer_array);
        }

        return;
    }

    /**
     * Populate the array and remove duplicates.
     *
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
     * Count the size of the array.
     *
     * @return int
     */
    private function countSizeOfArray()
    {
        $array_size = count($this->random_integer_array);
        return $array_size;
    }

    /**
     * Sort the array in order of the value of each integer, from low to high.
     */
    private function sortArrayLowToHigh()
    {
        sort($this->random_integer_array);
        return;
    }

}
