  <?php
 include "../../config/koneksi.php";
  include "../../lib/input.php";
 $filter = $_GET['kd'];
  $noz= $_GET['nox'];
  // $supp= $_GET['supp'];
  // echo $supp;

 $sup= mysql_query("SELECT * FROM barang WHERE id_barang = '$filter' ");
  $data = mysql_fetch_array($sup)
   ?>
  <tr class="inputtable">
  <input type=hidden name="id_npj_barang[]" value="<?php echo $data['id_barang']?>"  id="id_po_barang-<?php echo $noz; ?>" >
    <input type="hidden" name="id_akunkasperkiraan[]" value="<?php echo $data['id_akunkasperkiraan'] ?>" id="id_akunkasperkiraan-<?php echo $noz; ?>" >
    <input type=hidden name="id[]" value="" id="id-<?php echo $noz; ?>" >
     <input type=hidden value="<?php echo $data['hpp']?>" name="hpp[]" value="" id="hpp-<?php echo $noz; ?>" >
   <td>
       <input type="text"  class="namabarang"  name="kode_barang[]" value="<?php echo $data['kode_barang']?>"   id="kode_barang-<?php echo $noz; ?>"  disabled />
    </td>
	<td>
   <input style="width:200px;" type="text" name="nama_barang[]" value="<?php echo $data['nama_barang']?>" id="nama_barang-<?php echo $noz; ?>"  disabled /> </td>
  <?php
      echo '<td><select id="gudang_lkb-'.$noz.'" name="gudang_lkb[]" class=" form-control" required>';
      $tampil_lbr=mysql_query("SELECT * FROM gudang where is_void=0 ");
               while($w=mysql_fetch_array($tampil_lbr)){
                    echo "<option value=$w[id_gudang]>$w[nama_gudang]</option>";
                }
      echo '</select></td>';
      ?>  
      <td>
      <select  class="form-control hitung form-control " id="jenis_satuan-<?php echo $noz; ?>" name="jenis_satuan[]">
      <?php
      for ($i=1; $i <= 5 ; $i++) { 
        $val= "satuan".$i;
        $val_kali= "kali".$i;
        $val_harga= "harga_sat".$i;
        if ($data[$val]!=""){
          echo $data[$val];
          if ($i==1){
             echo " <option value='".$data[$val_harga].'-'.$data[$val].'-'.$data[$val_kali]."' selected>".$data[$val].' ('.$data[$val_kali].')'."</option>";
          }
          else
             echo " <option value='".$data[$val_harga].'-'.$data[$val].'-'.$data[$val_kali]."' >".$data[$val].' ('.$data[$val_kali].')'."</option>";
        
        }
      }
      ?>
    
      </select>
    </td>

    <td>
      <input type="text" name="harga_sat1[]" value="<?php echo $data['hpp']?>"  id="harga-<?php echo $noz; ?>"  class="hitung form-control  numberhit">
    </td>

   <td><input type="text" name="jumlah[]" id="satuan-<?php echo $noz; ?>"  class="hitung form-control numberhit" /></td>
            <!-- <td><input type="text" name="disc1[]"  id="disc1_barang-<?php //echo $noz; ?>"  class="hitung form-control  numberhit" /></td>
            <td><input type="text" name="disc2[]" id="disc2_barang-<?php //echo $noz; ?>"  class="hitung form-control numberhit " /></td>
            <td><input type="text" name="disc3[]" id="disc3_barang-<?php //echo $noz; ?>" class="hitung form-control  numberhit" /></td>
            <td><input type="text" name="disc4[]" id="disc4_barang-<?php //echo $noz; ?>" class="hitung form-control  numberhit"  /></td>
            <td><input type="text" name="disc5[]" id="disc5_barang-<?php //echo $noz; ?>" class="hitung form-control  numberhit"  /></td> -->
            <td><input tabindex="-1" type="text" name="total[]" id="total-<?php echo $noz; ?>"  class="total form-control numberhit" readonly="readonly" /></td>
    
    
  <td>
    <button tabindex="0" class="btn btn-primary" type="button" id="search" data-toggle="modal" data-target="#search-md"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button> 
  <div  class="btn btn-danger" name="del_item" onclick="deleteRow(this)"><span class='glyphicon glyphicon-trash'></span></div>
  </td>
</tr>
<script type='text/javascript'>
  $(function () {
    var showPopover = function () {
        $(this).popover('show');
    }
    , hidePopover = function () {
        $(this).popover('hide');
    };   
function num1(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ', ');
}
       $('.numberhit').popover({
        content:  function () {
           return num1($(this).val());
        },
        placement: 'top',
        trigger: 'manual'
    })
    .keyup(showPopover)
    .blur(hidePopover)
    .hover(showPopover,hidePopover);

});
</script>
