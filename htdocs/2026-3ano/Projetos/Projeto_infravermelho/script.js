// Variáveis de controle do tempo
        let tempoInicioDetectado = null;
        const TEMPO_LIMITE_MS = 8000; // 8 segundos em milissegundos

        function atualizarDashboard() {
            fetch('conexao.php')
                .then(response => response.json())
                .then(data => {
                    const elementoStatus = document.getElementById('status');
                    const elementoAviso = document.getElementById('avisoVazamento');
                    const elementoBody = document.body;
                   
                    // Se o valorBruto for 0, significa que o sensor detectou algo (mão/água)
                    if (data.valorBruto === 0) {
                        elementoStatus.textContent = "LIGADO";
                        elementoStatus.className = "status-badge ligado";

                        // Se for a primeira vez que detecta, guarda a hora atual
                        if (tempoInicioDetectado === null) {
                            tempoInicioDetectado = new Date().getTime();
                        } else {
                            // Se já estava detectando, calcula há quanto tempo isso está acontecendo
                            let tempoPassado = new Date().getTime() - tempoInicioDetectado;

                            // Se passar de 8 segundos, ativa os alertas visuais
                            if (tempoPassado >= TEMPO_LIMITE_MS) {
                                elementoAviso.style.display = "block";
                                elementoBody.classList.add("fundo-alerta");
                            }
                        }

                    } else {
                        // Se o sensor voltou a ficar livre (valorBruto === 1)
                        elementoStatus.textContent = "DESLIGADO";
                        elementoStatus.className = "status-badge desligado";
                       
                        // ZERA TUDO: resgata o cronômetro e esconde os avisos
                        tempoInicioDetectado = null;
                        elementoAviso.style.display = "none";
                        elementoBody.classList.remove("fundo-alerta");
                    }
                })
                .catch(error => console.error('Erro na requisição:', error));
        }

        // Deixamos a verificação bem rápida (a cada 100ms) para o cronômetro ser preciso
        setInterval(atualizarDashboard, 100);