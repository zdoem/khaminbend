<?php
defined('ROOT') or exit('No access allowed');
$headerhtml='<style>
    @page {
    header: html_myHeader; 
    } 
    #header {
        position:absolute ; top:5mm;left:0mm;right:15mm;width: 100%; 
    }
    #pagenumber{
        font-size:10pt;
        position: absolute; top:15mm; left: 0mm;font-style: italic; background-color:#4274B0;color: #FFF;text-align: right;padding:1px 10px 1px 30px;
    }   
</style> 
<htmlpageheader name="myHeader">  
    <div id="header"> 
        <table width="100%">
        <tr>
            <td width="25%"> </td>
            <td width="50%" align="center" style="font-weight: bold;"> 
                <table style="width:100%" align="center" border="0" cellpadding="0" cellspacing="0"> 
                    <tr align="center">
                        <td> <img src="../images/apple-icon-57x57.png" style="width:16mm;" /></td> 
                    </tr> 
                    <tr align="center"> 
                        <td style="height:40px;"><b id="title_home">ข้อมูลครัวเรือน<b/></td> 
                    </tr>
                </table> 
            </td>
            <td width="25%" style="text-align: right;padding:0 15mm 0 0 ">Print : '.thaidate('j/m/Y', time()).'</td>
        </tr>
    </table>
    </div> 
<div id="pagenumber"> {PAGENO} / {nbpg}</div> 

</htmlpageheader>

<htmlpagefooter name="myFooter">
    <div id="footer">
        Page {PAGENO} / {nbpg}
    </div>
</htmlpagefooter>';
?>
