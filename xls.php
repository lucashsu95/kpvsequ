<?php
require("conn.inc.php");

//mysqli_query("SET NAMES 'utf8'");


#$Ldate = $_REQUEST['Idate'];
#if ($Ldate == '') $Ldate = '2015/02/01';

#$Ledate = date("Y/m/d",strtotime($Ldate . " +7days"));

#and cdate > '" . $Ldate . "' and cdate < '" . $Ledate . "' and hour(cdate) > 6 and hour(cdate) < 19 and (x1 is not null or x2 is not null  or x3 is not null ) ";
$key = $_POST['key'];
$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];
$Lsql = "select * from $key";
$Lsql .= " where repair_date between $dateStart and $dateEnd";
$Lsql .= " order by id desc";

#echo $Lsql;
#exit();

/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2010 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2010 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.2, 2010-01-11
 */

/** Error reporting */
#error_reporting(E_ALL);

/** PHPExcel */
#require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
require  'Classes/PHPExcel.php';

/** PHPExcel_RichText */
#require_once dirname(__FILE__) . '/Classes/PHPExcel/RichText.php';
require 'Classes/PHPExcel/RichText.php';

// Create new PHPExcel object
#echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
#echo date('H:i:s') . " Set properties\n";

#echo $Lsql;
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

// Create a first sheet, representing sales data
#echo date('H:i:s') . " Add some data\n";
$objPHPExcel->setActiveSheetIndex(0);


$Lresult = mysqli_query($GLOBALS['conn'],$Lsql) or die('DB Error!');
$Lrs_total_num = mysqli_num_rows($Lresult);
if ($Lrs_total_num > 0) {

	$Lcount=1;
	$Lorder_id = 0;
	$objPHPExcel->getActiveSheet()->setCellValue("A".$Lcount , '筆數');
	$objPHPExcel->getActiveSheet()->setCellValue("B".$Lcount , '報修類別');
	$objPHPExcel->getActiveSheet()->setCellValue("C".$Lcount , '填報人');
	$objPHPExcel->getActiveSheet()->setCellValue("D".$Lcount , '教室編號');
	$objPHPExcel->getActiveSheet()->setCellValue("E".$Lcount , '處理進度');
	$objPHPExcel->getActiveSheet()->setCellValue("F".$Lcount , '填報時間');
	$objPHPExcel->getActiveSheet()->setCellValue("G".$Lcount , '狀況概述');
	$objPHPExcel->getActiveSheet()->setCellValue("H".$Lcount , '處理概述');
	$objPHPExcel->getActiveSheet()->setCellValue("I".$Lcount , '處理時間');
	$Lcount ++;
	while ($Lrs = mysqli_fetch_array($Lresult)) {
		$objPHPExcel->getActiveSheet()->setCellValue("A".$Lcount , $Lrs['id']);
		$objPHPExcel->getActiveSheet()->setCellValue("B".$Lcount , $Lrs['class']);
		$objPHPExcel->getActiveSheet()->setCellValue("G".$Lcount ,$Lrs['stiuation'] );
		$objPHPExcel->getActiveSheet()->setCellValue("E".$Lcount ,$Lrs['processing'] );
		$objPHPExcel->getActiveSheet()->setCellValue("H".$Lcount ,$Lrs['process_content'] );
		$objPHPExcel->getActiveSheet()->setCellValue("I".$Lcount ,$Lrs['process_time'] );
		
		if($key === 'repair'){
			$objPHPExcel->getActiveSheet()->setCellValue("C".$Lcount , $Lrs['repair_name'] );
			$objPHPExcel->getActiveSheet()->setCellValue("D".$Lcount ,$Lrs['repair_place'] );
			$objPHPExcel->getActiveSheet()->setCellValue("F".$Lcount ,$Lrs['repair_date'] );
		}else{
			$objPHPExcel->getActiveSheet()->setCellValue("C".$Lcount , $Lrs['genrepair_name'] );
			$objPHPExcel->getActiveSheet()->setCellValue("D".$Lcount ,$Lrs['genrepair_place'] );
			$objPHPExcel->getActiveSheet()->setCellValue("F".$Lcount ,$Lrs['genrepair_date'] );

		}	
	$Lcount++;
}
} else {
	$objPHPExcel->getActiveSheet()->setCellValue("A1" , 'No Data');
}
mysqli_free_result($Lresult);

#exit();


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

/** PHPExcel_IOFactory */
require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';

#echo date('H:i:s') . " Write to Excel5 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
/**/
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . date("YmdHis") . '.xls"');
header('Cache-Control: max-age=0');
$objWriter->save('php://output');

?>
