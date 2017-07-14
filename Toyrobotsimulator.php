<?php

/**
 * Created by PhpStorm.
 * User: komal
 * Date: 14/07/2017
 * Time: 3:18 PM
 */
class Toyrobotsimulator
{
    /**
     *Read file from /file/input.txt
     */
    public function readFile()
    {
        $x = 0;
        $y = 0;
        $position = 'north';
        $inputfile = fopen("file/input.txt", "r") or die("Unable to open file!");
        while (!feof($inputfile)) {
            $tmp_file_line = strtolower(fgets($inputfile));
            $file_line = str_replace(' ', '', $tmp_file_line);
            if (stripos($file_line, 'place') !== false) {
                $tmp_string = explode(',', $file_line);
                $tmp = preg_replace('/[^A-Za-z0-9\-]/', '', $tmp_string[0]);
                $x = str_replace('place', '', $tmp);
                $y = str_replace(' ', '', $tmp_string[1]);
                $position = $tmp_string[2];
            } else if (stripos($file_line, 'move') !== false) {
                $return_action = $this->action('move', $position, $x, $y);
                $position = $return_action[0];
                $x = $return_action[1];
                $y = $return_action[2];
            } else if (stripos($file_line, 'report') !== false) {
                $return_action = $this->action('report', $position, $x, $y);
                echo $return_action;
                return $return_action;
            } else if (stripos($file_line, 'left') !== false) {
                $return_action = $this->action('left', $position, $x, $y);
                $position = $return_action[0];
                $x = $return_action[1];
                $y = $return_action[2];
            } else if (stripos($file_line, 'right') !== false) {
                $return_action = $this->action('right', $position, $x, $y);
                $position = $return_action[0];
                $x = $return_action[1];
                $y = $return_action[2];
            }
        }
        fclose($inputfile);
    }

    /**
     * Commands for the toy robot simulator
     * @param string $key
     * @param string $position
     * @param int $x
     * @param int $y
     * @return array|string
     */
    public function action($key, $position = 'north', $x = 0, $y = 0)
    {
        $position = trim($position);
        $key = trim($key);

        if ($key == 'move') {
            $position = preg_replace('/[^A-Za-z0-9\-]/', '', $position);
            switch ($position) {
                case 'north':
                    if ($y <= 5 || $y >= 0)
                        $y++;
                    break;
                case 'south':
                    if ($y <= 5 || $y >= 0)
                        $y--;
                    break;
                case 'west':
                    if ($x <= 5 || $x >= 0)
                        $x--;
                    break;
                case 'east':
                    if ($x >= 0 && $x <= 5)
                        $x++;
                    break;
            }
        }

        if ($key == 'report') {
            return 'Output: ' . $x . ', ' . $y . ', ' . $position;
        }

        if ($key == 'left') {
            $position = preg_replace('/[^A-Za-z0-9\-]/', '', $position);
            switch ($position) {
                case 'north':
                    $position = 'west';
                    break;
                case 'south':
                    $position = 'east';
                    break;
                case 'west':
                    $position = 'south';
                    break;
                case 'east':
                    $position = 'north';
                    break;
            }
        }

        if ($key === 'right') {
            $position = preg_replace('/[^A-Za-z0-9\-]/', '', $position);
            switch ($position) {
                case 'north':
                    $position = 'east';
                    break;
                case 'south':
                    $position = 'west';
                    break;
                case 'west':
                    $position = 'north';
                    break;
                case 'east':
                    $position = 'south';
                    break;
            }
        }

        return ([$position, $x, $y]);
    }

}