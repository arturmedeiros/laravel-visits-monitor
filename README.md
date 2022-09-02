[comment]: <> (<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>)



<p align="center">

<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/favicon.png" width="120">

</p>


# 📬 Visits Monitor - Laravel + Slack Integration
### Receive notifications when you receive visits on _GitHub_!

Já pensou em ser avisado sempre que alguém acessar o seu GitHub? Com essa aplicação OpenSource você recebe notificações via Slack sempre que tiver um novo visitante!

Basta possuir uma conta no [Slack](https://slack.com/) e seguir os passos à seguir.


<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/012.png" width="100%">
</p>

## 🌎 Live Project
Para instalar o Monitor de Visitas ao seu perfil do GitHub, basta colar o código que geramos na [ nossa página](https://visits-monitor.herokuapp.com/). Veja abaixo como utilizar.

### 1) Criando um novo canal no Slack

Primeiro, você precisa ter um canal que receberá as notificações via webhook. Para isso, basta clicar no ícone + e selecionar a opção "Criar um canal".

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/001.png" width="400">
</p>

Informe o nome do seu novo canal. No exemplo, usamos "github-monitor". Além disso, marque a opção "Tornar privado" para garantir maior segurança:

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/002.png" width="400">
</p>

### 2) Ativar Integração com Webhooks

Depois de criar o canal, você deve criar um novo Webhook para seu canal. Para isso, clique com o botão direito sob o nome do novo canal e selecione a opção "Ver detalhes do canal".

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/003.png" width="400">
</p>

Em seguida, clique no botão "Adicionar um app".

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/004.png" width="400">
</p>


No campo de busca, procure por "Incoming Webhooks" e clique em "Instalar".

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/005.png" width="400">
</p>

Clique para adicionar os Webhooks de Entrada ao seu canal.

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/006.png" width="400">
</p>


Agora, escolha para qual canal o webhook deve disparar a notificação. No exemplo, o nome do canal é "github-monitor", e em seguida clique em "Adicionar Integração com o Webhook de entrada".

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/007.png" width="400">
</p>

### 3) Obtendo endpoint do Webhook de Entrada

Pronto! Agora o Slack lhe mostrará o endpoint do seu webhook. Basta copiar esse link e seguir para os passos finais dessa integração.

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/0013.png" width="400">
</p>

### 4) Obtendo código do Rastreio e Monitoramento do seu GitHub

Basta colar o link do seu webhook na nossa página e clicar no botão "Gerar código da imagem!".

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/008.png" width="400">
</p>

Em seguida, você verá o código de rastreio. Copie o código e siga o último passo.

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/009.png" width="400">
</p>

### 5) Implementando o código de Monitoramento

Agora, você deve abrir o "README.md" do seu projeto de apresentação, ou qualquer outro que queira monitorar.

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/010.png" width="400">
</p>

### Pronto!

Você será avisado (a) sempre que alguém acessar o repositório através do seu canal do Slack!

<p align="center">
<img src="https://raw.githubusercontent.com/arturmedeiros/laravel-visits-monitor/master/public/IMGS/011.jpeg" width="400">
</p>
