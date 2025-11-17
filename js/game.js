// Jogo Batalha Naval

// Adiciona estilos personalizados para os pop-ups do SweetAlert2
const style = document.createElement('style');
style.innerHTML = `
	.swal2-popup {
		background-color: #0c192c;
		border: 2px solid #00b4d871;
		box-shadow: 0 0 40px #00b4d871;
		color: white;
		padding: 40px 15px;
		font-family: 'Candara', sans-serif;
			
	}
	.swal2-confirm {
		background-color: #1565C0 !important;
    	box-shadow: 0 0 0 5px #1565C044, 
		0 0 10px #1565C0,
   		0 0 30px #1565C0 !important;
		color: white;
		padding: 8px 15px;
		border-radius: 5px;
		margin-top: 10px;
		font-size: 16px;
		transition: 0.3s;
	}
	.swal2-confirm:hover {
		background-color: #114f96 !important;
    	box-shadow: 0 0 0 5px #1565C044, 
    	0 0 10px #1565C073,
    	0 0 30px #1565C073 !important;
		scale: 0.98;
	}
	.swal2-cancel {
		background-color: #d68512ff !important;
		box-shadow: 0 0 0 5px #d6841260, 
		0 0 10px #d68512ff,
		0 0 30px #d68512ff !important;
		color: white;
		padding: 8px 15px;
		border-radius: 5px;
		margin-top: 10px;
		font-size: 16px;
		transition: 0.3s;
	}
	.swal2-cancel:hover {
		background-color: #B76E00 !important;
		box-shadow: 0 0 0 5px #FF9B0F44,
		0 0 10px #FF9B0F73,
		0 0 30px #FF9B0F73 !important;
		scale: 0.98;
	}
	.popup-vitory {
		padding: 40px 60px !important;
	}
	.title-vitory {
		color: #F5AB35 !important;
	}
	.title-defeat {
		color: #d64912ff !important;
	}
	.title-reload {
		color: #1565C0 !important;
	}

	.popup-manual {
		padding: 10px 10px 10px 10px !important;
		width: 500px !important;
		max-width: 90% !important;
		height: auto !important;
	}
	`;
document.head.appendChild(style);

