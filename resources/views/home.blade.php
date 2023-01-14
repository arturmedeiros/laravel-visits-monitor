<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Github Visits Monitor - Laravel REST API - Receive notifications when you receive visits!</title>
        <meta name="description" content="Put a picture on your profile and get a notification whenever someone logs in.">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="{{ url('favicon.png') }}">
        <link rel="icon" type="image/png" href="{{ url('favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ url('favicon.png') }}">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link rel="canonical" href="https://visits-monitor.herokuapp.com">
        <meta property="og:type" content="website">
        <meta property="og:url" content="https://visits-monitor.herokuapp.com">
        <meta property="og:title" content="Github Visits Monitor">
        <meta property="og:image" content="{{ url('favicon.png') }}">
        <meta property="og:description" content="Receive notifications when you receive visits!">
        <meta property="og:site_name" content="Github Visits Monitor">
        <meta property="og:locale" content="pt_BR">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:url" content="https://visits-monitor.herokuapp.com">
        <meta name="twitter:title" content="Github Visits Monitor">
        <meta name="twitter:description" content="Receive notifications when you receive visits!">
        <meta name="twitter:image" content="{{ url('favicon.png') }}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            html,
            body {
                height: 100%;
            }

            body {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }

            .form-signin {
                width: 100%;
                max-width: 420px;
                padding: 15px;
                margin: auto;
            }

            .form-label-group {
                position: relative;
                margin-bottom: 1rem;
            }

            .form-label-group > input,
            .form-label-group > label {
                height: 3.125rem;
                padding: .75rem;
            }

            .form-label-group > label {
                position: absolute;
                top: 0;
                left: 0;
                display: block;
                width: 100%;
                margin-bottom: 0; /* Override default `<label>` margin */
                line-height: 1.5;
                color: #495057;
                pointer-events: none;
                cursor: text; /* Match the input under the label */
                border: 1px solid transparent;
                border-radius: .25rem;
                transition: all .1s ease-in-out;
            }

            .form-label-group input::-webkit-input-placeholder {
                color: transparent;
            }

            .form-label-group input:-ms-input-placeholder {
                color: transparent;
            }

            .form-label-group input::-ms-input-placeholder {
                color: transparent;
            }

            .form-label-group input::-moz-placeholder {
                color: transparent;
            }

            .form-label-group input::placeholder {
                color: transparent;
            }

            .form-label-group input:not(:placeholder-shown) {
                padding-top: 1.25rem;
                padding-bottom: .25rem;
            }

            .form-label-group input:not(:placeholder-shown) ~ label {
                padding-top: .25rem;
                padding-bottom: .25rem;
                font-size: 12px;
                color: #777;
            }

            /* Fallback for Edge
            -------------------------------------------------- */
            @supports (-ms-ime-align: auto) {
                .form-label-group > label {
                    display: none;
                }
                .form-label-group input::-ms-input-placeholder {
                    color: #777;
                }
            }

            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            /* Fallback for IE
            -------------------------------------------------- */
            @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
                .form-label-group > label {
                    display: none;
                }
                .form-label-group input:-ms-input-placeholder {
                    color: #777;
                }
            }
            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
    </head>
    <body>
    <div id="app" class="form-signin">
        <div class="text-center mb-4">
            <img class="mb-4" src="{{ url('favicon.png') }}" alt="" width="120" height="120">
            <h1 v-if="!setCode" class="h3 mb-3 font-weight-bold">Ativar monitoramento</h1>
            <p v-if="!setCode">Cole o link do seu webhook do <a target="_blank" href="https://api.slack.com/messaging/webhooks#getting-started"><b>Slack</b></a> para que possamos gerar o código da imagem.
        </div>

        <div v-if="!setCode" class="form-label-group">
            <input v-model="input"
                   @keyup="validateInput()"
                   type="text"
                   id="inputWebhook"
                   class="form-control"
                   placeholder="Webhook do Slac"
                   required
                   autofocus>
            <label for="inputWebhook">Webhook do Slack</label>
        </div>
        <button v-if="!error && !setCode"
                @click="createWebhook()"
                class="btn btn-lg btn-primary btn-block">Gerar código da imagem!</button>
        <button v-if="error" class="btn disabled btn-lg text-black btn-warning btn-block">Webhook inválido!</button>

        <div v-if="error" class="mt-3 mb-3 text-muted text-center">
            <div class="mb-3">Exemplo de Webhook:</div>
            <div class="alert alert-danger">
                <code>https://hooks.slack.com/services/T00000000/B00000000/XXXXXXXXXXXXXXXXXXXXXXXX</code>
            </div>
        </div>
        <div v-if="setCode && !error"
             class="mt-0 mb-3 text-muted text-center">
            <div class="mb-4">
                <h1 class="mb-3"
                    style="color: #000000; font-weight: 600;">
                    🎉 Parabéns!
                </h1>
                <h5 class="" style="">
                    Agora você pode receber atualizações sempre que alguém visitar seu perfil.
                </h5>
                <p class="" style="">
                    Cole o código abaixo em qualquer arquivo com a extensão ".md" no GitHub:
                </p>
            </div>
            <div class="alert alert-primary">
                <code style="color: #002d61;">
                    @{{ setCode }}
                </code>
                <button @click="copyCode()"
                        class="mt-3 btn btn-lg btn-primary btn-block">
                    <span v-if="!copy">
                        Copiar código
                    </span>
                    <span v-else>
                        Copiado!
                    </span>
                </button>
            </div>
        </div>
        <p class="mt-5 mb-3 text-muted text-center">&copy; {{ now()->format('Y') }} - @arturmedeiros - <a target="_blank" href="https://github.com/arturmedeiros/laravel-visits-monitor"><b>GitHub</b></a></p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.10"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script>
        new Vue({
            el: "#app",
            data(){
                return {
                    webhook: null,
                    code: null,
                    input: null,
                    error: null,
                    copy: false
                }
            },
            computed: {
                setCode(){
                    let result = null
                    if(this.webhook) {
                        result = `<img width="1px" height="1px" src="https://github.arjos.com.br/tracking/img/${this.webhook}.png">`
                    }
                    return result
                }
            },
            methods: {
                createWebhook(){
                    if(this.input && this.input !== '') {
                        if(this.input.includes('https://hooks.slack.com/services')){
                            this.webhook = this.input.replace('https://hooks.slack.com/services/', '')
                        } else if(this.input.includes('http://hooks.slack.com/services')) {
                            this.webhook = this.input.replace('http://hooks.slack.com/services/', '')
                        } else {
                            this.error = true
                        }
                    }
                },
                validateInput(){
                    if(this.input && this.input !== '') {
                        if(this.input.includes('https://hooks.slack.com/services')){
                            this.error = false
                        } else if(this.input.includes('http://hooks.slack.com/services')) {
                            this.error = false
                        } else {
                            this.error = true
                        }
                    } else {
                        this.error = false
                    }
                },
                copyCode(){
                    let copyText = this.setCode;
                    navigator.clipboard.writeText(copyText);
                    // console.log(copyText)
                    // alert('Código copiado!')
                    this.copy = true
                }
            },
        });
    </script>
    </body>
</html>
