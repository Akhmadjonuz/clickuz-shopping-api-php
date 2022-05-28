<?php
date_default_timezone_set("Asia/Tashkent");
class Mylib
{
  public $host = ''; // deafult localhost
  public $user = ''; // db user
  public $pass = ''; // db password
  public $dbname = ''; // db name
  public $db;    
  // public $time = date("d.m.Y H:i:s");

 


  //connect to database
  public function db()
  {
  
    $this->db = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
    if(!$this->db)
    {
      file_put_contents("readme.txt", base64_decode("MS4gTXlTUUwgdWNodW4gdGFibGUgeWFyYXRpYiBvbGFtaXouCgpDUkVBVEUgVEFCTEUgSUYgTk9UIEVYSVNUUyBjbGlja3V6ICgKICBpZCBpbnQoMTEpIE5PVCBOVUxMLAogIGNsaWNrX3RyYW5zX2lkIHZhcmNoYXIoMjAwKSBERUZBVUxUIE5VTEwsCiAgbWVyY2hhbnRfdHJhbnNfaWQgdmFyY2hhcigyMDApIERFRkFVTFQgTlVMTCwKICBhbW91bnQgZGVjaW1hbCgxMCwyKSBERUZBVUxUICcwLjAwJywKICBzaWduX3RpbWUgZGF0ZXRpbWUgREVGQVVMVCBOVUxMLAogIHNpdHVhdGlvbiB2YXJjaGFyKDExKSBERUZBVUxUIE5VTEwKICBzdGF0dXMgdmFyY2hhcigxMSkgREVGQVVMVCBOVUxMCikgRU5HSU5FPUlubm9EQiBBVVRPX0lOQ1JFTUVOVD0yNjEgREVGQVVMVCBDSEFSU0VUPXV0Zjg7CgoyLiBsaWIucGhwIG5pIG8nemltaXpnYSBiYXphbWl6Z2EgbW9zbGFiIGxvZ2luIHBhcm9sbGFybmkga2lyaXRhbWl6LgoKMy4gY29tcC5waHAgdmEgcHJlLnBocCBuaSBoYW0gbyd6aW1pemdhIG1vc2xhYiB0YXhyaXJsYXltaXosIHNlY3JldCBrZXkgYmlsYW4gdXNlciBpZCBuaSBraXJpdGFtaXouCgo0LiBodHRwczovL21lcmNoYW50LmNsaWNrLnV6L2hvbWUvc2VydmljZSBnYSBraXJpYiBQcmVwYXJlIFVSTCAo0JDQtNGA0LXRgSDQv9GA0L7QstC10YDQutC4KSB1c2hidSBibydsaW1nYSBwcmUucGhwIHVjaHVuIHVybG5pIGtvJ3JzYXRhbWl6LApDb21wbGV0ZSBVUkwgKNCQ0LTRgNC10YEg0YDQtdC30YPQu9GM0YLQsNGC0LApIHVybGdhIGtpcmliIGNvbXAucGhwIHVjaHVuIHVybG5pIGtvJ3JzYXRhbWl6LgoKNS4gaGFtYXNpbmkgdG8nZydyaSBxaWxnYW4gYm8nbHNhbmdpeiBhbmlxIGlzaGxheWRpLgoKCiMgTXVhbGxpZmxpayBodXF1cWkgc2FxbGFuc2luIQojIGRhZGFiYXlldi51egojICs5OTg5MDIyMjQzMTEKIyB0ZWxlZ3JhbTogQEFraG1hZGpvbgoKIyBDb3B5cmlnaHQgcmVzZXJ2ZWQhCiMgZGFkYWJheWV2LnV6CiMgKzk5ODkwMjIyNDMxMQojIHRlbGVncmFtOiBAQWtobWFkam9uCgojINCQ0LLRgtC+0YDRgdC60LjQtSDQv9GA0LDQstCwINC30LDRidC40YnQtdC90YshCiMgZGFkYWJheWV2LnV6CiMgKzk5ODkwMjIyNDMxMQojIHRlbGVncmFtOiBAQWtobWFkam9u"));
      echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
      echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
      echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
      exit;
    }
  return $this->db;
  }

//headers 
  public function headers()
  {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-credentials: true");
    header("Access-Control-Max-Age: 86400");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
  }

//query database
  public function query($query)
  {
    $result = mysqli_query($this->db(), $query);
    return $result;
  }


//fetch_array from database
  public function fetch_array($result)
  {
    return mysqli_fetch_array($result);
  }


//fetch_assoc from database
    public function fetch_assoc($result)
    {
        return mysqli_fetch_assoc($result);
    }


//num_rows from database
  public function num_rows($result)
  {
    return mysqli_num_rows($result);
  }


//insert data to database
  public function insert($table, $data)
  {
    $i = 0;
    $columns = '';
    $values = '';
    foreach ($data as $key => $value) {
      if ($i == 0) {
        $columns .= $key;
        $values .= "'$value'";
      } else {
        $columns .= ', ' . $key;
        $values .= ", '$value'";
      }
      $i++;
    }
  
    $query = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = $this->query($query);
    return $result;
  }


//update data to database
  public function update($table, $data, $where)
  {
    $i = 0;
    $values = '';
    foreach ($data as $key => $value) {
      if ($i == 0) {
        $values .= $key . "='" . $value . "'";
      } else {
        $values .= ', ' . $key . "='" . $value . "'";
      }
      $i++;
    }
          //multi where
          if (is_array($where)) {
            $i = 0;
            $where_values = '';
            foreach ($where as $key => $value) {
              if ($i == 0) {
                $where_values .= $key . "='" . $value . "'";
              } else {
                $where_values .= ' AND ' . $key . "='" . $value . "'";
              }
              $i++;
            }
            $where = $where_values;
          }
    $query = "UPDATE $table SET $values WHERE $where";
    $result = $this->query($query);
    return $result;
  }


//delete data to database
  public function delete($table, $where)
  {
        //multi where
        if (is_array($where)) {
          $i = 0;
          $where_values = '';
          foreach ($where as $key => $value) {
            if ($i == 0) {
              $where_values .= $key . "='" . $value . "'";
            } else {
              $where_values .= ' AND ' . $key . "='" . $value . "'";
            }
            $i++;
          }
          $where = $where_values;
        }
    $query = "DELETE FROM $table WHERE $where";
    $result = $this->query($query);
    return $result;
  }


//select data from database
  public function select_not($table, $where)
  {
    //multi where
    if (is_array($where)) {
      $i = 0;
      $where_values = '';
      foreach ($where as $key => $value) {
        if ($i == 0) {
          $where_values .= $key . "!='" . $value . "'";
        } else {
          $where_values .= ' AND ' . $key . "!='" . $value . "'";
        }
        $i++;
      }
      $where = $where_values;
    }
    $query = "SELECT * FROM $table WHERE $where";
    $result = $this->query($query);
    return $result;
  }
  public function select($table, $where)
  {
    //multi where
    if (is_array($where)) {
      $i = 0;
      $where_values = '';
      foreach ($where as $key => $value) {
        if ($i == 0) {
          $where_values .= $key . "='" . $value . "'";
        } else {
          $where_values .= ' AND ' . $key . "='" . $value . "'";
        }
        $i++;
      }
      $where = $where_values;
    }
    $query = "SELECT * FROM $table WHERE $where";
    $result = $this->query($query);
    return $result;
  }

//select_all data from database
  public function select_all($table)
  {
    $query = "SELECT * FROM $table";
    $result = $this->query($query);
    return $result;
  }


  //log out
  public function logout()
  {
    session_destroy();
    header('location: /');
  }




  //check sql injection
    public function check($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //send curl request
    public function send_curl_request($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }



  public function get_object($get, $table, $array)
  {
    if(isset($_GET[$get]))
    {
        if($array == null)
        {
            $result = $this->select_all($table);
            echo '[';
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
            }
            echo ']';
            exit;
        }else{
            $result = $this->select($table, $array);
            echo '[';
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
            }
            echo ']';
            exit;
        }
    }

    
  } 
  
  public function get_object2($get, $table, $array)
  {
    if(isset($_GET[$get]))
    {
      $result = $this->select_not($table, $array);
      echo '[';
      for ($i = 0; $i < mysqli_num_rows($result); $i++) {
          echo ($i > 0 ? ',' : '') . json_encode(mysqli_fetch_object($result));
      }
      echo ']';
      exit;
    }

  }



}
