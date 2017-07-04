<section id='detalhes' class='section'>
    <div class='container'>
        <h2>Detalhes da Advertência</h2>
        <hr>
        <center>
            <table id='table-adv'>
                {adv}
                <tr>
                    <th scope='row'>Aluno:</th>
                    <td>{aluno}</td>
                </tr>
                <tr>
                    <th scope='row'>Disciplina:</th>
                    <td>{disciplina}</td>
                </tr>
                <tr>
                    <th scope='row'>Curso/Série:</th>
                    <td>{curso}</td>
                </tr>
                <tr>
                    <th scope='row'>Tipo:</th>
                    <td>{tipo}</td>
                </tr>
                <tr>
                    <th scope='row'>Item(s):</th>
                    <td>{item}</td>
                </tr>
                <tr>
                    <th scope='row'>Data:</th>
                    <td>{data}</td>
                </tr>
                <tr>
                    <th scope='row'>Status:</th>
                    <td>{status}</td>
                </tr>
                <tr>
                    <th scope='row'>Ocorrido:</th>
                    <td>{descricao}</td>
                </tr>
                {arquivo}
                {/adv}
            </table>
        </center>
        <hr>
        <h3 id='h3-detalhes'>Comentários</h3>
        <hr>
        {entrada}
        <table id='table-adv'>
            <tr>
                <th scope='row'>Usuário:</th>
                <td>{usuario}</td>
            </tr>
            <tr>
                <th scope='row'>Data:</th>
                <td>{data_criacao}</td>
            </tr>
            <tr>
                <th scope='row'>Comentário:</th>
                <td>{comentario}</td>
            </tr>
            {arquivo}
        </table>
        <hr>
        {/entrada}
    </div>
</section>