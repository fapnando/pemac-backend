			<div class="section background-gray" id="contato">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Contato</h1>
                        <hr class="hr-color-white">
                    </div>
                </div>
        <div class="row">
          <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3657.778662036378!2d-46.63932097725146!3d-23.540461994337917!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce58507840e2a5%3A0xc646ffaf293faa9b!2sAv.+Rio+Branco%2C+279+-+Campos+El%C3%ADseos%2C+S%C3%A3o+Paulo+-+SP!5e0!3m2!1spt-BR!2sbr!4v1436015716254" width="485" height="355" frameborder="0"></iframe>
            <p>Endereço: Av. Rio Branco n° 279 – 7° andar</p>
            <p>Campos Elíseos – São Paulo – SP</p>
            <p>CEP: 01205-000</p>
            <p>Telefone: (11) 4786-2504</p>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <div class="col-md-2">
                 
                </div>
                <div class="col-md-12">
                  <input class="form-control paddind-form-contato" id="nome" placeholder="Digite seu nome"
                  type="email">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-2">
                 
                </div>
                <div class="col-md-12">
                  <input class="form-control paddind-form-contato" id="email" placeholder="Digite seu email"
                  type="email">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-2">
                  
                </div>
                <div class="col-md-12">
                  <input class="form-control paddind-form-contato" id="empresa" placeholder="Digite o nome de sua empresa"
                  type="email">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-2">
                  
                </div>
                <div class="col-md-12">
                  <input class="form-control paddind-form-contato" id="telefone" placeholder="Digite seu telefone"
                  type="email">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-2">
                 
                </div>
                <div class="col-md-12">
                  <input class="form-control paddind-form-contato" id="assunto" placeholder="Digite o assunto"
                  type="email">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-2">
                  
                </div>
                <div class="col-md-12">
                  <textarea class="form-control" id="mensagem" placeholder="Digite a mensagem"
                  type="email" rows="4"></textarea>
                </div>
              </div>
               <div class="col-md-2">
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-block btn-default submitMail">Enviar</button>
                </div>
          </div>
        </div>
      </div>
        </div>
        <footer class="section section-primary">
      <div class="container" style="text-align:center;">
        <p>Todos os direitos reservados a PEMAC Engenharia elétrica.</p>
        <p>Projeto desenvolvido por <a style="color:white;text-decoration:none;" href="http://fapnando.github.io" target="_Blank">fapnando</a></p>
      </div>
    </footer>
    </body>
    <script>
        $(document).ready(function(){
            $(document).on('click','.openProjectsClients',function(){
                id = $(this).data('id');
                titulo = $(this).data('titulo');
                $.ajax({
                  url: baseUrl+"clientes/getProjects",
                  type: 'POST',
                  dataType: 'json',
                  data: {cliente:id},
                })
                .done(function(returned_data) {
                    //console.log(returned_data);
                    conteudoModal = '';
                    if(returned_data.length > 0){
                      $.each(returned_data,function(x,value){
                        conteudoModal += '<p><strong>Projeto: </strong>'+value.titulo+'</p>';
                        conteudoModal += '<p>'+value.conteudo+'</p>';
                      });
                    }else{
                      conteudoModal = '<p>Nenhum projeto cadastrado.</p>';
                    }
                    $('.clientName').html(titulo);
                    $('.contentProjects').html(conteudoModal);
                    $('#modal-clientes').modal();
                })
                .fail(function() {
                  console.log("error");
                });
            });

        $(".menu-item").click(function (e){
         e.preventDefault();
         var href = $(this).attr("href");
         var offsetTop = $("#"+href).offset().top;
         $('html,body').animate({scrollTop: offsetTop}, 500);
        });

        $(document).on('click','.gotoPage',function(){
          link = $(this).data('link');
          window.location.href = baseUrl+link;
        });

        $(document).on('click','.submitMail',function(){
          nome = $("#nome").val();
          email = $("#email").val();
          empresa = $("#empresa").val();
          telefone = $("#telefone").val();
          assunto = $("#assunto").val();
          mensagem = $("textarea#mensagem").val();
          if(nome == '' || email == '' || empresa == '' || telefone == '' || assunto == '' || mensagem == ''){
            $(".contentContact").html('<p>Todos os campos são de preenchimento obrigatório.</p>');
            $('#modal-contato').modal();
          }else if(email.search('@') == -1 || email.search('.com') == -1){
            $(".contentContact").html('<p>Digite um email válido.</p>');
            $('#modal-contato').modal();
          }else{
            $.ajax({
              url: baseUrl+"contato/enviar",
              type: 'POST',
              dataType: 'html',
              data: {nome:nome, email:email,empresa:empresa,telefone:telefone,assunto:assunto,mensagem:mensagem},
            })
            .done(function(returned_data) {
                if(returned_data == 'true'){
                  $(".contentContact").html('<p>Email enviado com sucesso, em breve entraremos em contato.</p>');
                  $('#modal-contato').modal();
                }else{
                  $(".contentContact").html('<p>Houve um problema no envio do email, por favor, tente novamente ou entre em contato utilizando os telefones disponíveis no site.</p>');
                  $('#modal-contato').modal();
                }
            })
            .fail(function() {
              $(".contentContact").html('<p>Houve um problema no envio do email, por favor, tente novamente ou entre em contato utilizando os telefones disponíveis no site.</p>');
              $('#modal-contato').modal();
            });
          }
        });
      });
    </script>
	</body>
</html>