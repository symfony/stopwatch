<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Stopwatch\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Stopwatch\StopwatchPeriod;

class StopwatchPeriodTest extends TestCase
{
    /**
     * @dataProvider provideTimeValues
     */
    public function testGetStartTime($start, $useMorePrecision, $expected)
    {
        $period = new StopwatchPeriod($start, $start, $useMorePrecision);
        $this->assertSame($expected, $period->getStartTime());
    }

    /**
     * @dataProvider provideTimeValues
     */
    public function testGetEndTime($end, $useMorePrecision, $expected)
    {
        $period = new StopwatchPeriod($end, $end, $useMorePrecision);
        $this->assertSame($expected, $period->getEndTime());
    }

    /**
     * @dataProvider provideDurationValues
     */
    public function testGetDuration($start, $end, $useMorePrecision, $duration)
    {
        $period = new StopwatchPeriod($start, $end, $useMorePrecision);
        $this->assertSame($duration, $period->getDuration());
    }

    /**
     * @dataProvider provideFormattedDurationValues
     */
    public function testGetFormattedDuration($start, $end, $useMorePrecision, $duration)
    {
        $period = new StopwatchPeriod($start, $end, $useMorePrecision);
        $this->assertSame($duration, $period->getFormattedDuration());
    }

    public function provideTimeValues()
    {
        yield [0, false, 0];
        yield [0, true, 0.0];
        yield [0.0, false, 0];
        yield [0.0, true, 0.0];
        yield [2.71, false, 2];
        yield [2.71, true, 2.71];
    }

    public function provideDurationValues()
    {
        yield [0, 0, false, 0];
        yield [0, 0, true, 0.0];
        yield [0.0, 0.0, false, 0];
        yield [0.0, 0.0, true, 0.0];
        yield [2, 3.14, false, 1];
        yield [2, 3.14, true, 1.14];
        yield [2.71, 3.14, false, 1];
        yield [2.71, 3.14, true, 0.43];
    }

    public function provideFormattedDurationValues()
    {
        yield [1035, 123852, false, '34h 6m 57s'];
        yield [100, 3852, false, '1h 2m 32s'];
        yield [102, 878, false, '12m 56s'];
        yield [17, 75, false, '58s'];
        yield [5, 7, false, '2s'];
    }
}
