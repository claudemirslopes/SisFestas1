/* ===================================== */
/* AJAX MODAL EDITAR (PÁGINAS) */
/* =================================== */
function editarPagina(id) {
	
	$.ajax({
		url: "../editar/edit_pagina.php",
		type:'POST',
		data:{id:id},
		beforeSend:function(){
			$('#ModalPagina').find('.modal-body').html('<center><img src="../assets/images/unnamed.gif"></center>');
			$('#ModalPagina').modal('show');
		},
		success:function(html){
			$('#ModalPagina').find('.modal-body').html(html);
			$('#ModalPagina').find('.modal-body').find('form').on('submit', salvarPagina);

			$('#ModalPagina').modal('show');
		}
	});
}

function salvarPagina(e){
	e.preventDefault();

	var endereco = $(this).find(':input[name=endereco]').val();
	var nome_pagina = $(this).find(':input[name=nome_pagina]').val();
	var obs = $(this).find(':input[name=obs]').val();
	var modified = $(this).find(':input[name=modified]').val();
	var id = $(this).find(':input[name=id]').val();

	$.ajax({
		url:'../processa/proc_edit_pagina.php',
		type:'POST',
		data:{endereco:endereco, nome_pagina:nome_pagina, obs:obs, modified:modified, id:id},
		success:function confirmEditar(id) {
		swal({
			title: "",
			text: "Dados Alterados com sucesso",
			type: "success",
			confirmButtonClass: 'btn-success',
			closeOnConfirm: false
		}, function () {
			location.reload();
			$('#ModalPagina').modal('hide');
		});
		}
	});
}

/* ===================================== */
/* AJAX MODAL EDITAR (NÍVEL DE ACESSO) */
/* =================================== */
function editarNivel(id) {
	
	$.ajax({
		url: "../editar/edit_niv_acessos.php",
		type:'POST',
		data:{id:id},
		beforeSend:function(){
			$('#ModalNivel').find('.modal-body').html('<center><img src="../assets/images/unnamed.gif"></center>');
			$('#ModalNivel').modal('show');
		},
		success:function(html){
			$('#ModalNivel').find('.modal-body').html(html);
			$('#ModalNivel').find('.modal-body').find('form').on('submit', salvarNivel);

			$('#ModalNivel').modal('show');
		}
	});
}

function salvarNivel(e){
	e.preventDefault();

	var nome_nivel_acesso = $(this).find(':input[name=nome_nivel_acesso]').val();
	var ordem = $(this).find(':input[name=ordem]').val();
	var modified = $(this).find(':input[name=modified]').val();
	var id = $(this).find(':input[name=id]').val();

	$.ajax({
		url:'../processa/proc_edit_niv_acessos.php',
		type:'POST',
		data:{nome_nivel_acesso:nome_nivel_acesso, ordem:ordem, modified:modified, id:id},
		success:function confirmEditar(id) {
		swal({
			title: "",
			text: "Dados Alterados com sucesso",
			type: "success",
			confirmButtonClass: 'btn-success',
			closeOnConfirm: false
		}, function () {
			location.reload();
			$('#ModalNivel').modal('hide');
		});
		}
	});
}

/* ======================================= */
/* AJAX MODAL EDITAR / (USUÁRIOS) */
/* ===================================== */
function editarUser(id) {
	
	$.ajax({
		url: "../editar/edit_usuarios.php",
		type:'POST',
		data:{id:id},
		beforeSend:function(){
			$('#ModalUser').find('.modal-body').html('<center><img src="../assets/images/unnamed.gif"></center>');
			$('#ModalUser').modal('show');
		},
		success:function(html){
			$('#ModalUser').find('.modal-body').html(html);
			$('#ModalUser').find('.modal-body').find('form').on('submit', salvarUser);

			$('#ModalUser').modal('show');
		}
	});
}

function salvarUser(e){
	e.preventDefault();

	var nome = $(this).find(':input[name=nome]').val();
	var email = $(this).find(':input[name=email]').val();
	var usuario = $(this).find(':input[name=usuario]').val();
	var obs = $(this).find(':input[name=obs]').val();
	var niveis_acesso_id = $(this).find(':input[name=niveis_acesso_id]').val();
	var situacoes_usuario_id = $(this).find(':input[name=situacoes_usuario_id]').val();
	var modified = $(this).find(':input[name=modified]').val();
	var id = $(this).find(':input[name=id]').val();

	$.ajax({
		url:'../processa/proc_edit_usuarios.php',
		type:'POST',
		data:{nome:nome, email:email, usuario:usuario, obs:obs, niveis_acesso_id:niveis_acesso_id, situacoes_usuario_id:situacoes_usuario_id, modified:modified, id:id},
		success:function confirmEditar(id) {
		swal({
			title: "",
			text: "Dados Alterados com sucesso",
			type: "success",
			confirmButtonClass: 'btn-success',
			closeOnConfirm: false
		}, function () {
			location.reload();
			$('#ModalUser').modal('hide');
		});
		}
	});
}

