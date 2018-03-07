<?php 

namespace CAP\Explode;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Explode {

    public $return_data;

    protected $string;
    protected $separator;
    protected $loop;
    protected $skip;


    public function __construct()
    {
        $template = ee()->TMPL;
        $this->string = $template->fetch_param('string');
        $this->separator = $template->fetch_param('separator');
        $this->loop = $template->fetch_param('loop', 'yes') == 'yes';
        $this->skip = $template->fetch_param('skip', '0');

        $rows = $this->loop ? $this->loopRows() : $this->rows();
        $this->return_data = $template->parse_variables($template->tagdata, $rows);
    }

    protected function rows()
    {
        $rows = [];
        $items = explode($this->separator, $this->string);
        $count = 0;

        $rows = [['exp_total_count' => count($items)]];
        foreach($items as $item)
        {
            $count++;
            $rows[0]['exp_value_'.$count] = $item;
        }

        return $rows;    	
    }

    protected function loopRows()
    {
        $rows = [];
        $items = explode($this->separator, $this->string);
        $count = 0;
        $skip = $this->skip;

        foreach($items as $item)
        {
            $count++;
            if ($skip == 0 && $this->skip != 0) {
                $skip = $this->skip;
                continue;
            }

            $item_next = isset($items[$count]) ? $items[$count] : '';
            $rows[] = [
                'exp_value' => $item,
                'exp_next' => $item_next,
                'exp_count' => $count,
                'exp_total_count' => count($items)
            ];

            if ($skip > 0) $skip--;
        }

        return $rows;
    }

    public static function usage()
    {
        return "Same API as http://dvt.ee/xplod";
    }
}

/* End of file pi.explode.php */
/* Location: ./system/user/addons/explode/pi.explode.php */