<?php
/* Google code jam 2012
 * this solves problem B q1
 * ethan laur <phyrrus9@gmail.com>
 */
$C = new CodeJam();
$C->run();

class CodeJam
{
  private $_filename = "in.in";
  private $_data;
  private $_cases;
  private $_file_out_handle;

  public function algorithm2($data, $case)
  {
    $data = trim($data[0]);
    $data = explode(' ', $data);

    $people = (int)$data[0];
    $surprise = (int)$data[1];
    $min_score = (int)$data[2];

    unset($data[0], $data[1], $data[2]);
    //sort($data);
   
    $scores = $data;
    $cases = 0;
    
    foreach ($scores as $score)
    {
      echo 'find 3 judges score for score: ' . $score . "\n";

      $base = (int)($score / 3);
      $result = array();

      switch ($score % 3)
      {
        case 0:
        {
          $result = array(
            array($base, $base, $base),
            array($base - 1, $base, $base + 1)
          );

          // regular case:
          if ($base >= $min_score)
          {
              $result['case'] = true;
              $cases++;
          }
          else
          {
            // check for surprise case:
            if ($surprise > 0 and $base > 0 and $base + 1 >= $min_score)
            {            
              $cases++;
              $surprise--;
              $result['case'] = true;
            }            
          }         

          $result['surprise'] = $surprise;
          break;
        }

        case 1:
        {
          $result = array(
            array($base, $base, $base+1),
            array($base-1, $base+1, $base+1),
          );

          // regular case:
          if ($base >= $min_score or $base + 1 >= $min_score)
          {
              $cases++;
              $result['case'] = true;
          }
          else
          {
            // surprise case:
            if ($surprise > 0 and $base + 1 >= $min_score)
            {
              $result['case'] = true;
              $cases++;
              $surprise--;
            }
          }

          $result['surprise'] = $surprise;
          break;
        }

        case 2:
        {          
          $result = array(
            array($base, $base, $base + 2),
            array($base, $base + 1, $base + 1)
          );

          // regular case:
          if ($base + 1 >= $min_score or $base >= $min_score)
          {
            $result['case'] = true;
            $cases++;
          }
          else
          {
            if ($surprise > 0 and $base + 2 >= $min_score)
            {
              $result['case'] = true;
              $cases++;
              $surprise--;
            }
          }

          $result['surprise'] = $surprise;
          break;
        }
      }
      print_r($result);
    }

    //echo 'surprises: ' . $surprise . "\n";
    //echo 'cases: ' . $cases; exit;

    return $cases;
  }

  public function algorithm1($data, $case)
  {
    //  'a' -> 'y', 'o' -> 'e', and 'z' -> 'q'.
    // q, z

    $string = 'ejp mysljylc kd kxveddknmc re jsicpdrysi rbcpc ypc rtcsra dkh wyfrepkym veddknkmkrkcd de kr kd eoya kw aej tysr re ujdr lkgc jv y e q z';
    $string = str_split($string);

    $answer = 'our language is impossible to understand there are twenty six factorial possibilities so it is okay if you want to just give up a o z q';
    $answer = str_split($answer);

    $maps = array();

    foreach ($string as $key => $val)
    {
      $maps[$val] = $answer[$key];
    }

    ksort($maps);
//print_r($maps);exit;


    $string = trim($data[0]);
    
    //echo 'processing case # ' . $case . "\n";
    //echo 'items is: ' . $string . "\n";
    //echo 'result is: ';
    $result = null;

    $strings = str_split($string);

    foreach ($strings as $string)
    {
      $result .= $maps[$string]; // isset($maps[$string]) ? $maps[$string]:' ';
    }

    //echo $result;exit;
    return $result;
   
  }

  public function __construct()
  {
    $this->_filename = $_SERVER['argv'][1];
  }

  public function run()
  {
    // remove output file:
    $this->removeFile($this->_filename . '.out');    

    $data = $this->readFile();

    // call algorithm here:
    //$data = $this->algorithm1($data);

    // write to file:
    //$this->writeFile($data);

    // close output file:
    $this->closeFile();
  }
  
  public function readFile()
  {
    $file_handle = fopen("in.in", 'r');

    $case = 1;
    $data = array();
    do
    {
      if (!$this->_cases)
      {
        $this->_cases = fgets($file_handle);
      }
      else
      {
        $current_case = array(fgets($file_handle));

        $indexes = $this->algorithm2($current_case, $case);

        $this->writeFile($indexes, $case);
        $case++;
      }
    }
    while (!feof($file_handle) and $case <= $this->_cases);

    $content = file_get_contents("in.in");
    
    return $content;
  }

  public function writeFile($data, $case)
  {
    $out = "Case #$case: $data\n";
    echo $out;

    $this->_file_out_handle = fopen("in.long", 'a');
    fwrite($this->_file_out_handle, $out);
  }

  public function closeFile()
  {
    fclose($this->_file_out_handle);
  }

  public function removeFile($file)
  {
    if (file_exists($file))
    {
      unlink($file);
    }
  }

}
