<?php
/**
 * Created by PhpStorm.
 * User: komal
 * Date: 14/07/2017
 * Time: 4:53 PM
 */
require_once 'Toyrobotsimulator.php';
use PHPUnit\Framework\TestCase;

class ToyrobotsimulatorTest extends TestCase
{
    public function testMain()
    {
        $class = new Toyrobotsimulator();
        $this->assertEquals($class->readFile(), 'Output: 5, 5, west');
    }
}
