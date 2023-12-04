<?php

namespace Khill\FontAwesome\Tests;

use Khill\FontAwesome\FontAwesome;

class FontAwesomeStackTest extends FontAwesomeTestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreatingStackWithInvalidTopIcon()
    {
        echo $this->fa->stack(3.141592654);
    }

    public function testBasicStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic');
    }

    public function testLargeStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-lg"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->lg();
    }

    public function test2xStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-2x"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->x2();
    }

    public function test3xStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-3x"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->x3();
    }

    public function test4xStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-4x"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->x4();
    }

    public function test5xStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-5x"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->x5();
    }

    public function testRotatingStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fa-rotate-90"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->rotate90();
    }

    public function testAddingClassesToTopIconInStackOutput()
    {
        $this->expectOutputString('<span class="fa-stack"><i class="fas fa-ban fa-stack-2x fa-rotate-90"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban', array('rotate90'))->on('magic');
    }

    public function testAddingClassesToBottomIconInStackOutput()
    {
        $this->expectOutputString('<span class="fa-stack"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x fa-rotate-90"></i></span>');

        echo $this->fa->stack('ban')->on('magic', array('rotate90'));
    }

    public function testMultipleStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span><span class="fa-stack"><i class="fas fa-twitter fa-stack-2x"></i><i class="fas fa-circle-o fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic');
        echo $this->fa->stack('twitter')->on('circle-o');
    }

    public function testExtraClassStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fancyClass"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->addClass('fancyClass');
    }

    public function testExtraClassesFromArrayStackedIconsOutput()
    {
        $this->expectOutputString('<span class="fa-stack fancyClass1 fancyClass2"><i class="fas fa-ban fa-stack-2x"></i><i class="fas fa-magic fa-stack-1x"></i></span>');

        echo $this->fa->stack('ban')->on('magic')->addClasses(array('fancyClass1', 'fancyClass2'));
    }
}
