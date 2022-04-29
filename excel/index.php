<?php
// this function creates and returns a HTML table with excel rows and columns data
// Parameter - array with excel worksheet data
function sheetData($sheet) {
  $re = '<table>';     // starts html table

  $x = 1;
  while($x <= $sheet['numRows']) {
    $re .= "<tr>\n";
    $y = 1;
    while($y <= $sheet['numCols']) {
      $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
      $re .= " <td>$cell</td>\n";  
      $y++;
    }  
    $re .= "</tr>\n";
    $x++;
  }

  return $re .'</table>';     // ends and returns the html table
}

//error_reporting(E_ALL);
error_reporting(0);

$debugFlag		=	0;
$DB_HOST		=	'localhost'; 
$DB_USER		=	'root';
$DB_PASSWORD	=	'';
$DB_NAME		=	'future_path';
$site_url		=   "http://localhost/Future_Path/excel/";

$link = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
/*echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
die;*/

#Get aspirant_year - starts
$aspirant_year = array();
$sqlYear = "SELECT * FROM `aspirant_year`;";
$resYear = mysqli_query($link,$sqlYear);	
if($resYear && mysqli_num_rows($resYear) > 0)
{	
	while($rowYear = mysqli_fetch_assoc($resYear)){
		//echo '<pre>'; print_r($rowYear); echo '</pre>';
		$aspirant_year[$rowYear['aspirant_year_id']] = str_replace(" ","_",strtolower($rowYear['title']));
	}
}
if($debugFlag == '1'){
echo '<pre>aspirant_year '; print_r($aspirant_year); echo '</pre>';
}
#Get aspirant_year - starts

#Get entrance_exam - starts
$entrance_exam = array();
$sqlExam = "SELECT * FROM `entrance_exam`;";
$resExam = mysqli_query($link,$sqlExam);	
if($resExam && mysqli_num_rows($resExam) > 0)
{	
	while($rowExam = mysqli_fetch_assoc($resExam)){
		//echo '<pre>'; print_r($rowYear); echo '</pre>';
		$entrance_exam[] = str_replace(" ","_",strtolower($rowExam['name']));
	}
}
if($debugFlag == '1'){
echo '<pre>entrance_exam '; print_r($entrance_exam); echo '</pre>';
}
#Get entrance_exam - starts

#table name should be - starts
/*$table_names = array();
foreach($aspirant_year as $value1){
	foreach($entrance_exam as $value2){
		$table_names[] = str_replace("-","_",$value2.'_'.$value1);
	}
}
if($debugFlag == '1'){
echo '<pre>table_names '; print_r($table_names); echo '</pre>';
}*/
$table_names = array();
$table_names['mht_cet_pharma_2021'] = 'MHT-CET-PHARMA';
$table_names['jee_main_adv_2021'] = 'JEE-Main,JEE-Adv';//JoSSA // https://collegedunia.com/exams/jee-main/jossa-counselling
$table_names['mht_cet_engg_2021'] = 'MHT-CET-Engg';
$table_names['neet_2021'] = 'MHT-CET-Med';//https://view.mahacet.org/mahacet/admin/news_document/FirstLstug2021.pdf;
if($debugFlag == '1'){
echo '<pre>table_names '; print_r($table_names); echo '</pre>';
}
#table name should be

#jee_main_adv_2021 - data addition - starts
if($_POST['btn_jee_iit'] != ''){
	include 'excel_reader.php';     // include the class
	// creates an object instance of the class, and read the excel file data
	$excel = new PhpExcelReader;
	//$excel->read('test.xls');
	//$excel->read('FirstLstug2021-converted.xlsx');
	
	//echo '<pre>'; print_r($_POST); echo '</pre>';
	$file_jee = trim($_POST['file_jee_iit']);
	$sel_year = trim($_POST['sel_year']);
	
	$excel->read($file_jee);
	//echo '<pre>';var_export($excel->sheets);echo '</pre>';
	$nr_sheets = count($excel->sheets);       // gets the number of sheets
	$excel_data = '';              // to store the the html tables with data of each sheet
	$limit = 3000;
	
	// traverses the number of sheets and sets html table with each sheet data in $excel_data
	$k = 1;
	for($i=0; $i<$nr_sheets; $i++) {
	  //$excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>'; 
	  $sheet = $excel->sheets[$i];
	  $values = $sheet['cells'];
	  
	  foreach($values as $key => $data){
			//echo '<pre>'; print_r($data); echo '</pre>';			  
			#Insert in parent table
			if($data[1] != 'Institute'){
				$insert_par_sql = "INSERT INTO `jee_main_adv_2021` ( `collage`, `program`, `quota`, `caste_category`, `gender`, `open_rank`, `close_rank`, `aspirant_year`, `collage_type`) VALUES ( '".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$sel_year."','IIT');";
				//echo "<br><br>".$insert_par_sql;
				mysqli_query($link,$insert_par_sql);
			}		  
		}
	}
	//echo $excel_data;
}

