function Tabela(tbl, pagination, brSlogova, cliktabela) {
  pretraga = "";
  kolona = "";
  if (cliktabela!=1){//ako nije kliknuta tabele sa leve strane
    if (document.getElementById("Pretraga") != null){
      pretraga = document.getElementById("Pretraga").value;
      kolona = document.getElementById("cmbMake").value;
    }
  }
  var bAjax=true;
  if(pagination<0){
    pagination=0;
    bAjax=false;
  }else if (pagination>brSlogova){
    pagination=brSlogova-1;
    bAjax=false;
  }else if (pagination<brSlogova){
    bAjax=true;
  }else if (pagination=brSlogova){
    bAjax=false;
  }
  if (bAjax==true){ //aktiviraj ajax
    $.ajax({
      type: 'POST',
      url: 'table.php',
      data: { tablename: tbl,
          page: pagination,
          search: pretraga,
          column: kolona},
      success: function(response) {
        $('#mojdivtabela').html(response);//ako je sve ok upisi u div
      }
    });
  }
}

function PonistiPretragu() {
  if (document.getElementById("Pretraga") !=null){
    document.getElementById("Pretraga").value="";
  }
}
