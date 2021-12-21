<?php
require_once "koneksi.php";


class Makanan 
{
 
   public  function get_foods()
   {
      global $mysqli;
      $query="SELECT * FROM tbl_makanan";
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Data berhasil diambil',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }
 
   public function get_food($id=0)
   {
      global $mysqli;
      $query="SELECT * FROM tbl_makanan";
      if($id != 0)
      {
         $query.=" WHERE id=".$id." LIMIT 1";
      }
      $data=array();
      $result=$mysqli->query($query);
      while($row=mysqli_fetch_object($result))
      {
         $data[]=$row;
      }
      $response=array(
                     'status' => 1,
                     'message' =>'Data berhasil diambil',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
        
   }
 
   public function insert_food()
      {
         global $mysqli;
         $arrcheckpost = array('nama_makanan' => '', 'asal_daerah' => '', 'deskripsi' => '', 'url_gambar' => '');
         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
               $result = mysqli_query($mysqli, "INSERT INTO tbl_makanan SET
               nama_makanan = '$_POST[nama_makanan]',
               asal_daerah = '$_POST[asal_daerah]',
               deskripsi = '$_POST[deskripsi]',
               url_gambar = '$_POST[url_gambar]'");
                
               if($result)
               {
                  $response=array(
                     'status' => 1,
                     'message' =>'Makanan berhasil ditambah'
                  );
               }
               else
               {
                  $response=array(
                     'status' => 0,
                     'message' =>'Gagal menambah data'
                  );
               }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function update_food($id)
      {
         global $mysqli;
         $arrcheckpost = array('nama_makanan' => '', 'asal_daerah' => '', 'deskripsi' => '', 'url_gambar' => '');
         $hitung = count(array_intersect_key($_POST, $arrcheckpost));
         if($hitung == count($arrcheckpost)){
          
              $result = mysqli_query($mysqli, "UPDATE tbl_makanan SET
              nama_makanan = '$_POST[nama_makanan]',
              asal_daerah = '$_POST[asal_daerah]',
              deskripsi = '$_POST[deskripsi]',
              url_gambar = '$_POST[url_gambar]' WHERE id='$id'");
          
            if($result)
            {
               $response=array(
                  'status' => 1,
                  'message' =>'Makanan berhasil diupdate'
               );
            }
            else
            {
               $response=array(
                  'status' => 0,
                  'message' =>'Gagal update data'
               );
            }
         }else{
            $response=array(
                     'status' => 0,
                     'message' =>'Parameter Do Not Match'
                  );
         }
         header('Content-Type: application/json');
         echo json_encode($response);
      }
 
   function delete_food($id)
   {
      global $mysqli;
      $query="DELETE FROM tbl_makanan WHERE id=".$id;
      if(mysqli_query($mysqli, $query))
      {
         $response=array(
            'status' => 1,
            'message' =>'Makanan berhasil dihapus'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Gagal menghapus makanan'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }
}
 
 ?>