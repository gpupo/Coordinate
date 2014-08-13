<?php
/**
 * Unit tests covering Coordinate conversion methods
 *
 * @author Gilmar Pupo <g@g1mr.com>
 */
namespace Gpupo\Tests\Coordinate;

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

    /**
     * @dataProvider dataProviderDMS
     */
    public function testDecimalConvertionWithCustomDecimalSeparator($dms, $lat, $lng)
    {
        $conversion = new Conversion;
        $conversion->setDecimalSeparator('.');
        $dec = $conversion->dmsToDec($dms);
        $this->assertEquals(str_replace(',', '.', $lat), $dec['lat']);
        $this->assertEquals(str_replace(',', '.', $lng), $dec['lng']);

    }

    public function dataProviderDMS()
    {
        return array(
            array('42°19\'58"N 87°50\'01"W', '42,332778', '-87,833611'),
            array('42°19\'58"S 87°50\'01"E', '-42,332778', '87,833611'),
            array('42°19\'58"S 87°50\'01"W', '-42,332778', '-87,833611'),
            array('30°01\'58"N 27°05\'01"W', '30,032778', '-27,083611'),
            array('30 01 58 N 27 05 01 W', '30,032778', '-27,083611'),
            array('25°10’37.21”S 48°52’39.47”W', '-25,177003', '-48,877631'),
        );
    }
}
