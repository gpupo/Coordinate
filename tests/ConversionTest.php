<?php
namespace Gpupo\Coordinate\Tests;

use Gpupo\Coordinate\Conversion;

class ConversionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider dataProviderDMS
     */
    public function testDivisionPosition($DMS, $lat, $lng)
    {
        $conversion = new Conversion;
        $conversion->setDMS($DMS);
        $this->assertEquals(8,
            count($conversion->getDMS())
        );

   }

    /**
     * @dataProvider dataProviderDMS
     */
    public function testDecimalConvertion($dms, $lat, $lng)
    {
        $conversion = new Conversion;
        $dec = $conversion->dmsToDec($dms);
        $this->assertEquals($lat,$dec['lat']);
        $this->assertEquals($lng, $dec['lng']);

    }


    public function dataProviderDMS()
    {
        return array(
            array('42°19\'58"N 87°50\'01"W', '42,332778', '-87,833611'),
            array('42°19\'58"S 87°50\'01"E', '-42,332778', '87,833611'),
            array('42°19\'58"S 87°50\'01"W', '-42,332778', '-87,833611'),
            array('30°01\'58"N 27°05\'01"W', '30,032778', '-27,083611'),
            array('30 01 58 N 27 05 01 W', '30,032778', '-27,083611'),
        );
    }
}