<section id="demandas">

    <div id="container" style="margin-left: 20px; margin-right: 20px;">
        <center><h2>Demandas</h2></center>
        <a id="botao" class="btn btn-primary" href="{url}index.php/Demanda/loadpageadddemanda" >Adicionar nova demanda</a>	
        <br><br>
        <?php
        if ($demandas_recebidas != NULL) {
            echo '<table class="table" id="tabela">
           			<caption>LISTA DE DEMANDAS</caption>
                	<thead>
                    	<tr>
                        	<th>De</th>
                        	<th>Para</th>
                        	<th>Tipo</th>
                        	<th>Data da demanda</th>
                        	<th>Última interação</th>
                        	<th>Situação</th>
                        	<th>Detalhes</th>
                    	</tr>
                		</thead>
                		<tbody>' . $demandas_recebidas . '</tbody></table>';
        } else {
            echo '<h3> Não há nenhuma demanda para ser listada';
        }
        ?>

    </div>		
    <br><br>
</section>