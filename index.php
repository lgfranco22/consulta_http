<!doctype html>
<!--
    Parte do código front-end por Bruno Cyber Root -- https://github.com/Cyber-Root0
    Código back-end por Luiz Gonzaga Franco Michelmann
-->
<html>
<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
				<title>Consulta Código HTTP</title>
                <link rel="stylesheet" href="https://bootstrapstudio.io/demo//embed//bootstrap/4/default/bootstrap.min.css">
                <link rel="stylesheet" href="https://bootstrapstudio.io/demo//embed/animation/animate.min.css" bs-system-element="" bs-hidden="">
                <link rel="stylesheet" href="https://bootstrapstudio.io/demo//embed/animation/aos.min.css" bs-system-element="" bs-hidden="">
                <link rel="stylesheet" bs-hidden="1" bs-system-element="1" href="https://bootstrapstudio.io/demo//embed/fonts/fontawesome-all.min.css">
                <link rel="stylesheet" bs-hidden="1" bs-system-element="1" href="https://bootstrapstudio.io/demo//embed/fonts/font-awesome.min.css">
                <link rel="stylesheet" bs-hidden="1" bs-system-element="1" href="https://bootstrapstudio.io/demo//embed/fonts/ionicons.min.css">
                <link rel="stylesheet" bs-hidden="1" bs-system-element="1" href="https://bootstrapstudio.io/demo//embed/fonts/line-awesome.min.css">
                <link rel="stylesheet" bs-hidden="1" bs-system-element="1" href="https://bootstrapstudio.io/demo//embed/fonts/material-icons.min.css">
                <link rel="stylesheet" bs-hidden="1" bs-system-element="1" href="https://bootstrapstudio.io/demo//embed/fonts/simple-line-icons.min.css">
                <link rel="stylesheet" href="https://bootstrapstudio.io/demo//embed/fonts/fontawesome5-overrides.min.css" bs-system-element="" bs-hidden="">
                <link rel="stylesheet" bs-hidden="1" bs-system-element="1" href="https://bootstrapstudio.io/demo//embed/fonts/typicons.min.css">
                <link rel="stylesheet" href="style.css">
    </head>

			<body>
				<section class="contact-clean">
					<form method="post">
						<h2 class="text-center">Qual o erro ?</h2>
                        <div class="form-group">
                            <input class="form-control is-invalid" type="text" name="cod" placeholder="Ex.: 200">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Consultar</button>
                        </div>
            <?php
                $tipos = array(
                    100 => "<b>Continuar</b><br><p>Isso significa que o servidor tenha recebido os cabeçalhos da solicitação, e que o cliente deve proceder para enviar o corpo do pedido (no caso de um pedido para que um corpo deve ser enviado, por exemplo, um POST pedido). Se o corpo é grande o pedido, enviando-os para um servidor, quando o pedido já foi rejeitada com base em cabeçalhos inadequado é ineficiente. Para ter um cheque do servidor se o pedido pode ser aceite com base no pedido de cabeçalhos sozinho, o cliente deve enviar Esperar: 100-continue como um cabeçalho no seu pedido inicial e verifique se a 100 Continuar código de status é recebido em resposta antes de permanente (ou receber 417 Falha na expectativa e não continuar).</p>",
                    101 => "<b>Mudando Protocolos</b><br><p>Isso significa que o solicitante pediu ao servidor para mudar os protocolos e o servidor está reconhecendo que irá fazê-lo. 102 Processamento (WebDAV) (RFC 2518) Como uma solicitação WebDAV pode conter muitos sub-pedidos que envolvam operações de arquivo, pode demorar muito tempo para concluir o pedido. Este código indica que o servidor recebeu e está processando o pedido, mas nenhuma resposta ainda não está disponível. Isso impede que o cliente o tempo limite e supondo que o pedido foi perdido.</p>",
                    122 => "<b>Pedido-URI muito longo</b><br><p>Este é um padrão IE7 somente código não significa que o URI é mais do que um máximo de 2083 caracteres. (<a href='#414'>Ver código 414</a>).</p>",
                    200 => "<b>OK</b><br><p>Padrão de resposta para solicitações HTTP sucesso. A resposta real dependerá do método de solicitação usado. Em uma solicitação GET, a resposta conterá uma entidade que corresponde ao recurso solicitado. Em uma solicitação POST a resposta conterá a descrição de uma entidade, ou contendo o resultado da ação.</p>",
                    201 => "<b>Criado</b><br><p>O pedido foi cumprido e resultou em um novo recurso que está sendo criado.</p>",
                    202 => "<b>Aceito</b><br><p>O pedido foi aceito para processamento, mas o tratamento não foi concluído. O pedido poderá ou não vir a ser posta em prática, pois pode ser anulado quando o processamento ocorre realmente.</p>",
                    203 => "<b>Não-autorizado (desde HTTP/1.1)</b><br><p>O servidor processou a solicitação com sucesso, mas está retornando informações que podem ser de outra fonte.</p>",
                    204 => "<b>Nenhum conteúdo</b><br><p>O servidor processou a solicitação com sucesso, mas não está retornando nenhum conteúdo.</p>",
                    205 => "<b>Reset</b><br><p>O servidor processou a solicitação com sucesso, mas não está retornando nenhum conteúdo. Ao contrário da 204, esta resposta exige que o solicitante redefinir a exibição de documento.</p>",
                    206 => "<b>Conteúdo parcial</b><br><p>O servidor está entregando apenas parte do recurso devido a um cabeçalho intervalo enviados pelo cliente. O cabeçalho do intervalo é usado por ferramentas como wget para permitir retomada de downloads interrompidos, ou dividir um download em vários fluxos simultâneos.</p>",
                    207 => "<b>Status Multi (WebDAV) (RFC 4918)</b><br><p>O corpo da mensagem que se segue é um XML da mensagem e pode conter um número de códigos de resposta individual, dependendo de quantas sub-pedidos foram feitos.</p>",
                    300 => "<b>Múltipla escolha</b><br><p>Indica várias opções para o recurso que o cliente pode acompanhar. É, por exemplo, poderia ser usado para apresentar opções de formato diferente para o vídeo, arquivos de lista com diferentes extensões, ou desambiguação sentido da palavra.</p>",
                    301 => "<b>Movido</b><br><p>Esta e todas as solicitações futuras devem ser direcionada para o URI.</p>",
                    302 => "<b>Encontrado</b><br><p>Este é um exemplo de boas práticas industriais contradizendo a norma. especificação HTTP/1.0 (RFC 1945) exigiu o cliente para executar um redirecionamento temporário (o que descreve frase original era “Movido Temporariamente”), mas os browsers populares executadas 302 com a funcionalidade de um 303 Consulte Outros. Por isso, acrescentou HTTP/1.1 códigos de status 303 e 307 a distinguir entre os dois comportamentos. No entanto, a maioria das aplicações Web e os quadros ainda usam o código de status 302 como se fosse o 303.</p>",
                    304 => "<b>Não modificado</b><br><p>Indica que o recurso não foi modificado desde o último pedido. Normalmente, o cliente fornece um cabeçalho HTTP como o Se-Modificado-Desde cabeçalho para proporcionar um tempo contra o qual para comparar. Usando este poupa largura de banda e de reprocessamento no servidor e cliente, uma vez que apenas os dados do cabeçalho devem ser enviados e recebidos em comparação com a totalidade da página que está sendo reprocessados ​​pelo servidor, em seguida, enviado novamente utilizando mais largura de banda do servidor e cliente.</p>",
                    305 => "<b>Use Proxy (desde HTTP/1.1)</b><br><p>Muitos clientes HTTP (como o Mozilla e Internet Explorer) podem não tratar corretamente as respostas com este código de status, principalmente por razões de segurança.</p>",
                    306 => "<b>Proxy Switch</b><br><p>Deixou de ser usado.</p>",
                    307 => "<b>Redirecionamento temporário (desde HTTP/1.1)</b><br><p>Nesta ocasião, o pedido deve ser repetido com outro URI, mas futuras solicitações ainda pode usar a URI original. Em contraste com a 303, o método de pedido não deve ser mudado quando a reedição do pedido original. Por exemplo, uma solicitação POST deve ser repetido com outro pedido POST.</p>",
                    401 => "<b>Não autorizado</b><br><p>Semelhante ao 403 Forbidden, mas especificamente para o uso quando a autenticação é possível, mas não conseguiu ou ainda não foram fornecidos. A resposta deve incluir um cabeçalho do campo www-authenticat contendo um desafio aplicável ao recurso solicitado. Veja Basic autenticação de acesso e autenticação Digest acesso .</p>",
                    402 => "<b>Pagamento necessário</b><br><p>Reservado para uso futuro. A intenção original era que esse código pudesse ser usado como parte de alguma forma de dinheiro digital ou de micro pagamento regime, mas isso não aconteceu, e esse código não é usado normalmente.</p>",
                    403 => "<b>Proibido</b><br><p>O pedido foi um pedido legal, mas o servidor está recusando a responder a ela. Ao contrário de um Unauthorized 401 resposta, autenticação não fará diferença.</p>",        
                    404 => "<b>Não encontrado</b><br><p>O recurso requisitado não foi encontrado, mas pode ser disponibilizado novamente no futuro. As solicitações subsequentes pelo cliente são permitidas. Eventualmente o recurso pedido tivera sido removido do servidor por algum motivo mas, poderá ser reposto caso se de a necessidade.</p>",
                    405 => "<b>Método não permitido</b><br><p>Foi feita uma solicitação de um recurso usando um método de pedido não é compatível com esse recurso, por exemplo, usando GET em um formulário, que exige que os dados a serem apresentados via POST, PUT ou usar em um recurso somente de leitura.</p>",
                    406 => "<b>Não Aceitável</b><br><p>O recurso solicitado é apenas capaz de gerar conteúdo não aceitáveis ​​de acordo com os cabeçalhos Accept enviados na solicitação.</p>",
                    407 => "<b>Autenticação de proxy necessária</b><br>",
                    408 => "<b>Timeout Pedid</b><br><p>O servidor sofreu timeout ao aguardar a solicitação. De acordo com as especificações HTTP W3: “O cliente não apresentar um pedido dentro do tempo que o servidor estava preparado para esperar o tempo. O cliente pode repetir o pedido, sem modificações na tarde qualquer. ”</p>",
                    409 => "<b>Conflito</b><br><p>Indica que a solicitação não pôde ser processada por causa do conflito no pedido, como um conflito de edição .</p>",
                    410 => "<b>Gone</b><br><p>Indica que o recurso solicitado não está mais disponível e não estará disponível novamente. Isto deve ser usado quando um recurso foi intencionalmente removido e os recursos devem ser removidos. Ao receber um código de estado 410, o cliente não deverá solicitar o recurso novamente no futuro. Clientes como motores de busca devem remover o recurso de seus índices. A maioria dos casos de uso não necessitam de clientes e motores de busca para purgar o recurso, e um “404 Not Found” pode ser utilizado.</p>",
                    411 => "<b>Comprimento necessário</b><br><p>O pedido não especifica o comprimento do seu conteúdo, o que é exigido pelo recurso solicitado.</p>",
                    412 => "<b>Pré-condição falhou</b><br><p>O servidor não cumpre uma das condições que o solicitante coloca na solicitação.</p>",
                    413 => "<b>Entidade de solicitação muito grande</b><br><p>A solicitação é maior do que o servidor está disposto ou capaz de processar.</p>",
                    414 => "<b>Pedido-URI Too Long</b><br><p>O URI fornecido foi muito longo para ser processado pelo servidor.</p>",
                    415 => "<b>Tipo de mídia não suportado</b><br><p>A entidade tem um pedido tipo de mídia que o servidor ou o recurso não tem suporte. Por exemplo, o cliente carrega uma imagem como image / svg + xml, mas o servidor requer que imagens usar um formato diferente.</p>",
                    416 => "<b>Solicitada de Faixa Não Satisfatória</b><br><p>O cliente solicitou uma parte do arquivo, mas o servidor não pode fornecer essa parte. Por exemplo, se o cliente pediu uma parte do arquivo que está para além do final do arquivo.</p>",
                    417 => "<b>Falha na expectativa</b><br><p>O servidor não pode cumprir as exigências do campo de cabeçalho Espere-pedido.</p>",
                    418 => "<b>Eu sou um bule de chá</b><br><p>Este código foi definido em 1998 como uma das tradicionais brincadeiras de 1º de abril da IETF, na RFC 2324, Hyper Text Cafeteira Control Protocol, e não é esperado para ser implementado por servidores HTTP reais.</p>",
                    422 => "<b>Entidade improcessável (WebDAV) (RFC 4918)</b><br><p>O pedido foi bem formado, mas era incapaz de ser seguido devido a erros de semântica.</p>",
                    423 => "<b>Fechado (WebDAV) (RFC 4918)</b><br><p>O recurso que está sendo acessado está bloqueado.</p>",
                    424 => "<b>Falha de Dependência (WebDAV) (RFC 4918)</b><br><p>A solicitação falhou devido à falha de uma solicitação anterior (por exemplo, um PROPPATCH).</p>",
                    425 => "<b>Coleção não Ordenada (RFC 3648)</b><br><p>Definido em projectos de “WebDAV Avançada Coleções Protocolo”, mas não está presente no “Web Distributed Authoring and Versioning (WebDAV) Ordenados Coleções protocolo”.</p>",
                    426 => "<b>Upgrade Obrigatório (RFC 2817)</b><br><p>O cliente deve mudar para um outro protocolo, como TLS/1.0 . Resposta n º 444 Um Nginx extensão do servidor HTTP. O servidor retorna nenhuma informação para o cliente e fecha a conexão (útil como um impedimento para malware). Com 449 Repetir Uma extensão de Microsoft. O pedido deve ser repetida após a realização da ação apropriada.</p>",
                    450 => "<b>Bloqueados pelo Windows Controles dos Pais</b><br><p>Uma extensão de Microsoft. Este erro é dado quando Parental Controls do Windows estão ativadas e está bloqueando o acesso a determinada página da web.</p>",
                    499 => "<b>Cliente fechou Pedido (utilizado em ERPs/VPSA)</b><br><p>Um Nginx extensão do servidor HTTP. Este código é introduzido para registrar o caso quando a conexão é fechada pelo cliente ao servidor HTTP é o processamento de seu pedido, fazendo com que servidor não consiga enviar o cabeçalho HTTP de volta.</p>",
                    500 => "<b>Erro interno do servidor (Internal Server Error)</b><br><p>Indica um erro do servidor ao processar a solicitação. Na grande maioria dos casos está relacionada as permissões dos arquivos ou pastas do software ou script que o usuário tenta acessar e não foram configuradas no momento da programação/construção do site ou da aplicação. Para corrigir, verifique o diretório em que o arquivo ou recurso que houve falha de acesso está localizado, e este arquivo (BEM COMO TODOS OS OUTROS), obedeçam as regras seguintes:<br>Pastas — chmod 755 (não utilizar 777)<br>Arquivos — chmod 644 (não utilizar o 777, só utilizar outro se for expressamente solicitado na instalação)<br>OBS.: algumas aplicações e ou sistemas requerem permissões diferenciadas, pelo qual é importante verificar com os criadores do scripts/sistema, qual seria a permissão correta a usar. O exemplo descreve como é realizado em sistemas operacionais Unix-like. Fazer analogia como é realizado em sistemas como Windows (Windows 7, 8, XP entre outros).<br>Este erro também pode ocorrer se o arquivo. Htaccess do seu site Estiver modificar os parâmetros tentando fazer utilizando PHP como comandos: php_flag ou php_value. Remova qualquer entrada com esses comandos do arquivo .htaccess. Se for fazer nos parâmetros modificações do PHP, utilize o arquivo php.ini para fazer isso.</p>",
                    501 => "<b>Não implementado (Not implemented)</b><br><p>O servidor ainda não suporta a funcionalidade ativada</p>",
                    502 => "<b>Bad Gateway</b><br><p>Em regra, o erro quando há uma configuração imprecisa entre os computadores de back-end, possivelmente incluindo o servidor Web no site visitado. Antes de analisar este problema, é necessário limpar o cache do navegador, completamente. Se estiver navegando na Web e observar este problema em todos os websites visitados, então 1) o seu provedor de serviço de Internet tem uma falha/sobrecarga em um equipamento principal ou 2) tem algo de errado com a sua conexão interna à Internet, por exemplo, o firewall não está funcionando corretamente. Se for o primeiro caso, somente o seu provedor pode ajudar. Se for o segundo, você precisa corrigir o que quer que esteja prevenindo que você acesse a Internet. Se tiver este problema somente em alguns websites visitados, provavelmente existe um problema nos sites. Por exemplo, uma das peças dos equipamentos estão falhando ou estão sobrecarregadas. Entre em contato com os responsáveis destes sites.</p>",
                    503 => "<b>Serviço indisponível (Service Unavailable)</b><br><p>O servidor está em manutenção ou não consegue dar conta dos processamentos de recursos devido à sobrecarga do sistema. Isto deve ser uma condição temporária.</p>",
                    504 => "<b>Gateway Time-Out</b><br><p>É caracterizado por erros particulares do site em questão. Pode ser que o site esteja em manutenção ou não exista.</p>",
                    505 => "<b>HTTP Version not supported</b><br><p>A maioria dos browsers assume que os servidores de rede suportam versões 1.x do protocolo HTTP. Na prática, as versões muito antigas como a 0.9 são pouco utilizadas atualmente, não apenas porque eles fornecem pouca segurança e desempenho mais baixo do que as versões mais recentes do protocolo. Então, se acontecer esse erro no seu navegador de rede, a única opção é fazer o upgrade do software do servidor de rede. Se a versão da solicitação 1.x falhar, pode ser porque o servidor de rede está suportando versões incorretas do protocolo 1.x, em vez de não suportá-las.</p>"
                );
                
            ?>
            <div class="form-group">
                <?php
                if(isset($_POST['cod']) && !empty($_POST['cod']))
                {
                    $cod = htmlentities($_POST['cod']);
                    if(array_key_exists($cod, $tipos))
                    {
                        echo "<div class='alert alert-success'>".$tipos[$cod]."</div>";
                    }
                    else{
                        echo "<div class='alert alert-danger'>Código não registrado. Para saber mais acesse a documentação na <a href='https://pt.wikipedia.org/wiki/Lista_de_c%C3%B3digos_de_estado_HTTP'>Wikipédia</a></div>";
                    }
                }
                if(isset($_POST['cod']) && empty($_POST['cod'])){
                    echo "<div class='alert alert-danger'>Digite um código</div>";
                }
                ?>
			</div>
		</form>
	</section>
</body>
</html>