// Estrutura de módulo para encapsular o jogo
var Game = Game || (function () {
	var _bombs = 0;   //bombas jogadas
	var _hits = 0;   //acertos
	var _ships = {};  //navios
	var _letters = "ABCDEFGHIJ";   //letras
	var $rows = {};     //linhas
	var _salvo = false;	 	//para evitar múltiplos envios

	// Variável para armazenar o intervalo de carregamento
	function start() {
		var title = document.title;
		interval = setInterval(function () {
			if (document.title.length == 11) {
				document.title = 'Carregando..';
			}
			else if (document.title.length == 12) {
				document.title = 'Carregando...';
			}
			else {
				document.title = 'Carregando.';
			}
		}, 500);
		set_table(); // Configura a tabela do jogo
		set_coords(); // Define as coordenadas para cada célula
		set_events(); // Define os eventos de clique
		set_ships(); // Posiciona os navios
		play_sound('melody'); // Inicia a música de fundo
		clearInterval(interval); // Limpa o intervalo de carregamento
		document.title = title;
	}

	// Configura a tabela do jogo
	function set_table() {
		$table = $('<table></table>');
		for (x = 0; x < 10; x++) {
			$tr = $('<tr></tr>');
			for (z = 0; z < 10; z++) {
				$td = $('<td></td>');
				$tr.append($td);
			}
			$table.append($tr);
		}
		$('#game').html($table);
	}

	// Define as coordenadas (linhas e colunas) para cada célula da tabela
	function set_coords() {
		$rows = $('#game table tr');
		for (x = 0, length = $rows.length; x < length; x++) {
			$rows.eq(x).attr('data-row', _letters[x]);
			var $cols = $rows.eq(x).find('td');
			for (y = 0, length = $cols.length; y < length; y++) {
				$cols.eq(y).attr('data-col', (y + 1));
				$cols.eq(y).attr('title', 'Jogar bomba em ' + _letters[x] + (y + 1));
			}
		}
	}

	// Define os eventos de clique para cada célula da tabela
	function set_events() {
		$('#game table td').off('click').click(function () {
			var $this = $(this);
			var row = $this.parent().data('row');
			var col = $this.data('col');
			attack($this, row, col);
		});
		$('#game table td').off('hover').hover(function () {
			play_sound('click');
		});
		$('#sound-checkbox input').off('change').change(function () {
			if (!$(this).is(':checked')) {
				var $audios = $('audio');
				for (var i = 0, length = $audios.length; i < length; i++) {
					$audios.get(i).pause();
				}
			}
			else if (_hits < 17) {
				play_sound('melody');
			}
		});
	}

	// Define os navios no tabuleiro
	function set_ships() {
		set_ship(5);
		set_ship(4);
		set_ship(3);
		set_ship(3);
		set_ship(2);
	}

	// Verifica se é possível posicionar um navio de determinado tamanho
	// Retorna as coordenadas e a orientação se possível, caso contrário tenta novamente
	function can_set_ship(length) {
		var _great = true;
		var _row, _col, _orientation, _direction;

		_orientation = random(1, 2);
		_row = random(1, 10);
		_col = random(1, 10);

		if (_orientation == 1) { // vertical
			while (!(_row - 10 >= length) && !(_row >= length)) {
				_row = random(1, 10);
			}

			if ((_row >= length) && (_row - 10 >= length)) {
				_direction = random(1, 2);
			}
			else if (_row >= length) {
				_direction = 1;
			}
			else {
				_direction = 2;
			}

			row = _row;
			col = _col;
			if (_direction == 1) { // up
				for (x = 0; x < length; x++) {
					if (_ships[_letters[row - 1]] && _ships[_letters[row - 1]][col]) {
						_great = false;
					}
					row--;
				}
			}
			else { // down						
				for (x = 0; x < length; x++) {
					if (_ships[_letters[row - 1]] && _ships[_letters[row - 1]][col]) {
						_great = false;
					}
					row++;
				}
			}
		}
		else { // horizontal
			while (!(_col - 10 >= length) && !(_col >= length)) {
				_col = random(1, 10);
			}

			if ((_col >= length) && (_col - 10 >= length)) {
				_direction = random(1, 2);
			}
			else if (_col >= length) {
				_direction = 1;
			}
			else {
				_direction = 2;
			}

			row = _row;
			col = _col;
			if (_direction == 1) { // left	
				for (x = 0; x < length; x++) {
					if (_ships[_letters[row - 1]] && _ships[_letters[row - 1]][col]) {
						_great = false;
					}
					col--;
				}
			}
			else { // right			
				_ships[_letters[_row - 1]] = {};
				for (x = 0; x < length; x++) {
					if (_ships[_letters[row - 1]] && _ships[_letters[row - 1]][col]) {
						_great = false;
					}
					col++;
				}
			}
		}

		if (_great) {
			return {
				'row': _row,
				'col': _col,
				'orientation': _orientation,
				'direction': _direction
			};
		}
		else {
			return can_set_ship(length);
		}
	}

	// Posiciona o navio no tabuleiro
	function set_ship(length) {
		var data = can_set_ship(length);

		var row = data['row'];
		var col = data['col'];
		var orientation = data['orientation']
		var direction = data['direction']

		if (orientation == 1) { // vertical						
			if (direction == 1) { // up
				for (x = 0; x < length; x++) {
					_ships[_letters[row - 1]] = _ships[_letters[row - 1]] || {};
					_ships[_letters[row - 1]][col] = true;
					row--;
				}
			}
			else { // down						
				for (x = 0; x < length; x++) {
					_ships[_letters[row - 1]] = _ships[_letters[row - 1]] || {};
					_ships[_letters[row - 1]][col] = true;
					row++;
				}
			}
		}
		else { // horizontal
			if (direction == 1) { // left	
				_ships[_letters[row - 1]] = _ships[_letters[row - 1]] || {};
				for (x = 0; x < length; x++) {
					_ships[_letters[row - 1]][col] = true;
					col--;
				}
			}
			else { // right			
				_ships[_letters[row - 1]] = _ships[_letters[_row - 1]] || {};
				for (x = 0; x < length; x++) {
					_ships[_letters[row - 1]][col] = true;
					col++;
				}
			}
		}
	}

	// Gera um número aleatório entre start e end
	// Usado para posicionar os navios
	function random(start, end) {
		return Math.floor((Math.random() * end) + start);
	}

	// Realiza o ataque em uma célula específica
	// Atualiza o estado do jogo (bombas, acertos) e verifica se o jogo terminou
	function attack($cell, row, column) {
		$cell.off('click');
		_bombs++;
		if (_ships[row] && _ships[row][column]) {
			$cell.css('background-color', 'black');
			$cell.attr('title', 'Você acertou um navio em ' + row + column);
			_hits++;
			play_sound('hit');
		}
		else {
			$cell.css('background-color', '#1456b9');
			$cell.attr('title', 'Você já jogou uma bomba em ' + row + column);
			play_sound('miss');
		}

		check_game_over();
	}

	// Verifica se o jogo terminou (vitória ou derrota)
	function check_game_over() {
		if (_hits == 17 && _bombs < 55) {
			salvarEstatisticas("VITÓRIA");
			var taxa_acerto = (_bombs > 0) ? ((_hits / _bombs) * 100).toFixed() : 0;

			$('audio#melody').get(0).pause();
			play_sound('win');

			// Usando SweetAlert2 para exibir a mensagem de vitória
			Swal.fire({
				title: 'Parabéns, você ganhou!',
				text: 'Você ganhou com ' + taxa_acerto + '% de taxa de acerto. Tentativas: ' + _bombs + ' | Acertos: ' + _hits,
				width: 550,
				imageUrl: 'files/vitory.gif',
				imageWidth: 250,
				imageHeight: 200,
				imageAlt: 'Imagem de vitória',
				allowOutsideClick: false,
				customClass: {
					title: 'title-vitory',
					popup: 'popup-vitory'
				}
			});

			$('#game td').off('click mouseenter mouseleave');
			
		} else if (_bombs >= 55) {
			salvarEstatisticas("DERROTA", 'color: red;');
			$('#game td').off('click mouseenter mouseleave');
			
			$('audio#melody').get(0).pause();
			play_sound('gameover');

			// Usando SweetAlert2 para exibir a mensagem de derrota
			Swal.fire({
				title: "Que pena, você perdeu!",
				text: "Você fez " + _bombs + " tentativas. Deseja jogar novamente?",
				imageUrl: "files/defeat.gif",
				imageWidth: 350,
				imageHeight: 160,
				imageAlt: "Imagem de derrota",
				showCancelButton: true,
				confirmButtonText: "Sim, jogar novamente!",
				cancelButtonText: "Cancelar",
				allowOutsideClick: false,
				customClass: {
					title: 'title-defeat',
				}
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire({
						title: "Reiniciando o jogo ...",
						text: "Boa sorte dessa vez!",
						imageUrl: "files/loading.gif",
						imageWidth: 350,
						imageHeight: 180,
						imageAlt: "Imagem de carregamento",
						showConfirmButton: false,
						allowOutsideClick: false,
						timer: 2000,
						timerProgressBar: true,
						customClass: {
							title: 'title-reload',
						}
					}).then(() => {
						location.reload();
					});
				}
			});
		}
	}

	// Função para salvar as estatísticas do jogo via AJAX
	function salvarEstatisticas(resultado) {
		if (_salvo) return; // já foi salvo antes
		_salvo = true;
		const dados = {
			jogador: jogador,
			bombas: _bombs,
			acertos: _hits,
			taxa: (_bombs > 0) ? ((_hits / _bombs) * 100).toFixed() : 0,
			resultado: resultado // "vitoria" ou "derrota"
		};
		console.log("Dados a serem enviados:", dados);
		fetch("save.php", {
			method: "POST",
			headers: {
				"Content-Type": "application/json"
			},
			body: JSON.stringify(dados)
		})
			.then(res => res.json())
			.then(resposta => {
				console.log("Estatísticas salvas:", resposta);
			})
			.catch(err => console.error("Erro ao salvar:", err));
	}

	// Função para tocar sons
	function play_sound(id, volume) {
		if ($('#sound-checkbox').is(':checked')) {
			var sound = $('audio#' + id).get(0);
			if  (volume) {
				sound.volume = volume;
			}
			sound.pause();
			sound.currentTime = 0;
			sound.play();
		}
	}

	// Exposição de métodos públicos
	return {
		start: start,
		getHits: () => _hits,
		getBombs: () => _bombs
	}
})();

// Botão Ranking
var btnScore = document.getElementById('btnScore');

// Função para verificar se o jogador pode acessar o ranking
// O jogador só pode acessar o ranking se tiver terminado o jogo (vitória ou derrota)
function btn_ranking() {
	const hits = Game.getHits();
	const bombs = Game.getBombs();

	if(hits == 17 || bombs >= 55) {
		window.location.href = 'ranking.php';
	} else {
		Swal.fire({
			title: 'Aguarde finalizar o jogo para ver o ranking!',
			icon: 'info',
			confirmButtonText: 'OK'
		});
	}
}
btnScore.onclick = btn_ranking;

// Botão Manual
var btnManual = document.getElementById('btnManual');

// Função para exibir o manual do jogo usando SweetAlert2
function btn_manual() {
	Swal.fire({
		imageUrl: "files/manual.png",
		imageHeight: 850,
		imageAlt: "Manual do Jogo",
		showCloseButton: true,
		showConfirmButton: false,
		draggable: true,
		allowOutsideClick: false,
		customClass: {
			popup: 'popup-manual'
		}
	});
}
btnManual.onclick = btn_manual;
// Iniciar o jogo quando a página estiver pronta
Game.start()