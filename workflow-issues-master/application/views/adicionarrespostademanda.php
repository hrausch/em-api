<section id="contact" class="section">
    <div class="container">
        <h2>Formulário resposta</h2>
        <hr style="color: #000; background-color: #000; height: 3px;">
        <div class="col-md-10 col-md-offset-1 wow fadeInUp" data-wow-delay=".3s">

            <?php echo '<form class="form-horizontal" id="formDemanda" method="POST" action="{url}index.php/Demanda/registraResposta/' . $id_demanda . '" enctype="multipart/form-data">'; ?>
            <div class="form-group">
                <label for="descricao_demanda" class="col-sm-5 control-label">Escreva a sua resposta: *</label>
                <div class="col-sm-7">
                    <textarea name="descricao" id="descricao_demanda" class="form-control" rows="3" placeholder="Escreva aqui a sua resposta" required></textarea>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label for="arquivo_anexo" id="arqv" class="col-sm-5 control-label">Anexar arquivo: </label>
                <div class="col-sm-7">
                    <input type="file" name="arquivo_anexo" id="arquivo" class="form-control">
                </div>
            </div>
            <hr>

            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-5">
                    <button type="submit" class="btn-block btn-success" id="botaoEnviar" >Salvar</button>
                </div>
            </div>
            <br><br><br>
            </form>       
        </div>

    </div>
</section>
