<?php

namespace Gpupo\Coordinate;

class Conversion {

    protected $log = array();

    protected function logger($line)
    {
        if (is_array($line)) {
            $line = var_export($line, true);
        }

        $this->log[]= $line;
    }

    public function getLog()
    {
        return implode("\n", $this->log);
    }


    protected $rules = array(
        'positives' => array('E', 'N'),
        'negatives' => array('W', 'S'),
    );

    protected $dms = array();

    public function getDMS()
    {
        return $this->dms;
    }

    public function dmsToDec($dms)
    {
        $this->setDMS($dms);

        return $this->getDec();
    }

    public function getDEC()
    {
        return array(
            'lat' => $this->toDEC(
                $this->dms[0],
                $this->dms[1],
                $this->dms[2],
                $this->dms[3]
            ),
            'lng' => $this->toDEC(
                $this->dms[4],
                $this->dms[5],
                $this->dms[6],
                $this->dms[7]
            ),
        );
    }

    protected function getDirectionSignal($direction)
    {
        if (
            in_array(
                $direction,
                $this->rules['negatives']
            )
        ) {
            return -1;
        }

        return 1;
    }

    /**
     * Given a DMS (Degrees, Minutes, Seconds) coordinate such as W87°43′41″,
     * it's trivial to convert it to a number of decimal degrees
     * using the following method:
     *
     * Calculate the total number of seconds:
     * 43′41″ = (43*60 + 41) = 2621 seconds.
     * The fractional part is total number of seconds divided by 3600:
     * 2621 / 3600 = ~0.728056
     * Add fractional degrees to whole degrees to produce the final result:
     * 87 + 0.728056 = 87.728056
     * Since it is a West longitude coordinate, negate the result.
     * The final result is -87.728056.
     * to decimal format longitude / latitude
     */
    protected function toDEC($d, $m, $s, $direction)
    {
        $c = $d+((($s/60)+$m)/60);

        return number_format(
            $c * $this->getDirectionSignal($direction),
            6,
            ',',
            ''
        );
    }

    public function setDMS($string)
    {

        $string = preg_replace('/\x{00B0}/u',' ', $string);

        $string = str_replace(
            array('S', 'N', 'E', 'W'),
            array(' S', ' N', ' E', ' W'),
            strtoupper($string)
        );

        $this->dms = explode(
            ' ',
            str_replace(
                '  ',
                ' ',
                str_replace(
                    array('\'','"',chr(176)),
                    array(' '),
                    trim($string)
                )
            )
        );
        $this->logger('## DMS data');
        $this->logger($this->dms);
    }

}