if($_POST['btn_jee_nit'] != ''){
	include 'excel_reader.php';     // include the class
	// creates an object instance of the class, and read the excel file data
	$excel = new PhpExcelReader;
	//$excel->read('test.xls');
	//$excel->read('FirstLstug2021-converted.xlsx');
	
	//echo '<pre>'; print_r($_POST); echo '</pre>';
	$file_jee = trim($_POST['file_jee_nit']);
	$sel_year = trim($_POST['sel_year']);
	
	$excel->read($file_jee);
	//echo '<pre>';var_export($excel->sheets);echo '</pre>';
	$nr_sheets = count($excel->sheets);       // gets the number of sheets
	$excel_data = '';              // to store the the html tables with data of each sheet
	$limit = 3000;
	//echo '<br>CNT : '.$nr_sheets;die;
	
	// traverses the number of sheets and sets html table with each sheet data in $excel_data
	$k = 1;
	for($i=0; $i<$nr_sheets; $i++) {
	  //$excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>'; 
	  $sheet = $excel->sheets[$i];
	  $values = $sheet['cells'];
	  //echo '<pre>DATA'; print_r($values); echo '</pre>';
		foreach($values as $key => $data){
			  //echo '<pre>'; print_r($data); echo '</pre>';
			  
			  #Insert in parent table
			  if($data[1] != 'Institute'){
				  $insert_par_sql = "INSERT INTO `jee_main_adv_2021` ( `collage`, `program`, `quota`, `caste_category`, `gender`, `open_rank`, `close_rank`, `aspirant_year`, `collage_type`) VALUES ( '".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$sel_year."','NIT');";
				  //echo "<br><br>".$insert_par_sql;
				  mysqli_query($link,$insert_par_sql);
			  }	  
		  }
	}
	//echo $excel_data;
}

if($_POST['btn_jee_iiit'] != ''){
	include 'excel_reader.php';     // include the class
	// creates an object instance of the class, and read the excel file data
	$excel = new PhpExcelReader;
	//$excel->read('test.xls');
	//$excel->read('FirstLstug2021-converted.xlsx');
	
	//echo '<pre>'; print_r($_POST); echo '</pre>';die;
	$file_jee = trim($_POST['file_jee_iiit']);
	$sel_year = trim($_POST['sel_year']);
	
	$excel->read($file_jee);
	//echo '<pre>';var_export($excel->sheets);echo '</pre>';die;
	$nr_sheets = count($excel->sheets);       // gets the number of sheets
	$excel_data = '';              // to store the the html tables with data of each sheet
	$limit = 3000;
	//echo '<br>CNT : '.$nr_sheets;die;
	
	// traverses the number of sheets and sets html table with each sheet data in $excel_data
	$k = 1;
	for($i=0; $i<$nr_sheets; $i++) {
	  //$excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>'; 
	  $sheet = $excel->sheets[$i];
	  $values = $sheet['cells'];
	  //echo '<pre>DATA'; print_r($values); echo '</pre>';
		foreach($values as $key => $data){
			  //echo '<pre>'; print_r($data); echo '</pre>';
			  
			  #Insert in parent table
			  if($data[1] != 'Institute'){
				  $insert_par_sql = "INSERT INTO `jee_main_adv_2021` ( `collage`, `program`, `quota`, `caste_category`, `gender`, `open_rank`, `close_rank`, `aspirant_year`, `collage_type`) VALUES ( '".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."','".$data[5]."','".$data[6]."','".$data[7]."','".$sel_year."','IIIT');";
				  //echo "<br><br>".$insert_par_sql;
				  mysqli_query($link,$insert_par_sql);
			  }	  
		  }
	}
	//echo $excel_data;
}
#jee_main_adv_2021 - data addition - ends

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Import Data</title>
</head>

<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
  <table border="0" width="100%">
  	<tr>
      <td width="37%" valign="top">Select Aspirant Year</td>
      <td width="49%" valign="top">
      <select name="sel_year">
      <?php
	  foreach($aspirant_year as $key => $val){
		  echo '<option value="'.$key.'">'.$val.'</option>';
	  }
	  ?>
      </select>
      </td>
      <td width="14%" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="37%" valign="top">Import in jee_main_adv_YEAR table (jee_main_adv_2021) <strong>IIT JoSSA</strong></td>
      <td width="49%" valign="top"><input type="text" name="file_jee_iit" value="D:\wamp\www\Future_Path\excel\engg\2021\" style="width:100%;" />
        <!--<br />
    <pre>
    [1] => Array
        (
            [1] => Institute
            [2] => Academic Program Name
            [3] => Quota
            [4] => Seat Type
            [5] => Gender
            [6] => Opening Rank
            [7] => Closing Rank
        )

    [2] => Array
        (
            [1] => Indian Institute of Technology Bhubaneswar
            [2] => Civil Engineering (4 Years, Bachelor of Technology)
            [3] => AI
            [4] => OPEN
            [5] => Gender-Neutral
            [6] => 8471
            [7] => 12396
        )
        </pre>--></td>
      <td width="14%" valign="top"><input type="submit" name="btn_jee_iit" value="Import Jee IIT" /></td>
    </tr>
    <tr>
      <td width="37%" valign="top">Import in jee_main_adv_YEAR table (jee_main_adv_2021) <strong>NIT JoSSA</strong></td>
      <td width="49%" valign="top"><input type="text" name="file_jee_nit" value="D:\wamp\www\Future_Path\excel\engg\2021\" style="width:100%;" /></td>
      <td width="14%" valign="top"><input type="submit" name="btn_jee_nit" value="Import Jee NIT" /></td>
    </tr>
    <tr>
      <td width="37%" valign="top">Import in jee_main_adv_YEAR table (jee_main_adv_2021) <strong>IIIT JoSSA</strong></td>
      <td width="49%" valign="top"><input type="text" name="file_jee_iiit" value="D:\wamp\www\Future_Path\excel\engg\2021\" style="width:100%;" /></td>
      <td width="14%" valign="top"><input type="submit" name="btn_jee_iiit" value="Import Jee IIIT" /></td>
    </tr>
  </table>
</form>
</body>
</html>