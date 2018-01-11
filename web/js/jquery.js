$(document).ready(function() {
   $("#fileUpload").on('change', function() {
      //Get count of selected files
      var countFiles = $(this)[0].files.length;
      var imgPath = $(this)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
      var image_holder = $("#image-holder");
      image_holder.empty();
      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg"){
         if (typeof(FileReader) != "undefined") {
            //loop for each file selected for uploaded.
            for (var i = 0; i < countFiles; i++) {
               var reader = new FileReader();
               reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image"
                  }).appendTo(image_holder);
               }
               image_holder.show();
               reader.readAsDataURL($(this)[0].files[i]);
            }
         } else {
            alert("Este navegador não suporta envio de arquivos.");
         }
      } else {
         alert("Selecione somente imagem");
      }
   });       
          $('#relatorio').click(function(){
            var resposta=prompt('Quaal o número do mês/ano?');
            if(resposta==''){
               alert('Insira o mês/ano.');
               var resposta=prompt('Quaal o número do mês/ano?');
            }
            if(resposta){
                $(location).attr('href','index.php?pagina=relMensal&mes='+resposta+'&act=rel');
            }
          })           
      
      $('#conclui').click(function(){
        var mesAno=$('input[name="mesAno"]').val();
        fecha = confirm('Deseja realmente fechar o relatório?');
        var url = 'index.php?pagina=relMensal&conclui=1&act=rel&mes='+mesAno+'';
        if(fecha){
            $(location).attr('href',url);
        }
      })
      $('#imprimeRel').click(function(){
                var w = window.open(link, "popupWindow", "width=1050, height=2050, scrollbars=yes");
                var $w = $(w.document.body);
                $w.html();
      })
         $(':input[name=dia]').click(function(){
            $(this).datepicker({
               dateFormat: 'dd',
               dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
               dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
               dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
               monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
               monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
           });           
         })
         $('#sexo').css({
            'background': '#ccc'
         });
         $(':input[name^=dt]').click(function(){
            $(this).datepicker({
               dateFormat: 'dd/mm/yy',
               dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
               dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
               dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
               monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
               monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
           });           
         })
      $('.lista span').addClass('fotoMembros');     
      var palavras = new Array('SALDO','TOTAIS');
      $.each(palavras, function(index, value){
         $('tr:contains('+value+')').css('background','darkgray');
      })
      $('.rel tr:even').css('background','darkgray');
});