function editarFoto(id) {
	
	$.ajax({
		url: "../editar/edit_foto.php",
		type:'POST',
		data:{id:id},
		beforeSend:function(){
			$('#ModalFoto').find('.modal-body').html('<center><img src="../assets/images/unnamed.gif"></center>');
			$('#ModalFoto').modal('show');
		},
		success:function(html){
			$('#ModalFoto').find('.modal-body').html(html);

			$('#ModalFoto').modal('show');
		}
	});
}

function editarFoto2(id) {
	
	$.ajax({
		url: "../editar/edit_foto2.php",
		type:'POST',
		data:{id:id},
		beforeSend:function(){
			$('#ModalFoto2').find('.modal-body').html('<center><img src="../assets/images/unnamed.gif"></center>');
			$('#ModalFoto2').modal('show');
		},
		success:function(html){
			$('#ModalFoto2').find('.modal-body').html(html);

			$('#ModalFoto2').modal('show');
		}
	});
}

function editarSenha(id) {
	
	$.ajax({
		url: "../editar/edit_senha.php",
		type:'POST',
		data:{id:id},
		beforeSend:function(){
			$('#ModalSenha').find('.modal-body').html('<center><img src="../assets/images/unnamed.gif"></center>');
			$('#ModalSenha').modal('show');
		},
		success:function(html){
			$('#ModalSenha').find('.modal-body').html(html);
			$('#ModalSenha').find('.modal-body').find('form').on('submit', salvarSenha);

			$('#ModalSenha').modal('show');
		}
	});
}

function editarSenha2(id) {
	
	$.ajax({
		url: "../editar/edit_senha.php",
		type:'POST',
		data:{id:id},
		beforeSend:function(){
			$('#ModalSenha2').find('.modal-body').html('<center><img src="../assets/images/unnamed.gif"></center>');
			$('#ModalSenha2').modal('show');
		},
		success:function(html){
			$('#ModalSenha2').find('.modal-body').html(html);
			$('#ModalSenha2').find('.modal-body').find('form').on('submit', salvarSenha);

			$('#ModalSenha2').modal('show');
		}
	});
}

function salvarSenha(e){
	e.preventDefault();

	var senha = $(this).find(':input[name=senha]').val();
	var modified = $(this).find(':input[name=modified]').val();
	var id = $(this).find(':input[name=id]').val();

	$.ajax({
		url:'../processa/proc_edit_senha.php',
		type:'POST',
		data:{senha:senha, modified:modified, id:id},
		success:function confirmEditar(id) {
		swal({
			title: "",
			text: "Dados Alterados com sucesso",
			type: "success",
			confirmButtonClass: 'btn-success',
			closeOnConfirm: false
		}, function () {
			location.reload();
			$('#ModalSenha').modal('hide');
		});
		}
	});
}

function editarPerfil(id) {
	
	$.ajax({
		url: "../editar/edit_perfil.php",
		type:'POST',
		data:{id:id},
		beforeSend:function(){
			$('#ModalPerfil').find('.modal-body').html('<center><img src="../assets/images/unnamed.gif"></center>');
			$('#ModalPerfil').modal('show');
		},
		success:function(html){
			$('#ModalPerfil').find('.modal-body').html(html);
			$('#ModalPerfil').find('.modal-body').find('form').on('submit', salvarPerfil);

			$('#ModalPerfil').modal('show');
		}
	});
}

function salvarPerfil(e){
	e.preventDefault();

	var nome = $(this).find(':input[name=nome]').val();
	var email = $(this).find(':input[name=email]').val();
	var usuario = $(this).find(':input[name=usuario]').val();
	var obs = $(this).find(':input[name=obs]').val();
	var modified = $(this).find(':input[name=modified]').val();
	var id = $(this).find(':input[name=id]').val();

	$.ajax({
		url:'../processa/proc_edit_perfil.php',
		type:'POST',
		data:{nome:nome, email:email, usuario:usuario, obs:obs, modified:modified, id:id},
		success:function confirmEditar(id) {
			swal({
				title: "",
				text: "Dados Alterados com sucesso",
				type: "success",
				confirmButtonClass: 'btn-success',
				closeOnConfirm: false
			}, function () {
				location.reload();
				$('#ModalPerfil').modal('hide');
			});
			}
	});
}