<div class="logo--field">
	<span>
		<img src="<?php echo BASE_URL; ?>assets/images/fkart-logo.png" class="logo" alt="Logo Fkart">
	</span>
	<span>
		<img src="<?php echo BASE_URL; ?>assets/images/force-kart.png" class="logo" alt="Logo Fkart">
		<img src="<?php echo BASE_URL; ?>assets/images/acka.png" class="logo" alt="Logo Fkart">
	</span>
</div>

<div class="breadcrumb">
	<span></span>
	<a href="<?php echo BASE_URL; ?>login/logout" class="btn">Sair do Sistema</a>
</div>


<div class="content">
	<div class="schedule-client--data">
		<h3 class="txt-center mb-2">Dados do Perfil</h3>

		<div class="table-line wrap py-s">
			<div class="w-50">
				<label for="fullname_pilot" class="bold">Nome do Piloto:</label>
				<?php echo $pilot_info['fullname_pilot']; ?>
			</div>
			<div class="w-50">
				<label for="nickname_pilot" class="bold">Nome (Tabela de Pontuação):</label>
				<?php echo $pilot_info['nickname_pilot']; ?>
			</div>
		</div>
		<div class="table-line wrap py-s">
			<div class="w-50">
				<label for="cpf" class="bold">CPF:</label>
				<?php echo $pilot_info['cpf']; ?>
			</div>
			<div class="w-50">
				<label for="birth_date" class="bold">Data de Nascimento:</label>
				<?php echo date('d/m/Y', strtotime($pilot_info['birth_date'])); ?>
			</div>
		</div>
		<div class="table-line wrap py-s">
			<div class="w-50">
				<label for="cellphone" class="bold">Celular:</label>
				<?php echo $pilot_info['cellphone']; ?>
			</div>
			<div class="w-50">
				<label for="date_registration" class="bold">Data de Registro:</label>
				<?php echo date('d/m/Y', strtotime($pilot_info['date_registration'])); ?>
			</div>
		</div>
		<div class="links-center my-el">
			<a href="<?php echo BASE_URL; ?>pilots/edit/<?php echo $pilot_info['id']; ?>" class="btn">Editar Perfil</a>
		</div>
	</div>

	<div class="title-table mt-2">
		Lista de Campeonatos Disponíveis
	</div>

	<!-- Cabeçalho Tabela (Table Header) -->
	<?php if ($tourney_list) : ?>
		<div class="table_header">
			<div class="table-50">Nome</div>
			<div class="table-30">Local</div>
			<div class="table-20 txt-center">Situação</div>
		</div>

		<!-- Dados da Tabela (Data Table)-->
		<?php foreach ($tourney_list as $tourney) : ?>
			<div class="table_data">
				<div class="table-50"><span class="table-title-mobile">Nome:</span><?php echo $tourney['name_tourney']; ?></div>
				<div class="table-30"><span class="table-title-mobile">Local:</span><?php echo $tourney['local_tourney']; ?></div>
				<div class="table-20 txt-center"><span class="table-title-mobile">Situação:</span>
					<?php echo (in_array($tourney['id'], $pilot_info['tourney_registration'])) ? '<span class="info_status info_status--pending">Inscrito</span>' : '<span class="info_status info_status--canceled">Não Inscrito</span>'; ?>
				</div>
			</div>
		<?php endforeach; ?>

	<?php else : ?>
		<div class="flash_info my-x">
			<p><i class="fas fa-exclamation-circle fa-2x px"></i></p><span>Nenhum registro encontrado!</span>
		</div>
	<?php endif; ?>

	<div class="links-center mt-2">
		<a href="<?php echo BASE_URL; ?>pilots/tourney/<?php echo $pilot_info['id']; ?>" class="btn">Realizar Inscrição</a>
	</div>
</div>