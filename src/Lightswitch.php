<?php

namespace Shortdark;

class Lightswitch implements LightswitchInterface
{

    private $random_integer_array=[];

    /**
     * Press the lightswitch, i.e. generate the array of integers.
     * Allow the array to have two min/max rules.
     *
     * @param int $lowestinteger
     * @param int $highestinteger
     * @param int $volumeofintegers
     * @param int $lowestinteger2
     * @param int $highestinteger2
     * @param int $volumeofintegers2
     * @return array
     */
    public function press($lowestinteger=0, $highestinteger=0, $volumeofintegers=0, $lowestinteger2=0, $highestinteger2=0, $volumeofintegers2=0)
    {
        // Populate the first array only and sort it from high to low
        self::populateAndRemoveDuplicates($lowestinteger, $highestinteger, $volumeofintegers);
        self::sortArrayLowToHigh();

        if( $highestinteger2 > 0 && $volumeofintegers2 > 0 ){
            // Add the second volume to the first to find the new total volume
            $totalvolumeofintegers = $volumeofintegers + $volumeofintegers2;

            // Use the second min/max values and add them onto the array
            self::populateAndRemoveDuplicates($lowestinteger2, $highestinteger2, $totalvolumeofintegers);

            self::removeGapsFromArrayIndexes();

            // We can't sort the array now because it would mix up the two sets of numbers
            // Find a way of sorting just these new additions.
            // Try separating the array into two parts, sorting the second part then re-joining the arrays together.
        }

        return $this->random_integer_array;
    }

    /**
     * If there were duplicates removed from the second lot of integers there will be gap(s) in the indexes of the array.
     * Remove the gaps by using the PHP array_values function.
     */
    private function removeGapsFromArrayIndexes()
    {
        $this->random_integer_array = array_values($this->random_integer_array);
        return;
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
     * Populate the array with random integers.
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
     */
    private function removeDuplicateValues()
    {
        if( !empty($this->random_integer_array) ){
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

        self::removeDuplicateValues();

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
