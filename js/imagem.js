 // Quando carregado a página
        $(function ($) {

            // Quando enviado o formulário
            $('#prorrogacao').on('submit', function () {

                // Armazenando objetos em variáveis para utilizá-los posteriormente
                var formulario = $(this);
                var botao = $('#salvar');
                var mensagem = $('#mensagem');

                // Exibindo indicador de carregamento (Bootstrap)
                // Docs: http://getbootstrap.com/javascript/#buttons
                botao.button('loading');

                // Enviando formulário
                $(this).ajaxSubmit({

                    // Definindo tipo de retorno do servidor
                    dataType: 'json',

                    // Se a requisição foi um sucesso
                    success: function (retorno) {

                        // Se cadastrado com sucesso
                        if (retorno.sucesso) {
                            // Definindo estilo da mensagem (sucesso)
                            mensagem.attr('class', 'alert alert-success');

                            // Limpando formulário
                            formulario.resetForm();
                        }
                        else {
                            // Definindo estilo da mensagem (erro)
                            mensagem.attr('class', 'alert alert-danger');
                        }

                        // Exibindo mensagem
                        mensagem.html(retorno.mensagem);

                        // Escondendo indicador de carregamento
                        botao.button('reset');

                    },

                    // Se houver algum erro na requisição
                    error: function () {

                        // Definindo estilo da mensagem (erro)
                        mensagem.attr('class', 'alert alert-danger');

                        // Exibindo mensagem
                        mensagem.html('Oops, ocorreu um erro');

                        // Escondendo indicador de carregamento
                        botao.button('reset');
                    }

                });

                // Retorna FALSE para que o formulário não seja enviado de forma convencional
                return false;

            });

        });
